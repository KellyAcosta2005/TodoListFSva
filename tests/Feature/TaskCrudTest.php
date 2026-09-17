<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_index_page_loads(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/tasks');

        $response->assertOk();
    }

    public function test_guest_index_request_is_redirected_to_login(): void
    {
        $response = $this->get('/tasks');

        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_index_renders_edit_link_and_csrf_delete_form_for_each_task(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'description' => 'Pan integral',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this->get('/tasks');

        $response->assertOk();
        $response->assertSee(route('tasks.edit', $task), false);
        $response->assertSee(route('tasks.destroy', $task), false);
        $response->assertSee('name="_token"', false);
        $response->assertSee('name="_method" value="DELETE"', false);
        $response->assertSee('onsubmit="return confirm(', false);
    }

    public function test_tasks_create_page_loads(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/tasks/create');

        $response->assertOk();
    }

    public function test_guest_create_request_is_redirected_to_login(): void
    {
        $response = $this->get('/tasks/create');

        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_edit_page_renders_update_form_with_current_values(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'description' => 'Pan integral',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this->get('/tasks/'.$task->id.'/edit');

        $response->assertOk();
        $response->assertSee(route('tasks.update', $task), false);
        $response->assertSee('name="_method" value="PUT"', false);
        $response->assertSee('name="completed" value="0"', false);
        $response->assertSee('name="completed" value="1"', false);
        $response->assertSee('Comprar pan', false);
    }

    public function test_valid_update_persists_changes_including_unchecking_completed(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'description' => 'Pan integral',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this->put('/tasks/'.$task->id, [
            'title' => 'Comprar leche',
            'description' => 'Deslactosada',
            'completed' => 0,
            'manager_id' => $manager->id,
        ]);

        $response->assertRedirect(route('tasks.index', absolute: false));
        $response->assertSessionHas('success');
        $fresh = $task->fresh();
        $this->assertSame('Comprar leche', $fresh->title);
        $this->assertFalse($fresh->completed);
    }

    public function test_invalid_update_rejects_title_and_persists_nothing(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'description' => 'Pan integral',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this
            ->from('/tasks/'.$task->id.'/edit')
            ->put('/tasks/'.$task->id, [
                'title' => 'a',
                'description' => 'Pan integral',
                'completed' => 1,
                'manager_id' => $manager->id,
            ]);

        $response->assertInvalid(['title']);
        $response->assertSessionHasInput('title', 'a');
        $this->assertSame('Comprar pan', $task->fresh()->title);
    }

    public function test_guest_update_request_is_redirected_to_login_and_persists_nothing(): void
    {
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this->put('/tasks/'.$task->id, ['title' => 'Cambiado', 'manager_id' => $manager->id]);

        $response->assertRedirect(route('login', absolute: false));
        $this->assertGuest();
        $this->assertSame('Comprar pan', $task->fresh()->title);
    }

    public function test_guest_destroy_request_is_redirected_to_login_and_deletes_nothing(): void
    {
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this->delete('/tasks/'.$task->id);

        $response->assertRedirect(route('login', absolute: false));
        $this->assertGuest();
        $this->assertModelExists($task);
    }

    public function test_destroy_persists_deletion_for_authenticated_user(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        $task = Task::create([
            'title' => 'Comprar pan',
            'completed' => 1,
            'manager_id' => $manager->id,
        ]);

        $response = $this->delete('/tasks/'.$task->id);

        $response->assertRedirect(route('tasks.index', absolute: false));
        $response->assertSessionHas('success');
        $this->assertModelMissing($task);
    }
}
