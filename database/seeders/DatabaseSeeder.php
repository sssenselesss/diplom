<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MainTaskCategory;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Task::factory(50)->create();
       User::query()->create([
           'name'=>'admin',
           'email'=>'admin@mail.ru',
           'phone_number'=>'89323421223',
           'city'=>'Kazan',
           'image'=>null,
           'password'=>Hash::make('adminadmin'),
           'role'=>'admin',
           'status'=>'active',
           'experience'=>null,
           'about'=>null,
           'remember_token'=>null,

       ]);

       MainTaskCategory::query()->create(['name'=>'Курьерские услуги']);
       MainTaskCategory::query()->create(['name'=>'Ремонт и строительство']);
       MainTaskCategory::query()->create(['name'=>'Грузоперевозки']);
       MainTaskCategory::query()->create(['name'=>'Компьютерная помощь']);
       MainTaskCategory::query()->create(['name'=>'Ремонт транспорта']);
       MainTaskCategory::query()->create(['name'=>'Репетиторы и обучение']);
       MainTaskCategory::query()->create(['name'=>'Ремонт цифровой техники']);
       MainTaskCategory::query()->create(['name'=>'Установка и ремонт техники']);
       MainTaskCategory::query()->create(['name'=>'мероприятия и промоакции']);

    }
}
