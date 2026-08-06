<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $members = Member::factory(20)->create();

        foreach ($members as $member) {
            Payment::factory(rand(1, 5))->create(['member_id' => $member->id]);
        }

        Notification::factory(15)->create();
    }
}
