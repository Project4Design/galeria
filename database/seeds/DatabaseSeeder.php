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

        //ADMIN
        App\Detalles::create([
          'nombres' => 'Test',
          'apellidos' => 'Developer',
          'cedula' => '20990397',
          'tlf_personal' => '12312312',
          'foto' => 'undas.jpg'
        ]);

        App\User::create([
          'detalle_id' => 1,
          'email' => 'admin@admin.com',
          'password' => bcrypt('123456'),
          'nivel' => 1
        ]);

        for($i = 1; $i < 4; $i++) {
            App\Detalles::create([
              'nombres' => $faker->name,
              'apellidos' => $faker->lastName,
              'cedula' => $faker->numberBetween($min = 9000000, $max = 24999999),
              'tlf_personal' => $faker->randomNumber,
              'foto' => $faker->word.'.jpg'
            ]);

            App\User::create([
              'detalle_id' => $i+1,
              'email' => $faker->email,
              'password' => bcrypt('123456'),
              'nivel' => $i+1
            ]);
        }

        App\Profesores::create([
          'user_id' => 2,
			    'direccion' => 'Maracay',
			    'profesion' => 'Ingeniero',
			    'descripcion_perfil' => 'un poco mas aqui.. Para que lean'
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
          'user_id' => 3,
					'residencia' => 'El rosal',
        	]);

        App\Estudiante::create([
          'user_id' => 4,
					'representante_id' => 1,
					'sexo' => 'M',
					'nacimiento' => '15-06-2003',
					'residencia' => 'El rosal',
					'alergico' => 0,
        ]);

        App\Galeria::create([
        	'titulo' => 'Cuadro #1',
        	'autor' => 'Admin',
        	'anio' => '2017',
        	'descripcion' => 'El primer cuadro agregado.',
        	'foto' => 'GILBERTO 22-10-2007 087.jpg'
        ]);

        App\Periodo::create([
          'periodo' => '2017-1',
          'status' => 1
        ]);
    }
}
