<?php

namespace Database\Factories;

use App\Models\MasterService;
use App\Models\Master;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика для создания тестовых связей мастер-услуга
 */
class MasterServiceFactory extends Factory
{
    protected $model = MasterService::class;

    /**
     * Определение состояния модели по умолчанию
     */
    public function definition()
    {
        return [
            'master_id' => Master::factory(),
            'service_id' => Service::factory(),
        ];
    }
}