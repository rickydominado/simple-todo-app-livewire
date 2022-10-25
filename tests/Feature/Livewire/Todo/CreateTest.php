<?php

namespace Tests\Feature\Livewire\Todo;

use App\Http\Livewire\Todo\Create;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_todo()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->set('title', 'Test Todo Title...')
            ->call('store')
            ->assertEmitted('refreshTodos');

        $this->assertTrue(Todo::whereTitle('Test Todo Title...')->exists());
    }

    /** @test */
    public function title_is_required()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->set('title', '')
            ->call('store')
            ->assertHasErrors(['title' => 'required']);
    }

    /** @test */
    public function minimum_of_8_characters_is_required()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->set('title', 'Sample')
            ->call('store')
            ->assertHasErrors(['title' => 'min']);
    }
}
