<?php

namespace Tests\Feature\Livewire\Todo;

use App\Http\Livewire\Todo\Index;
use App\Http\Livewire\Todo\Update;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_component_is_rendered()
    {
        $todo = Todo::factory()->for(User::factory()->create())->create();

        Livewire::test(Index::class, ['todo' => $todo])
            ->assertSet('todo', $todo)
            ->assertSee($todo->title);
    }

    /** @test */
    public function index_component_is_listening_to_updateTodoId_event()
    {
        $todo = Todo::factory()->for(User::factory()->create())->create();

        $component = Livewire::test(Index::class, ['todo' => $todo]);

        $this->assertEquals($todo->title, $component->todo->title);

        $todo->update(['title' => 'Updated Title...']);

        $component->assertSet('todo', $todo)
            ->emit('updateTodo-' . $todo->id)
            ->assertSee($todo->title);

        $this->assertEquals($todo->title, $component->todo->title);
    }
}
