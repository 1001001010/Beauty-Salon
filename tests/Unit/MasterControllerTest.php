<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Master;
use App\Models\User;
use App\Models\Service;
use App\Models\Record;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MasterControllerTest extends TestCase
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

    /**
     * Создание пользователя-мастера для тестов
     */
    private function createMasterUser()
    {
        $user = User::factory()->create(['role' => 'master']);
        $master = Master::factory()->create(['user_id' => $user->id]);
        return [$user, $master];
    }

    /** @test */
    public function it_prevents_creating_duplicate_masters()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем пользователя, который уже является мастером
        $user = User::factory()->create(['role' => 'master']);
        $existingMaster = Master::factory()->create(['user_id' => $user->id]);

        // Создаем услугу
        $service = Service::factory()->create();

        // Данные для создания мастера
        $masterData = [
            'user_id' => $user->id,
            'name' => 'Иван',
            'surname' => 'Иванов',
            'fathername' => 'Иванович',
            'photo' => UploadedFile::fake()->image('master.jpg'),
            'services' => [$service->id]
        ];

        // Отправляем запрос на создание мастера
        $response = $this->post(route('master.upload'), $masterData);

        $response->assertRedirect();
        $response->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function it_deletes_a_master()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем мастера
        $master = Master::factory()->create();

        // Отправляем запрос на удаление мастера
        $response = $this->delete(route('master.delete', ['master' => $master->id]));

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Мастер успешно удален');

        // Проверяем, что мастер мягко удален
        $this->assertSoftDeleted($master);
    }

    /** @test */
    public function it_restores_a_deleted_master()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем и мягко удаляем мастера
        $master = Master::factory()->create();
        $master->delete();

        $this->assertSoftDeleted($master);

        // Отправляем запрос на восстановление мастера
        $response = $this->patch(route('master.restore', ['master' => $master->id]));

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Мастер успешно восстановлен');

        // Проверяем, что мастер восстановлен
        $this->assertDatabaseHas('masters', [
            'id' => $master->id,
            'deleted_at' => null
        ]);
    }

    /** @test */
    public function it_updates_a_master_with_new_photo()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем мастера
        $master = Master::factory()->create([
            'name' => 'Исходное',
            'surname' => 'Имя',
            'fathername' => 'Мастера'
        ]);

        // Создаем услуги
        $oldServices = Service::factory()->count(2)->create();
        $newServices = Service::factory()->count(2)->create();

        // Привязываем старые услуги
        $master->services()->attach($oldServices->pluck('id'));

        // Данные для обновления
        $updateData = [
            'id' => $master->id,
            'name' => 'Обновленное',
            'surname' => 'Имя',
            'fathername' => 'Мастера',
            'photo' => UploadedFile::fake()->image('new_master.jpg'),
            'services' => $newServices->pluck('id')->toArray()
        ];

        // Отправляем запрос на обновление мастера
        $response = $this->patch(route('master.update'), $updateData);

        $response->assertRedirect();
        $response->assertSessionHas('message.type', 'message');
        $response->assertSessionHas('message.text', 'Информация о мастере успешно изменена!');

        // Проверяем, что мастер обновлен
        $this->assertDatabaseHas('masters', [
            'id' => $master->id,
            'name' => 'Обновленное',
            'surname' => 'Имя',
            'fathername' => 'Мастера'
        ]);

        // Проверяем, что новое фото сохранено
        $updatedMaster = Master::find($master->id);
        Storage::disk('public')->assertExists($updatedMaster->photo);
        $this->assertNotEquals($master->photo, $updatedMaster->photo);

        // Проверяем, что услуги синхронизированы (старые удалены, новые добавлены)
        foreach ($oldServices as $service) {
            $this->assertDatabaseMissing('master_service', [
                'master_id' => $master->id,
                'service_id' => $service->id
            ]);
        }

        foreach ($newServices as $service) {
            $this->assertDatabaseHas('master_service', [
                'master_id' => $master->id,
                'service_id' => $service->id
            ]);
        }
    }

    /** @test */
    public function it_updates_a_master_without_new_photo()
    {
        // Создаем администратора и авторизуемся
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        // Создаем мастера
        $master = Master::factory()->create([
            'name' => 'Исходное',
            'surname' => 'Имя',
            'fathername' => 'Мастера',
            'photo' => 'original/path.jpg'
        ]);

        // Создаем и привязываем услуги
        $services = Service::factory()->count(2)->create();
        $master->services()->attach($services->pluck('id'));

        // Данные для обновления без фото
        $updateData = [
            'id' => $master->id,
            'name' => 'Обновленное',
            'surname' => 'Имя',
            'fathername' => 'Мастера',
            'services' => $services->pluck('id')->toArray()
        ];

        // Отправляем запрос на обновление мастера
        $response = $this->patch(route('master.update'), $updateData);

        $response->assertRedirect();

        // Проверяем, что мастер обновлен, но фото осталось прежним
        $updatedMaster = Master::find($master->id);
        $this->assertEquals('Обновленное', $updatedMaster->name);
        $this->assertEquals('Имя', $updatedMaster->surname);
        $this->assertEquals('Мастера', $updatedMaster->fathername);
        $this->assertEquals('original/path.jpg', $updatedMaster->photo);
    }
}