<?php

namespace Tests\Feature\Livewire\Todo;

use App\Http\Livewire\Todo\Edit;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    private Todo $todo;

    public function setUp(): void
    {
        parent::setUp();

        $this->todo = Todo::factory()->for(User::factory()->create())->create();
    }

    /** @test */
    public function user_can_edit_todo_title()
    {
        Livewire::test(Edit::class)
            ->emit('updateTodo', $this->todo->id)
            ->set('todo.title', 'Update Todo Title...')
            ->call('update')
            ->assertEmitted('updateTodo-' . $this->todo->id);

        $this->assertTrue(Todo::whereTitle('Update Todo Title...')->exists());
    }

    /** @test */
    public function title_is_required_when_updating()
    {
        Livewire::test(Edit::class)
            ->emit('updateTodo', $this->todo->id)
            ->set('todo.title', '')
            ->call('update')
            ->assertHasErrors(['todo.title' => 'required']);
    }

    /** @test */
    public function minimum_of_8_characters_is_required_when_updating_a_title()
    {
        Livewire::test(Edit::class)
            ->emit('updateTodo', $this->todo->id)
            ->set('todo.title', 'Sample')
            ->call('update')
            ->assertHasErrors(['todo.title' => 'min']);
    }
}
