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

            App\Profesores::create([
					    'cedula' => '13587532',
					    'nombre' => 'Carlos',
					    'apellido' => 'Azaurte',
					    'email' => 'cazaurte@cfl.com',
					    'telefono' => '042342342',
					    'direccion' => 'Maracay',
					    'profesion' => 'Ingeniero',
					    'descripcion_perfil' => 'un poco mas aqui.. Para que lean',
					    'foto' => 'c'
            ]);

            App\Curso::create([
				      'titulo' => 'pintura a acuarela',
				      'descripcion' => 'Curso de pintura al oleo',
				      'limit' => 10,
				      'foto' => 'pintar-al-oleo.jpg',
				      'id_profesor' => 1,
				      'precio' => 40000
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
							'cedula' => '21031565',
							'email' => 'RicardoCarmona@gmail.com',
							'sexo' => 'M',
							'nacimiento' => '15-06-2003',
							'residencia' => 'El rosal',
							'alergico' => 0,
							'tlf_personal' => '024124124',
							'tlf_local' => '0412217751',
							'foto' => 'C',
            ]);

            App\Galeria::create([
            	'titulo' => 'Cuadro #1',
            	'autor' => 'Admin',
            	'anio' => '2017',
            	'descripcion' => 'El primer cuadro agregado.',
            	'foto' => 'GILBERTO 22-10-2007 087.jpg'
            ]);
        }
    }
}
