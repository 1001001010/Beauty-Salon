<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Master;
use App\Models\Service;
use App\Models\User;

class MasterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Тест на успешное добавление мастера.
     *
     */
    public function test_master_can_be_added_successfully()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin);

        $name = $this->faker->name;
        $surname = $this->faker->lastName;
        $fathername = $this->faker->firstNameMale;
        $photo = UploadedFile::fake()->image('photo.jpg');

        $services = Service::factory()->count(3)->create();
        $serviceIds = $services->pluck('id')->toArray();

        $response = $this->post(route('master.upload'), [
            'name' => $name,
            'surname' => $surname,
            'fathername' => $fathername,
            'photo' => $photo,
            'services' => $serviceIds,
        ]);

        $this->assertDatabaseHas('masters', [
            'name' => $name,
            'surname' => $surname,
            'fathername' => $fathername,
        ]);

        $master = Master::where('name', $name)->first();
        $this->assertCount(3, $master->services);

        $response->assertRedirect();
        $response->assertSessionHas('message', ['type' => 'message', 'text' => 'Мастер успешно добавлен!']);
    }

    /**
     * Тест на ошиюку валидации имени
     *
     */
    public function test_name_validation_fails()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $surname = $this->faker->lastName;
        $fathername = $this->faker->firstNameMale;
        $photo = UploadedFile::fake()->image('photo.jpg');
        $services = Service::factory()->count(3)->create();
        $serviceIds = $services->pluck('id')->toArray();

        $response = $this->post(route('master.upload'), [
            'name' => '',
            'surname' => $surname,
            'fathername' => $fathername,
            'photo' => $photo,
            'services' => $serviceIds,
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Тест на ошиюку валидации фамилии
     *
     */
    public function test_surname_validation_fails()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $fathername = $this->faker->firstNameMale;
        $photo = UploadedFile::fake()->image('photo.jpg');
        $services = Service::factory()->count(3)->create();
        $serviceIds = $services->pluck('id')->toArray();

        $response = $this->post(route('master.upload'), [
            'name' => $name,
            'surname' => '',
            'fathername' => $fathername,
            'photo' => $photo,
            'services' => $serviceIds,
        ]);

        $response->assertSessionHasErrors('surname');
    }

    /**
     * Тест на ошиюку валидации отчества
     *
     */
    public function test_fathername_validation_fails()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $surname = $this->faker->lastName;
        $photo = UploadedFile::fake()->image('photo.jpg');
        $services = Service::factory()->count(3)->create();
        $serviceIds = $services->pluck('id')->toArray();

        $response = $this->post(route('master.upload'), [
            'name' => $name,
            'surname' => $surname,
            'fathername' => '',
            'photo' => $photo,
            'services' => $serviceIds,
        ]);

        $response->assertSessionHasErrors('fathername');
    }

    /**
     * Тест на ошиюку валидации фото
     *
     */
    public function test_photo_validation_fails()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $surname = $this->faker->lastName;
        $fathername = $this->faker->firstNameMale;
        $services = Service::factory()->count(3)->create();
        $serviceIds = $services->pluck('id')->toArray();

        $response = $this->post(route('master.upload'), [
            'name' => $name,
            'surname' => $surname,
            'fathername' => $fathername,
            'photo' => '',
            'services' => $serviceIds,
        ]);

        $response->assertSessionHasErrors('photo');
    }

    /**
     * Тест на ошиюку валидации сервиса
     *
     */
    public function test_services_validation_fails()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $name = $this->faker->name;
        $surname = $this->faker->lastName;
        $fathername = $this->faker->firstNameMale;
        $photo = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('master.upload'), [
            'name' => $name,
            'surname' => $surname,
            'fathername' => $fathername,
            'photo' => $photo,
            'services' => [],
        ]);

        $response->assertSessionHasErrors('services');
    }
}
