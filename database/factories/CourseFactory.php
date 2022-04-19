<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'course_template_id' => 1,
            'staff_id' => 1,
            'StartDate' => $this->faker->date(),
            'EndDate' => $this->faker->date(),
            'MaxNumber' => 5,

        ];
    }
}
