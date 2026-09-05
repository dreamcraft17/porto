<?php

namespace Tests\Feature\Admin;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminServiceCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_services(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)->get(route('admin.services.index'))
            ->assertOk();

        $this->actingAs($admin)->post(route('admin.services.store'), [
            'title' => 'API Integration',
            'description' => 'Connect business systems via REST APIs.',
            'icon' => 'fa-plug',
            'features' => ['REST APIs', 'Webhooks'],
            'order' => 1,
            'active' => true,
        ])->assertRedirect(route('admin.services.index'));

        $service = Service::first();
        $this->assertNotNull($service);

        $this->actingAs($admin)->put(route('admin.services.update', $service), [
            'title' => 'API Integration Updated',
            'description' => 'Updated description',
            'icon' => 'fa-plug',
            'order' => 2,
            'active' => true,
        ])->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'API Integration Updated',
        ]);

        $this->actingAs($admin)->put(route('admin.services.update', $service), [
            'title' => 'API Integration Updated',
            'description' => 'Updated description',
            'icon' => 'fa-plug',
            'order' => 2,
        ])->assertRedirect(route('admin.services.index'));

        $this->assertFalse($service->fresh()->active);

        $this->actingAs($admin)->delete(route('admin.services.destroy', $service))
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
