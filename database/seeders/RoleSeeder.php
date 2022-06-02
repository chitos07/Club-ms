<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role' => 'user.index']);
        Role::create(['role' => 'user.create']);
        Role::create(['role' => 'user.show']);
        Role::create(['role' => 'user.edit']);
        Role::create(['role' => 'user.delete']);
        Role::create(['role' => 'user.restore']);
        Role::create(['role' => 'course.index']);
        Role::create(['role' => 'course.create']);
        Role::create(['role' => 'course.show']);
        Role::create(['role' => 'course.edit']);
        Role::create(['role' => 'course.delete']);
        Role::create(['role' => 'course.restore']);
        Role::create(['role' => 'currency.index']);
        Role::create(['role' => 'currency.create']);
        Role::create(['role' => 'currency.edit']);
        Role::create(['role' => 'currency.show']);
        Role::create(['role' => 'currency.delete']);
        Role::create(['role' => 'currency.restore']);
        Role::create(['role' => 'branch.index']);
        Role::create(['role' => 'branch.create']);
        Role::create(['role' => 'branch.edit']);
        Role::create(['role' => 'branch.show']);
        Role::create(['role' => 'branch.delete']);
        Role::create(['role' => 'branch.restore']);
        Role::create(['role' => 'resource.index']);
        Role::create(['role' => 'resource.create']);
        Role::create(['role' => 'resource.edit']);
        Role::create(['role' => 'resource.show']);
        Role::create(['role' => 'resource.delete']);
        Role::create(['role' => 'resource.restore']);
        Role::create(['role' => 'courseCategory.index']);
        Role::create(['role' => 'courseCategory.create']);
        Role::create(['role' => 'courseCategory.edit']);
        Role::create(['role' => 'courseCategory.show']);
        Role::create(['role' => 'courseCategory.delete']);
        Role::create(['role' => 'courseCategory.restore']);
        Role::create(['role' => 'cancellationPolicy.index']);
        Role::create(['role' => 'cancellationPolicy.create']);
        Role::create(['role' => 'cancellationPolicy.edit']);
        Role::create(['role' => 'cancellationPolicy.show']);
        Role::create(['role' => 'cancellationPolicy.delete']);
        Role::create(['role' => 'cancellationPolicy.restore']);
        Role::create(['role' => 'courseTemplate.index']);
        Role::create(['role' => 'courseTemplate.create']);
        Role::create(['role' => 'courseTemplate.edit']);
        Role::create(['role' => 'courseTemplate.show']);
        Role::create(['role' => 'courseTemplate.delete']);
        Role::create(['role' => 'courseTemplate.restore']);
        Role::create(['role' => 'courseElement.index']);
        Role::create(['role' => 'courseElement.create']);
        Role::create(['role' => 'courseElement.edit']);
        Role::create(['role' => 'courseElement.show']);
        Role::create(['role' => 'courseElement.delete']);
        Role::create(['role' => 'courseElement.restore']);
        Role::create(['role' => 'staff.index']);
        Role::create(['role' => 'staff.create']);
        Role::create(['role' => 'staff.edit']);
        Role::create(['role' => 'staff.show']);
        Role::create(['role' => 'staff.delete']);
        Role::create(['role' => 'staff.restore']);
        Role::create(['role' => 'session.index']);
        Role::create(['role' => 'session.create']);
        Role::create(['role' => 'session.edit']);
        Role::create(['role' => 'session.show']);
        Role::create(['role' => 'session.delete']);
        Role::create(['role' => 'session.restore']);
        Role::create(['role' => 'role.index']);
        Role::create(['role' => 'role.create']);
        Role::create(['role' => 'role.edit']);
        Role::create(['role' => 'role.show']);
        Role::create(['role' => 'role.delete']);
        Role::create(['role' => 'role.restore']);
        Role::create(['role' => 'client.index']);
        Role::create(['role' => 'client.create']);
        Role::create(['role' => 'client.edit']);
        Role::create(['role' => 'client.show']);
        Role::create(['role' => 'client.delete']);
        Role::create(['role' => 'client.restore']);

    }
}
