<?php

namespace Tests\Feature\Livewire\Task;

use App\Http\Livewire\Task\Edit;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    private Task $task;

    public function setUp(): void
    {
        parent::setUp();

        $this->task = Task::factory()->for(Todo::factory()->for(User::factory()->create())->create())->create();
    }

    /** @test */
    public function user_can_edit_a_task()
    {
        Livewire::test(Edit::class)
            ->emit('updateTask', $this->task->id)
            ->set('task.title', 'Updated Title...')
            ->call('update')
            ->assertEmitted('updateTask-' . $this->task->id);

        $this->assertTrue(Task::whereTitle('Updated Title...')->exists());
    }

    /** @test */
    public function title_is_required()
    {
        Livewire::test(Edit::class)
            ->emit('updateTask', $this->task->id)
            ->set('task.title', '')
            ->call('update')
            ->assertHasErrors(['task.title' => 'required']);
    }

    /** @test */
    public function minimum_of_8_characters_is_required()
    {
        Livewire::test(Edit::class)
            ->emit('updateTask', $this->task->id)
            ->set('task.title', 'Sample')
            ->call('update')
            ->assertHasErrors(['task.title' => 'min']);
    }
}
