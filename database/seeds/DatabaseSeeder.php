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

        App\Detalles::create([
          'nombres' => $faker->name,
          'apellidos' => $faker->lastName,
          'cedula' => $faker->numberBetween($min = 9000000, $max = 24999999),
          'tlf_personal' => $faker->randomNumber,
          'foto' => 'taylor-otwell.jpg'
        ]);

        App\User::create([
          'detalle_id' => 2,
          'email' => $faker->email,
          'password' => bcrypt('123456'),
          'nivel' => 2
        ]);

        App\Detalles::create([
          'nombres' => $faker->name,
          'apellidos' => $faker->lastName,
          'cedula' => $faker->numberBetween($min = 9000000, $max = 24999999),
          'tlf_personal' => $faker->randomNumber,
          'foto' => 'ccccc.jpg'
        ]);

        App\User::create([
          'detalle_id' => 3,
          'email' => $faker->email,
          'password' => bcrypt('123456'),
          'nivel' => 3
        ]);

        App\Detalles::create([
          'nombres' => $faker->name,
          'apellidos' => $faker->lastName,
          'cedula' => $faker->numberBetween($min = 9000000, $max = 24999999),
          'tlf_personal' => $faker->randomNumber,
          'foto' => 'asc.jpg'
        ]);

        App\User::create([
          'detalle_id' => 4,
          'email' => $faker->email,
          'password' => bcrypt('123456'),
          'nivel' => 4
        ]);

        App\Detalles::create([
          'nombres' => $faker->name,
          'apellidos' => $faker->lastName,
          'cedula' => $faker->numberBetween($min = 9000000, $max = 24999999),
          'tlf_personal' => $faker->randomNumber,
          'foto' => 'asccas.jpg'
        ]);

        App\User::create([
          'detalle_id' => 5,
          'email' => $faker->email,
          'password' => bcrypt('123456'),
          'nivel' => 4
        ]);

        App\Profesores::create([
          'user_id' => 2,
			    'direccion' => 'Maracay',
			    'profesion' => 'Ingeniero',
			    'descripcion_perfil' => 'un poco mas aqui.. Para que lean'
        ]);

        App\Curso::create([
		      'titulo' => 'Pintura al oleo',
		      'descripcion' => 'Curso de pintura al oleo',
		      'limit' => 10,
		      'foto' => 'pintar-al-oleo.jpg',
		      'id_profesor' => 1,
		      'precio' => 40000
        ]);

        App\Curso::create([
		      'titulo' => 'Manualidades',
		      'descripcion' => 'Curso de manualidades',
		      'limit' => 10,
		      'foto' => 'manualidades.jpg',
		      'id_profesor' => 1,
		      'precio' => 25000
        ]);

        App\Representante::create([
          'user_id' => 3,
					'residencia' => 'El rosal',
        	]);

        App\Estudiante::create([
          'user_id' => 4,
					'representante_id' => 1,
					'sexo' => 'M',
					'nacimiento' => '06-06-2003',
					'residencia' => 'El rosal',
					'alergico' => 0,
        ]);

        App\Estudiante::create([
          'user_id' => 5,
					'sexo' => 'M',
					'nacimiento' => '05-11-1992',
					'residencia' => 'Cagua',
					'alergico' => 0,
        ]);

        App\Galeria::create([
        	'titulo' => 'Cuadro #1',
        	'autor' => 'Admin',
        	'anio' => '2004',
        	'descripcion' => 'El primer cuadro agregado.',
        	'foto' => 'GILBERTO 22-10-2007 087.jpg'
        ]);

        App\Galeria::create([
        	'titulo' => 'Cuadro #2',
        	'autor' => 'Admin',
        	'anio' => '2009',
        	'descripcion' => 'El segundo cuadro agregado.',
        	'foto' => 'GILBERTO 22-10-2007 096.jpg'
        ]);

        App\Galeria::create([
        	'titulo' => 'Cuadro #3',
        	'autor' => 'Admin',
        	'anio' => '2012',
        	'descripcion' => 'El tercer cuadro agregado.',
        	'foto' => 'GILBERTO 22-10-2007 098.jpg'
        ]);

        App\Periodo::create([
          'periodo' => '2017-1',
          'status' => 1
        ]);

        App\Inscripcion::create([
        	'periodo_id' => 1,
        	'curso_id' => 1,
        	'estudiante_id' => 1
        ]);

        App\Inscripcion::create([
        	'periodo_id' => 1,
        	'curso_id' => 1,
        	'estudiante_id' => 2
        ]);

        App\Inscripcion::create([
        	'periodo_id' => 1,
        	'curso_id' => 2,
        	'estudiante_id' => 2
        ]);
    }
}
