<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика для создания тестовых услуг
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Определение состояния модели по умолчанию
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'description' => $this->faker->paragraph(),
            'photo' => 'service/' . $this->faker->uuid . '.jpg',
        ];
    }
}