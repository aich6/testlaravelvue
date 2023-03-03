<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use App\Models\UserSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSubjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::paginate(5);
        $subjects = Subject::paginate(5);

        foreach ($users as $user) {
            foreach ($subjects as $subject) {
                UserSubject::firstOrCreate([
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
