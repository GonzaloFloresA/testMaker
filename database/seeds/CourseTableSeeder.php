<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Course;

class CourseTableSeeder extends Seeder{


  public function run(){
    DB::table('courses')->delete();

    Course::create(['cod_sis' => '2010020',
                    'name'    => 'Ingenieria de Software']);
    Course::create(['cod_sis' => '2010047',
                    'name'    => 'Redes de Computadoras']);
    Course::create(['cod_sis' => '2010049',
                    'name'    => 'Estructura y Semantica de Lenguajes']);
    Course::create(['cod_sis' => '2010053',
                    'name'    => 'Taller de Base de Datos']);
    Course::create(['cod_sis' => '2010202',
                    'name'    => 'Inteligencia Artificial 2']);
    Course::create(['cod_sis' => '2010203',
                    'name'    => 'Programacion Web']);

  }
}
