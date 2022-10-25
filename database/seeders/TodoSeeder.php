<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Testuser',
            'email' => 'testuser@email.com',
            'password' => Hash::make('test1234'),
        ]);

        Todo::factory()
            ->count(10)
            ->for($user)
            ->create();
    }
}
