<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTimesheetTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->createProjectWithTimesheet();
    }

    private function createUser(): User
    {
        return User::factory()->create();
    }

    private function createProjectWithTimesheet(): void
    {
        $project = Project::factory()->create([
            'project_code' => 'PRO_0001',
            'project_name' => 'PROJECT_ABC',
            'description' => 'Description 1'
        ]);

        ProjectUser::factory()->create([
            'project_id' => $project->id,
            'user_id' => $this->user->id,
            'role_id' => 1
        ])->timesheets()->createMany([
            [
                'date' => '2021-10-01',
                'total_minutes' => 20,
                'summary_of_work' => 'Work on task 1',
            ],
            [
                'date' => '2021-10-02',
                'total_minutes' => 30,
                'summary_of_work' => 'Work on task 2',
            ],
            [
                'date' => '2021-10-03',
                'total_minutes' => 40,
                'summary_of_work' => 'Work on task 3',
            ],
        ]);
    }

    public function test_user_cannot_access_timesheet_page_without_login(): void
    {
        $response = $this->get(route('user.timesheet'));

        $response->assertRedirect(route('home'));
    }

    public function test_user_can_access_timesheet_page_after_login(): void
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet'));

        $response->assertSee('Timesheet');
    }

    public function test_user_can_see_list_of_timesheet(): void
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet'));

        $response->assertSee('Work on task 1');
    }
}
