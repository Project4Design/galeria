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

            App\Representante::create([
            	'nombres' => 'Jose',
							'apellidos' => 'Carmona',
							'cedula' => '2151647',
							'email' => 'Josecar@hotmail.com',
							'residencia' => 'El rosal',
							'tlf_personal' => '04122188731',
							'tlf_local' => '0412217751',
							'foto' => 'a',
            	]);

            App\Estudiante::create([	
							'representante_id' => 1,
							'nombres' => 'Ricardo',
							'apellidos' => 'Carmona',
							'email' => 'RicardoCarmona@gmail.com',
							'sexo' => 'M',
							'nacimiento' => '10/06/2003',
							'residencia' => 'El rosal',
							'alergico' => 0,
							'tlf_personal' => '024124124',
							'tlf_local' => '0412217751',
							'foto' => 'C',
            ]);
        }
    }
}
