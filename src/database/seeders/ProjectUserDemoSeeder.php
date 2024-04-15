<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectUser::insert([
            "project_id" => 1,
            "user_id" => 1,
            "created_at" => now(),
        ]);
    }
}
