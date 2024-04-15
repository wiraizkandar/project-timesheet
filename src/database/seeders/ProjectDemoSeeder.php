<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::insert([
            "project_code" => "PROJECT_10001",
            "project_name" => "Project Demo",
            "description" => "Project Demo Description",
            "created_at" => now(),
        ]);
    }
}
