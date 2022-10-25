<?php

namespace Tests\Feature\Livewire\Task;

use App\Http\Livewire\Task\Create;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    private Todo $todo;

    public function setUp(): void
    {
        parent::setUp();

        $this->todo = Todo::factory()->for(User::factory()->create())->create();
    }

    /** @test */
    public function user_can_create_tasks()
    {
        Livewire::test(Create::class)
            ->emit('createTask', $this->todo->id)
            ->set('title', 'Task title...')
            ->call('store')
            ->assertEmitted('refreshTasks-' . $this->todo->id);

        $this->assertTrue(Task::whereTitle('Task title...')->exists());
    }

    /** @test */
    public function title_is_required()
    {
        Livewire::test(Create::class)
            ->emit('createTask', $this->todo->id)
            ->set('title', '')
            ->call('store')
            ->assertHasErrors(['title' => 'required']);
    }

    /** @test */
    public function minimum_of_8_characters_is_required()
    {
        Livewire::test(Create::class)
            ->emit('createTask', $this->todo->id)
            ->set('title', 'Sample')
            ->call('store')
            ->assertHasErrors(['title' => 'min']);
    }
}
