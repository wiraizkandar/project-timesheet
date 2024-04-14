<?php

namespace Database\Factories;

use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TimesheetFactory extends Factory
{
    protected $model = Timesheet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_user_id' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date(),
            'total_minutes' => $this->faker->numberBetween(20, 100),
            'summary_of_work' => $this->faker->text(100),
            'status' => 'pending',
            'approval_by' => null
        ];
    }
}
