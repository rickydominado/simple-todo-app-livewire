<?php

namespace Tests\Feature\Livewire\Task;

use App\Http\Livewire\Task\Destroy;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_a_task()
    {
        $task = Task::factory()->for(Todo::factory()->for(User::factory()->create())->create())->create();

        Livewire::test(Destroy::class)
            ->emit('deleteTask', $task->id)
            ->call('destroy')
            ->assertEmitted('refreshTasks-' . $task->todo->id);

        $this->assertTrue(Task::whereTitle($task->title)->doesntExist());
    }
}
