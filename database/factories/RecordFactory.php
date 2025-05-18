<?php

namespace Database\Factories;

use App\Models\Record;
use App\Models\User;
use App\Models\MasterService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика для создания тестовых записей
 */
class RecordFactory extends Factory
{
    protected $model = Record::class;

    /**
     * Определение состояния модели по умолчанию
     */
    public function definition()
    {
        return [
            'client_id' => User::factory(),
            'master_service_id' => function () {
                // Это заглушка. В реальных тестах вам нужно будет создать
                // правильную связь MasterService
                return MasterService::factory()->create()->id;
            },
            'datetime' => $this->faker->dateTimeBetween('now', '+30 days'),
        ];
    }
}