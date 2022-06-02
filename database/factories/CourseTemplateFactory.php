<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseTemplate>
 */
class CourseTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'branch_id' => 1,
            'course_category_id' => 1,
            'cancellation_policy_id' => 1,
            'CourseType'  => 'test',
            'name' => 'test',
            'note' => 'test',
            'calendarColor' => 'test',
            'clientCanCancel' => 1,
            'enabled' => 1,
            'Requirements' => 'test',
            'slotDuration' => 1,

        ];
    }
}
