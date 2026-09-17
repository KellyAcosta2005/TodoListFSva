<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagerCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_index_request_is_redirected_to_login(): void
    {
        $response = $this->get('/managers');

        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_guest_store_request_is_redirected_to_login_and_creates_nothing(): void
    {
        $response = $this->post('/managers', ['name' => 'Ana', 'email' => 'ana@example.com']);

        $response->assertRedirect(route('login', absolute: false));
        $this->assertGuest();
        $this->assertSame(0, Manager::count());
    }

    public function test_guest_update_request_is_redirected_to_login_and_persists_nothing(): void
    {
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->put('/managers/'.$manager->id, ['name' => 'Luis', 'email' => 'luis@example.com']);

        $response->assertRedirect(route('login', absolute: false));
        $this->assertGuest();
        $this->assertSame('Ana', $manager->fresh()->name);
        $this->assertSame('ana@example.com', $manager->fresh()->email);
    }

    public function test_guest_destroy_request_is_redirected_to_login_and_deletes_nothing(): void
    {
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->delete('/managers/'.$manager->id);

        $response->assertRedirect(route('login', absolute: false));
        $this->assertGuest();
        $this->assertModelExists($manager);
    }

    public function test_index_page_loads_for_authenticated_user(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/managers');

        $response->assertOk();
    }

    public function test_index_renders_edit_link_and_csrf_delete_form_for_each_manager(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->get('/managers');

        $response->assertOk();
        $response->assertSee(route('managers.edit', $manager), false);
        $response->assertSee(route('managers.destroy', $manager), false);
        $response->assertSee('name="_token"', false);
        $response->assertSee('name="_method" value="DELETE"', false);
    }

    public function test_index_renders_confirmation_attribute_on_delete_button(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->get('/managers');

        $response->assertOk();
        $response->assertSee('onsubmit="return confirm(', false);
    }

    public function test_create_page_loads_for_authenticated_user(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/managers/create');

        $response->assertOk();
    }

    public function test_edit_page_renders_x_app_layout_and_update_form_fields(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->get('/managers/'.$manager->id.'/edit');

        $response->assertOk();
        $response->assertSee(route('managers.update', $manager), false);
        $response->assertSee('name="_method" value="PUT"', false);
        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('value="Ana"', false);
        $response->assertSee('value="ana@example.com"', false);
        $response->assertSee('Actualizar', false);
    }

    public function test_valid_update_persists_changes_and_redirects_to_index(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->put('/managers/'.$manager->id, [
            'name' => 'Ana Garcia',
            'email' => 'ana.garcia@example.com',
        ]);

        $response->assertRedirect(route('managers.index', absolute: false));
        $response->assertSessionHas('success');
        $this->assertSame('Ana Garcia', $manager->fresh()->name);
        $this->assertSame('ana.garcia@example.com', $manager->fresh()->email);
    }

    public function test_update_rejects_duplicate_email_and_persists_nothing(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);
        Manager::create(['name' => 'Luis', 'email' => 'luis@example.com']);

        $response = $this->put('/managers/'.$manager->id, ['name' => 'Ana Garcia', 'email' => 'luis@example.com']);

        $response->assertInvalid(['email' => 'Ese correo ya pertenece a otro responsable']);
        $this->assertSame('Ana', $manager->fresh()->name);
        $this->assertSame('ana@example.com', $manager->fresh()->email);
    }

    public function test_update_ignores_own_email_in_unique_check(): void
    {
        $this->actingAs(User::create(['name' => 'Yo', 'email' => 'yo@example.com', 'password' => 'password']));
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->put('/managers/'.$manager->id, ['name' => 'Ana Garcia', 'email' => 'ana@example.com']);

        $response->assertSessionHasNoErrors();
        $this->assertSame('Ana Garcia', $manager->fresh()->name);
    }

    public function test_destroy_persists_deletion_when_manager_has_no_tasks(): void
    {
        $this->actingAs(User::factory()->create());
        $manager = Manager::create(['name' => 'Ana', 'email' => 'ana@example.com']);

        $response = $this->delete('/managers/'.$manager->id);

        $response->assertRedirect(route('managers.index', absolute: false));
        $response->assertSessionHas('success');
        $this->assertModelMissing($manager);
    }
}
