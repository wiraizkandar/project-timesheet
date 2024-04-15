<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
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
        ])->timesheets()->createMany([
            [
                'date' => '2021-10-01',
                'time_start' => '08:00',
                'time_end' => '09:00',
                'summary_of_work' => 'Work on task 1',
            ],
            [
                'date' => '2021-10-02',
                'time_start' => '08:00',
                'time_end' => '09:00',
                'summary_of_work' => 'Work on task 2',
            ],
            [
                'date' => '2021-10-03',
                'time_start' => '08:00',
                'time_end' => '09:00',
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

    public function test_user_can_view_edit_timesheet_page()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet.edit', 1));

        $response->assertSee('Edit Timesheet');
    }

    public function test_user_can_view_edit_page_with_selected_timesheet()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet.edit', 1));

        $response->assertOk();
        $response->assertSee("Work on task 1");
    }

    public function test_user_success_save_edit_selected_timesheet()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->put(route('user.timesheet.edit.store', 1), [
            'date' => '2021-10-01',
            'start_time' => '08:00',
            'end_time' => '09:00',
            'summary_of_work' => 'Work on task 123',
        ]);

        // Assert that the timesheet was updated in the database
        $this->assertDatabaseHas('timesheets', [
            'id' => 1,
            'summary_of_work' => "Work on task 123",
        ]);

        $this->assertEquals('Timesheet updated successfully', session('success'));
    }

    public function test_user_failed_save_edit_selected_timesheet()
    {
        $this->actingAs($this->user, 'user');

        $this->put(route('user.timesheet.edit.store', 10000000000), [
            'date' => '2021-10-01',
            'start_time' => '08:00',
            'end_time' => '09:00',
            'summary_of_work' => 'Work on task 123',
        ]);

        $this->assertEquals('Failed to update selected timesheet', session('error'));
    }

    public function test_user_can_only_edit_their_own_timesheet()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet.edit', 5));

        $response->assertNotFound();
    }

    public function test_user_failed_with_incomplete_required_data()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->put(route('user.timesheet.edit.store', 1), [
            'summary_of_work' => 'Work on task 123',
        ]);

        $response->assertInvalid([
            'date' => 'Date is required',
        ]);
    }

    public function test_user_can_view_create_new_timesheet_page()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet.create'));

        $response->assertSee('Create New Timesheet');
    }

    public function test_user_can_create_new_timesheet()
    {
        $this->actingAs($this->user, 'user');

        $this->post(route('user.timesheet.create.store'), [
            'project_user_id' => 1,
            'date' => '2021-10-11',
            'start_time' => '08:00',
            'end_time' => '09:00',
            'summary_of_work' => 'Work on task 123',
        ]);

        $this->assertEquals('Timesheet submitted successfully', session('success'));
    }

    public function test_user_cannot_create_timesheet_project_not_belong_to_user()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->post(route('user.timesheet.create.store'), [
            'project_user_id' => 10000,
            'date' => '2021-10-11',
            'start_time' => '08:00',
            'end_time' => '09:00',
            'summary_of_work' => 'Work on task 123',
        ]);

        $response->assertSessionHasErrors([
            'project_user_id' => 'Project does not exist',
        ]);
    }

    public function test_user_can_view_delete_timesheet_page()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->get(route('user.timesheet.delete', 1));

        $response->assertSee('Delete Timesheet');
    }

    public function test_user_can_delete_timesheet()
    {
        $this->actingAs($this->user, 'user');

        $response = $this->delete(route('user.timesheet.delete.store', 1));

        $response->assertRedirect(route('user.timesheet'));

        $this->assertEquals('Timesheet deleted successfully', session('success'));
    }
}
