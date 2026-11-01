<?php

namespace Tests\Feature;

use App\Models\Bug;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_projects(): void
    {
        $response = $this->get(route('projects.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_qa_and_admin_can_view_projects_list(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $project = Project::create([
            'name' => 'Mobile Banking',
            'description' => 'Aplikasi mobile banking perbankan',
            'created_by' => $qa->id,
        ]);

        $response = $this->actingAs($qa)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertSee('Mobile Banking');
    }

    public function test_qa_can_create_new_project_folder(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);

        $response = $this->actingAs($qa)->post(route('projects.store'), [
            'name' => 'E-Commerce App',
            'description' => 'Toko online terintegrasi payment gateway',
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => 'E-Commerce App',
            'created_by' => $qa->id,
        ]);

        $project = Project::where('name', 'E-Commerce App')->first();
        $response->assertRedirect(route('projects.show', $project));
    }

    public function test_developer_cannot_create_project_folder(): void
    {
        $dev = User::factory()->create(['role' => 'developer']);

        $response = $this->actingAs($dev)->post(route('projects.store'), [
            'name' => 'Unauthorized Project',
        ]);

        $response->assertStatus(403);
    }

    public function test_qa_can_view_project_folder_details_and_bugs(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Alex Dev']);

        $project = Project::create([
            'name' => 'Instagram Clone',
            'created_by' => $qa->id,
        ]);

        $bug = Bug::create([
            'title' => 'Story filter not loading',
            'project_id' => $project->id,
            'project' => $project->name,
            'priority' => 'p1',
            'status' => 'open',
            'developer' => $dev->name,
            'description' => 'Filter black and white crash app',
            'reporter_id' => $qa->id,
        ]);

        $response = $this->actingAs($qa)->get(route('projects.show', $project));
        $response->assertStatus(200);
        $response->assertSee('Instagram Clone');
        $response->assertSee('Story filter not loading');
    }

    public function test_qa_reporting_bug_inside_project_folder_automatically_binds_project(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Budi Dev']);

        $project = Project::create([
            'name' => 'Point of Sales System',
            'created_by' => $qa->id,
        ]);

        // Access the create bug form with project_id
        $formResponse = $this->actingAs($qa)->get(route('bugs.create', ['project_id' => $project->id]));
        $formResponse->assertStatus(200);
        $formResponse->assertSee('Point of Sales System');
        $formResponse->assertSee('Otomatis Terkunci');

        // Submit the bug with project_id (no need to specify raw project string)
        $storeResponse = $this->actingAs($qa)->post(route('bugs.store'), [
            'title' => 'Print receipt alignment issue',
            'project_id' => $project->id,
            'from_project' => 1,
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'Budi Dev',
            'description' => 'Kertas struk terpotong di bagian total harga',
        ]);

        $this->assertDatabaseHas('bugs', [
            'title' => 'Print receipt alignment issue',
            'project_id' => $project->id,
            'project' => 'Point of Sales System',
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'Budi Dev',
            'reporter_id' => $qa->id,
        ]);

        $storeResponse->assertRedirect(route('projects.show', $project));
    }

    public function test_super_admin_can_delete_project_folder(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        $project = Project::create([
            'name' => 'Project to Delete',
            'created_by' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->delete(route('projects.destroy', $project));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        $response->assertRedirect(route('projects.index'));
    }

    public function test_qa_reporting_bug_automatically_creates_and_groups_into_project_folder(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Developer Auto']);

        // QA inputs a bug with project string, without creating any folder beforehand
        $response = $this->actingAs($qa)->post(route('bugs.store'), [
            'title' => 'Auto Grouped Bug',
            'project' => 'E-Commerce Platform',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'Developer Auto',
            'description' => 'Bug otomatis dikelompokkan ke folder project baru',
        ]);

        $response->assertRedirect(route('bugs'));

        // Project folder should be automatically created in database
        $this->assertDatabaseHas('projects', [
            'name' => 'E-Commerce Platform',
        ]);

        $project = Project::where('name', 'E-Commerce Platform')->first();

        // Bug should belong to this automatically created project folder
        $this->assertDatabaseHas('bugs', [
            'title' => 'Auto Grouped Bug',
            'project_id' => $project->id,
            'project' => 'E-Commerce Platform',
        ]);
    }

    public function test_bugs_automatically_rise_by_priority_in_distribution_view(): void
    {
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Dev Priority Tester']);

        // Create P3 first, then P2, then P1 last (reverse chronological)
        $p3Bug = Bug::create([
            'title' => 'P3 Low Issue',
            'priority' => 'p3',
            'status' => 'open',
            'developer' => 'Dev Priority Tester',
            'description' => 'Low priority',
            'created_at' => now()->subMinutes(1),
        ]);

        $p2Bug = Bug::create([
            'title' => 'P2 High Issue',
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'Dev Priority Tester',
            'description' => 'High priority',
            'created_at' => now()->subMinutes(2),
        ]);

        $p1Bug = Bug::create([
            'title' => 'P1 Critical Issue',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'Dev Priority Tester',
            'description' => 'Critical priority',
            'created_at' => now()->subMinutes(3),
        ]);

        $response = $this->actingAs($dev)->get(route('bugs'));
        $response->assertStatus(200);
        $response->assertSee('Distribution by Priority');

        $bugs = $response->viewData('bugs');
        $this->assertEquals($p1Bug->id, $bugs->first()->id, 'P1 Critical bug should automatically rise to the top');
        $this->assertEquals($p2Bug->id, $bugs->values()->get(1)->id, 'P2 High bug should be second');
        $this->assertEquals($p3Bug->id, $bugs->values()->get(2)->id, 'P3 Medium bug should be last');
    }

    public function test_qa_can_edit_bug_priority_from_detail_page(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev', 'name' => 'QA Officer']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Assigned Dev']);

        $bug = Bug::create([
            'title' => 'Initial P3 Bug',
            'priority' => 'p3',
            'status' => 'new',
            'developer' => 'Assigned Dev',
            'description' => 'Discovered a bug that escalated',
            'reporter_id' => $qa->id,
        ]);

        $response = $this->actingAs($qa)->patch(route('bugs.status.update', $bug), [
            'status' => 'new',
            'priority' => 'p1',
            'developer' => 'Assigned Dev',
            'from_show' => 1,
        ]);

        $response->assertRedirect(route('bugs.show', $bug));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bugs', [
            'id' => $bug->id,
            'priority' => 'p1',
        ]);
    }

    public function test_developer_cannot_edit_bug_priority(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev', 'name' => 'Reporter QA']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Dev Worker']);

        $bug = Bug::create([
            'title' => 'High Priority Production Bug',
            'priority' => 'p1',
            'status' => 'in_progress',
            'developer' => 'Dev Worker',
            'description' => 'P1 critical bug',
            'reporter_id' => $qa->id,
        ]);

        $response = $this->actingAs($dev)->patch(route('bugs.status.update', $bug), [
            'status' => 'done_by_development',
            'priority' => 'p3', // Dev tries to downgrade priority
            'from_show' => 1,
        ]);

        $response->assertRedirect(route('bugs.show', $bug));

        // Priority must stay p1
        $this->assertDatabaseHas('bugs', [
            'id' => $bug->id,
            'status' => 'done_by_development',
            'priority' => 'p1',
        ]);
    }

    public function test_qa_can_see_new_folder_button_and_creator_is_displayed_on_project_card(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev', 'name' => 'QA Officer Tester']);
        $project = Project::create([
            'name' => 'Internal Portal',
            'description' => 'Aplikasi portal internal perusahaan',
            'created_by' => $qa->id,
        ]);

        $response = $this->actingAs($qa)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertSee('New Folder');
        $response->assertSee('Internal Portal');
        $response->assertSee('QA Officer Tester');
        $response->assertSee('Dibuat oleh');
    }

    public function test_can_create_duplicate_folder_names_with_different_creators_and_distinguish_them(): void
    {
        $qa1 = User::factory()->create(['role' => 'support_dev', 'name' => 'Zahra QA']);
        $qa2 = User::factory()->create(['role' => 'support_dev', 'name' => 'Obiwan QA']);

        $response1 = $this->actingAs($qa1)->post(route('projects.store'), [
            'name' => 'Socuit Duplicate',
            'description' => 'Socuit by Zahra',
        ]);
        $response1->assertStatus(302);

        $response2 = $this->actingAs($qa2)->post(route('projects.store'), [
            'name' => 'Socuit Duplicate',
            'description' => 'Socuit by Obiwan',
        ]);
        $response2->assertStatus(302);

        $this->assertEquals(2, Project::where('name', 'Socuit Duplicate')->count());

        $indexResponse = $this->actingAs($qa1)->get(route('projects.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Zahra QA');
        $indexResponse->assertSee('Obiwan QA');

        // Check dropdown in create bug form distinguishes them
        $createBugResponse = $this->actingAs($qa1)->get(route('bugs.create'));
        $createBugResponse->assertStatus(200);
        $createBugResponse->assertSee('Socuit Duplicate (oleh Zahra QA)');
        $createBugResponse->assertSee('Socuit Duplicate (oleh Obiwan QA)');
    }
}
