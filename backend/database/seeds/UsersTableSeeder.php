<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role'              => 'general',
            'name'              => '一般ユーザー1',
            'email'             => 'user1@example.com',
            'password'          => \Hash::make('12345678'),
            'remember_token'    => Str_random(10),
        ]);

        DB::table('users')->insert([
            'role'              => 'general',
            'name'              => '一般ユーザー2',
            'email'             => 'user2@example.com',
            'password'          => \Hash::make('12345678'),
            'remember_token'    => Str_random(10),
        ]);

        DB::table('users')->insert([
            'role'              => 'general',
            'name'              => '一般ユーザー3',
            'email'             => 'user3@example.com',
            'password'          => \Hash::make('12345678'),
            'remember_token'    => Str_random(10),
        ]);

        DB::table('users')->insert([
            'role'              => 'owner',
            'name'              => 'オーナー1',
            'email'             => 'admin1@example.com',
            'password'          => \Hash::make('12345678'),
            'remember_token'    => Str_random(10),
        ]);

        DB::table('users')->insert([
            'role'              => 'owner',
            'name'              => 'オーナー2',
            'email'             => 'admin2@example.com',
            'password'          => \Hash::make('12345678'),
            'remember_token'    => Str_random(10),
        ]);
    }

}