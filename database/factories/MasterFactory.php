<?php

namespace Database\Factories;

use App\Models\Master;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика для создания тестовых мастеров
 */
class MasterFactory extends Factory
{
    protected $model = Master::class;

    /**
     * Определение состояния модели по умолчанию
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'fathername' => $this->faker->firstName('male'),
            'photo' => 'master/' . $this->faker->uuid . '.jpg',
        ];
    }
}
