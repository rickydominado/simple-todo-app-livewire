<?php

namespace Tests\Feature\Livewire\Task;

use App\Http\Livewire\Task\Index;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
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
    public function tasks_are_rendered()
    {
        $__task = $this->task;

        Livewire::test(Index::class, ['todo' => $this->todo])
            ->assertSet('todo', $this->todo)
            ->assertViewHas('tasks', function (Collection $tasks) use ($__task) {
                return $tasks->contains($__task);
            });
    }

    /** @test */
    public function index_is_listening_to_refreshTasks_event()
    {
        $__task = $this->task;

        $component = Livewire::test(Index::class, ['todo' => $this->todo])
            ->assertSet('todo', $this->todo)
            ->assertViewHas('tasks', function (Collection $tasks) use ($__task) {
                return $tasks->contains($__task);
            });

        $add_task = Task::factory()->for($this->todo)->create();

        $component->emit('refreshTasks-' . $this->todo->id)
            ->assertViewHas('tasks', function (Collection $tasks) use ($add_task) {
                return $tasks->contains($add_task);
            });
    }
}
