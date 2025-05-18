<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Service;
use App\Models\Master;
use App\Models\Record;
use App\Models\MasterService;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Настройка перед каждым тестом
     */
    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public'); // Подмена хранилища для тестирования загрузки файлов
    }

    /**
     * Создание пользователя-администратора для тестов
     */
    private function createAdminUser()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        return $admin;
    }

    /** @test */
    public function it_displays_services_with_pagination()
    {
        // Создаем тестовые услуги
        Service::factory()->count(15)->create();

        // Создаем мастера для тестирования связей
        Master::factory()->create();

        // Отправляем запрос на страницу услуг
        $response = $this->get(route('service.index'));

        $response->assertStatus(200);
        $response->assertViewIs('services.index');
        $response->assertViewHas('services');
        $response->assertViewHas('masters');
    }

    /** @test */
    public function it_filters_services_by_name()
    {
        // Создаем услуги с определенными названиями
        Service::factory()->create(['name' => 'Тестовая услуга 1']);
        Service::factory()->create(['name' => 'Тестовая услуга 2']);
        Service::factory()->create(['name' => 'Другая услуга']);

        // Отправляем запрос с фильтром по названию
        $response = $this->get(route('service.index', ['word' => 'Тестовая']));

        $response->assertStatus(200);
        $response->assertViewHas('services', function ($services) {
            return $services->count() == 2 &&
                   $services->pluck('name')->contains('Тестовая услуга 1') &&
                   $services->pluck('name')->contains('Тестовая услуга 2');
        });
    }

    /** @test */
    public function it_filters_services_by_price_range()
    {
        // Создаем услуги с разными ценами
        Service::factory()->create(['name' => 'Дешевая услуга', 'price' => 50]);
        Service::factory()->create(['name' => 'Средняя услуга', 'price' => 100]);
        Service::factory()->create(['name' => 'Дорогая услуга', 'price' => 200]);

        // Отправляем запрос с фильтром по диапазону цен
        $response = $this->get(route('service.index', ['price_min' => 75, 'price_max' => 150]));

        $response->assertStatus(200);
        $response->assertViewHas('services', function ($services) {
            return $services->count() == 1 &&
                   $services->pluck('name')->contains('Средняя услуга');
        });
    }

    /** @test */
    public function it_creates_a_service()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Данные для создания услуги
        $serviceData = [
            'name' => 'Новая тестовая услуга',
            'price' => 99.99,
            'description' => 'Это описание тестовой услуги',
            'photo' => UploadedFile::fake()->image('service.jpg')
        ];

        // Отправляем запрос на создание услуги
        $response = $this->post(route('service.upload'), $serviceData);

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Услуга успешно добавлена!');

        // Проверяем, что услуга создана в базе данных
        $this->assertDatabaseHas('services', [
            'name' => 'Новая тестовая услуга',
            'price' => 99.99,
            'description' => 'Это описание тестовой услуги',
        ]);

        // Проверяем, что файл был сохранен
        $service = Service::where('name', 'Новая тестовая услуга')->first();
        Storage::disk('public')->assertExists($service->photo);
    }

    /** @test */
    public function it_validates_service_creation()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Отправляем запрос с неверными данными
        $response = $this->post(route('service.upload'), [
            'name' => '',
            'price' => 'не-число',
            'description' => '',
            // Отсутствует фото
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'description', 'photo']);
    }

    /** @test */
    public function it_deletes_a_service_and_related_future_records()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем услугу
        $service = Service::factory()->create();

        // Создаем мастера
        $master = Master::factory()->create();

        // Создаем связь мастер-услуга
        $masterService = MasterService::create([
            'master_id' => $master->id,
            'service_id' => $service->id
        ]);

        // Создаем будущие и прошедшие записи
        $futureRecord = Record::factory()->create([
            'master_service_id' => $masterService->id,
            'datetime' => now()->addDays(2)
        ]);

        $pastRecord = Record::factory()->create([
            'master_service_id' => $masterService->id,
            'datetime' => now()->subDays(2)
        ]);

        // Отправляем запрос на удаление услуги
        $response = $this->delete(route('service.delete', ['service' => $service->id]));

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');

        // Проверяем, что услуга удалена (soft delete)
        $this->assertSoftDeleted($service);

        // Проверяем, что будущие записи удалены, а прошедшие остались
        $this->assertDatabaseMissing('records', ['id' => $futureRecord->id]);
        $this->assertDatabaseHas('records', ['id' => $pastRecord->id]);
    }

    /** @test */
    public function it_restores_a_deleted_service()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем и мягко удаляем услугу
        $service = Service::factory()->create();
        $service->delete();

        $this->assertSoftDeleted($service);

        // Отправляем запрос на восстановление услуги
        $response = $this->patch(route('service.restore', ['service' => $service->id]));

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Услуга успешно восстановлена!');

        // Проверяем, что услуга восстановлена
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'deleted_at' => null
        ]);
    }

    /** @test */
    public function it_updates_a_service_with_new_photo()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем услугу
        $service = Service::factory()->create([
            'name' => 'Исходная услуга',
            'price' => 50,
            'description' => 'Исходное описание'
        ]);

        // Данные для обновления
        $updateData = [
            'id' => $service->id,
            'name' => 'Обновленная услуга',
            'price' => 75,
            'description' => 'Обновленное описание',
            'photo' => UploadedFile::fake()->image('new_service.jpg')
        ];

        // Отправляем запрос на обновление услуги
        $response = $this->patch(route('service.update'), $updateData);

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Услуга успешно изменена!');

        // Проверяем, что услуга обновлена
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Обновленная услуга',
            'price' => 75,
            'description' => 'Обновленное описание'
        ]);

        // Проверяем, что новое фото сохранено
        $updatedService = Service::find($service->id);
        Storage::disk('public')->assertExists($updatedService->photo);
        $this->assertNotEquals($service->photo, $updatedService->photo);
    }

    /** @test */
    public function it_updates_a_service_without_new_photo()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем услугу
        $service = Service::factory()->create([
            'name' => 'Исходная услуга',
            'price' => 50,
            'description' => 'Исходное описание',
            'photo' => 'original/path.jpg'
        ]);

        // Данные для обновления без фото
        $updateData = [
            'id' => $service->id,
            'name' => 'Обновленная услуга',
            'price' => 75,
            'description' => 'Обновленное описание'
            // Нет фото
        ];

        // Отправляем запрос на обновление услуги
        $response = $this->patch(route('service.update'), $updateData);

        $response->assertRedirect();

        // Проверяем, что услуга обновлена, но фото осталось прежним
        $updatedService = Service::find($service->id);
        $this->assertEquals('Обновленная услуга', $updatedService->name);
        $this->assertEquals(75, $updatedService->price);
        $this->assertEquals('Обновленное описание', $updatedService->description);
        $this->assertEquals('original/path.jpg', $updatedService->photo);
    }
}