<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Мастер-класс',
            'Концерт',
            'Выступление (номер)',
            'Кулинарная дегустация',
            'Спортивное событие',
            'Экскурсия',
            'Другое',
        ];

        foreach ($types as $type) {
            ActivityType::firstOrCreate(['name' => $type]);
        }
    }
}
