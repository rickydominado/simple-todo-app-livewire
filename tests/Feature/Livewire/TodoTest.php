<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private \App\Models\Todo $todo;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->todo = \App\Models\Todo::factory()->for($this->user)->create();
    }


    /** @test */
    public function todo_component_is_rendered()
    {
        $this->actingAs($this->user);

        $__todo = $this->todo;

        Livewire::test(Todo::class)
            ->assertViewHas('todos', function (Collection $todos) use ($__todo) {
                return $todos->contains($__todo);
            });
    }

    /** @test */
    public function todo_component_is_listening_to_refreshTodos_event()
    {
        $this->actingAs($this->user);

        $__todo = $this->todo;

        $component = Livewire::test(Todo::class)
            ->assertViewHas('todos', function (Collection $todos) use ($__todo) {
                return $todos->contains($__todo);
            });

        $add_todo = \App\Models\Todo::factory()->for($this->user)->create();

        $component->assertViewIs('livewire.todo')
            ->emit('refreshTodos')
            ->assertViewHas('todos', function (Collection $todos) use ($add_todo) {
                return $todos->contains($add_todo);
            });
    }
}
