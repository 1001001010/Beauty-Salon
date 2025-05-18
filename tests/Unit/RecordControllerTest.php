<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Record;
use App\Models\Service;
use App\Models\Master;
use App\Models\MasterService;
use App\Models\User;
use Carbon\Carbon;

class RecordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_record()
    {
        // Создаем пользователя (клиента) и авторизуемся
        $user = User::factory()->create();
        $this->actingAs($user);

        // Создаем мастера
        $master = Master::factory()->create();

        // Создаем услугу
        $service = Service::factory()->create();

        // Связываем мастера с услугой
        $masterService = MasterService::create([
            'master_id' => $master->id,
            'service_id' => $service->id
        ]);

        // Подготавливаем данные для записи
        $recordData = [
            'date' => Carbon::now()->addDays(2)->format('m/d/Y'),
            'hour' => 14,
            'minute' => 30,
            'master_id' => $master->id,
            'service_id' => $service->id
        ];

        // Отправляем запрос на создание записи
        $response = $this->post(route('records.upload'), $recordData);

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Успешно! Информацию о записи можете увидеть в личном кабинете');

        // Проверяем, что запись создана
        $expectedDateTime = Carbon::createFromFormat('m/d/Y', $recordData['date'])
            ->setTime($recordData['hour'], $recordData['minute']);

        $this->assertDatabaseHas('records', [
            'client_id' => $user->id,
            'master_service_id' => $masterService->id,
            'datetime' => $expectedDateTime
        ]);
    }

    /** @test */
    public function it_prevents_unauthenticated_user_from_creating_record()
    {
        // Создаем мастера
        $master = Master::factory()->create();

        // Создаем услугу
        $service = Service::factory()->create();

        // Связываем мастера с услугой
        MasterService::create([
            'master_id' => $master->id,
            'service_id' => $service->id
        ]);

        // Подготавливаем данные для записи
        $recordData = [
            'date' => Carbon::now()->addDays(2)->format('m/d/Y'),
            'hour' => 14,
            'minute' => 30,
            'master_id' => $master->id,
            'service_id' => $service->id
        ];

        // Отправляем запрос на создание записи без авторизации
        $response = $this->post(route('records.upload'), $recordData);

        // Проверяем, что пользователь перенаправлен на страницу входа
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function it_validates_record_creation()
    {
        // Создаем пользователя и авторизуемся
        $user = User::factory()->create();
        $this->actingAs($user);

        // Неверные данные
        $recordData = [
            'date' => 'неверная-дата',
            'hour' => 25, // Неверный час
            'minute' => 45, // Неверная минута (не 0 или 30)
            'master_id' => 999, // Несуществующий мастер
            'service_id' => 999 // Несуществующая услуга
        ];

        // Отправляем запрос с неверными данными
        $response = $this->post(route('records.upload'), $recordData);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['date', 'hour', 'minute']);
    }

    /** @test */
    public function it_prevents_booking_when_master_does_not_offer_service()
    {
        // Создаем пользователя и авторизуемся
        $user = User::factory()->create();
        $this->actingAs($user);

        // Создаем мастера
        $master = Master::factory()->create();

        // Создаем услугу, но не связываем с мастером
        $service = Service::factory()->create();

        // Подготавливаем данные для записи
        $recordData = [
            'date' => Carbon::now()->addDays(2)->format('m/d/Y'),
            'hour' => 14,
            'minute' => 30,
            'master_id' => $master->id,
            'service_id' => $service->id
        ];

        // Отправляем запрос на создание записи
        $response = $this->post(route('records.upload'), $recordData);

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'error');
        $response->assertSessionHas('message.text', 'Ошибка! Услуга не найдена');
    }

    /** @test */
    public function it_validates_record_deletion()
    {
        // Создаем пользователя и авторизуемся
        $user = User::factory()->create();
        $this->actingAs($user);

        // Отправляем запрос на удаление несуществующей записи
        $response = $this->delete(route('records.delete'), [
            'id' => 999 // Несуществующая запись
        ]);

        $response->assertStatus(404);
    }
}