<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class CreateUser extends Command
{
    protected $signature = 'app:create-user';

    protected $description = 'Makes a User';

    public function handle()
    {
        $email = $this->ask('Email address', 'user@example.com');
        $name = $this->ask('Name', 'Test user');
        $password = $this->ask('Password', 'password');

        User::create([
            'uuid' => Uuid::uuid4(),
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
        ]);
    }
}
