<?php

namespace Tests\Feature\Livewire\Todo;

use App\Http\Livewire\Todo\Destroy;
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
    public function user_can_delete_a_todo()
    {
        $todo = Todo::factory()->for(User::factory()->create())->create();

        Livewire::test(Destroy::class)
            ->emit('deleteTodo', $todo->id)
            ->call('destroy')
            ->assertEmitted('refreshTodos');

        $this->assertTrue(Todo::whereTitle($todo->title)->doesntExist());
    }
}
