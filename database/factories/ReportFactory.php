<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'department' => Department::inRandomOrder()->first()->id,
            'ticket_number' => 'TCK-' . $this->faker->unique()->numerify('###'),
            'date' => $this->faker->date(),
            'open_time' => $this->faker->time(),
            // 'close_time' => $this->faker->time(),
            'priority_level' => $this->faker->randomElement(['low', 'medium', 'high']),
            'category' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'type_device' => $this->faker->word(),
            'operation_system' => 'Windows 10',
            'software_or_application' => 'Microsoft Excel',
            'error_message' => $this->faker->sentence(),
            'step_taken' => $this->faker->paragraph(),
            'ticket_status' => $this->faker->randomElement(['open', 'in_progress', 'closed']),
        ];
    }
}
