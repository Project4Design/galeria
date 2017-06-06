<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create();

        for($i = 0; $i < 1; $i++) {
            App\User::create([
                'nombre' => 'Test',
                'apellido' => 'Developer',
                'email' => 'admin@admin.com',
                'cedula' => '20990397',
                'telefono' => '0416-9658798',
                'password' => bcrypt('123456'),
                'nivel' => '1'
               
            ]);
        }
    }
}
