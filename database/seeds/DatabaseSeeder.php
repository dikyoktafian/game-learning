<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            [
                'name' => 'superadministrator',
            ],
            [
                'name' => 'teacher',
            ],
        ]);

        DB::table('subjects')->insert([
            [
                'name' => 'Bahasa Inggris',
            ],
            [
                'name' => 'Bahasa Indonesia',
            ],
            [
                'name' => 'Sejarah',
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Superadministrator',
                'email' => 'superadministrator@app.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'subject_id' => null,
            ],
            [
                'name' => 'Teacher 1',
                'email' => 'teacher@app.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'subject_id' => 1,
            ],
            [
                'name' => 'Teacher 2',
                'email' => 'teacher2@app.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'subject_id' => 2,
            ],
            [
                'name' => 'Teacher 3',
                'email' => 'teacher3@app.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'subject_id' => 3,
            ]
        ]);

        DB::table('members')->insert([
            [
                'name' => 'Student 1',
                'email' => 'student@app.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Student 2',
                'email' => 'student2@app.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Student 3',
                'email' => 'student3@app.com',
                'password' => Hash::make('password'),
            ],
        ]);

        DB::table('classrooms')->insert([
            [
                'name' => 'Kelas 10',
            ],
        ]);

        DB::table('classroom_details')->insert([
            [
                'classroom_id' => 1,
                'member_id' => 1,
            ],
            [
                'classroom_id' => 1,
                'member_id' => 2,
            ],
            [
                'classroom_id' => 1,
                'member_id' => 3,
            ],
        ]);


    }
}
