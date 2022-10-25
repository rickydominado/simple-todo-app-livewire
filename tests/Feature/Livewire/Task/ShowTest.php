<?php

namespace Tests\Feature\Livewire\Task;

use App\Http\Livewire\Task\Show;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    private Todo $todo;
    private Task $task;

    public function setUp(): void
    {
        parent::setUp();

        $this->todo = Todo::factory()->for(User::factory()->create())->create();
        $this->task = Task::factory()->for($this->todo)->create();
    }

    /** @test */
    public function show_component_is_rendered()
    {
        Livewire::test(Show::class, ['task' => $this->task])
            ->assertSet('task', $this->task)
            ->assertSee($this->task->title);
    }

    /** @test */
    public function show_component_is_listening_to_updateTaskId_event()
    {
        $component = Livewire::test(Show::class, ['task' => $this->task]);

        $this->assertEquals($this->task->title, $component->task->title);

        $this->task->update(['title' => 'Updated Title...']);

        $component->assertSet('task', $this->task)
            ->emit('updateTask-' . $this->task->id)
            ->assertSee($this->task->title);

        $this->assertEquals($this->task->title, $component->task->title);
    }
}
