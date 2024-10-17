<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\{Service, User};

class ServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест на успешное добавление услуги.
     *
     */
    public function test_master_can_be_added_successfully()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin);

        $name = $this->faker->name;
        $description = 'Текст описания';
        $price = 1000;
        $photo = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('service.upload'), [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'photo' => $photo,
        ]);

        $this->assertDatabaseHas('services', [
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', ['type' => 'message', 'text' => 'Услуга успешно добавлена!']);
    }

    /**
     * Тест на ошибку валидации, если нет name
     *
     */
    public function test_service_cannot_be_added_without_name()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $description = 'Текст описания';
        $price = 1000;
        $photo = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('service.upload'), [
            'description' => $description,
            'price' => $price,
            'photo' => $photo,
        ]);

        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('services', [
            'description' => $description,
            'price' => $price,
        ]);
    }

    /**
     * Тест на ошибку валидации, нет поля описание
     *
     */
    public function test_service_cannot_be_added_without_description()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $price = 1000;
        $photo = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('service.upload'), [
            'name' => $name,
            'price' => $price,
            'photo' => $photo,
        ]);

        $response->assertSessionHasErrors(['description']);
        $this->assertDatabaseMissing('services', [
            'name' => $name,
            'price' => $price,
        ]);
    }

    /**
     * Тест на ошибку валидации, нет поля цены
     *
     */
    public function test_service_cannot_be_added_without_price()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $description = 'Текст описания';
        $photo = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('service.upload'), [
            'name' => $name,
            'description' => $description,
            'photo' => $photo,
        ]);

        $response->assertSessionHasErrors(['price']);
        $this->assertDatabaseMissing('services', [
            'name' => $name,
            'description' => $description,
        ]);
    }

    /**
     * Тест на ошибку валидации, нет поля фото
     *
     */
    public function test_service_cannot_be_added_without_photo()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $description = 'Текст описания';
        $price = 1000;

        $response = $this->post(route('service.upload'), [
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);

        $response->assertSessionHasErrors(['photo']);
        $this->assertDatabaseMissing('services', [
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);
    }

    /**
     * Тест на ошибку валидации формата фото
     *
     */
    public function test_service_cannot_be_added_with_invalid_photo_format()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $description = 'Текст описания';
        $price = 1000;
        $photo = UploadedFile::fake()->create('document.pdf');

        $response = $this->post(route('service.upload'), [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'photo' => $photo,
        ]);

        $response->assertSessionHasErrors(['photo']);
        $this->assertDatabaseMissing('services', [
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);
    }

    /**
     * Тест на ошибку валидации типа поля цены
     *
     */
    public function test_service_cannot_be_added_with_invalid_price_type()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $description = 'Текст описания';
        $price = 'invalid_price';
        $photo = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('service.upload'), [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'photo' => $photo,
        ]);

        $response->assertSessionHasErrors(['price']);
        $this->assertDatabaseMissing('services', [
            'name' => $name,
            'description' => $description,
        ]);
    }

    /**
     * Тест на успешное удаление услуги
     *
     */
    public function test_service_can_be_deleted_successfully()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Создаем услугу для удаления
        $service = Service::factory()->create();

        $response = $this->delete(route('service.destroy'), [
            'service_id' => $service->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', ['type' => 'message', 'text' => 'Услуга успешно удалена!']);

        // Проверяем, что услуга была удалена из базы данных
        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    /**
     * Тест на ошибку удаления
     *
     */
    public function test_service_cannot_be_deleted_without_service_id()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->delete(route('service.destroy'), []);

        $response->assertSessionHasErrors(['service_id']);
    }
}
