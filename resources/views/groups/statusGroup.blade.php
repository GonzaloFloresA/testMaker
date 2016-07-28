@extends('layouts.master')

@section('content')
<div class="container-fluid">
  @include('common.messages')
  @include('common.error')
  <!-- @include('common.notifications') -->
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class=" green panel-heading"> 
          Grupo Nro {{$groupStudent->group->nro}} - <h4>{{$groupStudent->group->course->name}}</h4>
          
         Server Time {{ date("G:H:s")}}</div>
				<div class="panel-body">
          <p>Docente : <strong>{{$groupStudent->group->teacher->user->name}}</strong></p>
          <p>Semestre : <strong>{{$groupStudent->group->semester}}</strong></p>
          <p>Anio : <strong>{{$groupStudent->group->year}}</strong></p>
					<p>BIENVENIDO A {{$groupStudent->group->course->name}} - WELCOME TO {{$groupStudent->group->course->name}}

ESTIMADO ESTUDIANTE,

ESTA  PÁGINA ES NUESTRO PUNTO DE ENCUENTRO Y CENTRO DE RECURSOS.  AQUI ENCONTRARÁS MENSAJES, LOS TEXTOS, EJERCICIOS Y NOTAS.

PARA UTILIZAR ESTA PÁGINA DEBE ABRIR SU CUENTA!

LE DESEAMOS MUCHO TRABAJO Y LA SATISFACCIÓN DEL DEBER CUMPLIDO

SUS DOCENTES

  </p>
          

				</div>
			</div>

<div class="panel panel-info">
        <div class=" green panel-heading"> Course Description</div>
        <div class="panel-body">
          <p>1. Introducción a la ingeniería de software </p>
<p>2. Administración de proyectos de software</p>
<p>3. Análisis de requerimientos del software
·         Método Estructurado</p>
<p>4. Diseño e implantación del software</p>
<p>·         Diseño de Interfaces Gráficas</p>
<p>5. Administración de la calidad del software</p>
<p>6. Métodos de prueba del software</p>
<p>·         Ejemplo </p>
<p>·         Pruebas de caja negra</p>

        </div>
      </div>

<div class="panel panel-warning">
        <div class=" green panel-heading"> Agenda</div>
        <div class="panel-body">
          --vacio--
        </div>
      </div>

<div class="panel panel-danger">
        <div class=" green panel-heading"> EXAMENES EN LINEA</div>
        <div class="panel-body">
        <a href="{{url('student/'.$groupStudent->groupStudentId.'/status')}}" class="btn btn-default btn-delete bg-red" data-toggle="Entrar al grupo" title="Iniciar Examen Primer Parcial" >
                      Examen de Primer Parcial
                      </a> <br><br>
                      <a href="{{url('student/'.$groupStudent->groupStudentId.'/status')}}" class="btn btn-default btn-delete bg-red" data-toggle="Entrar al grupo" title="Iniciar Examen Segundo Parcial" >
                      Examen de Segundo Parcial
                      </a> <br><br>
                      <a href="{{url('student/'.$groupStudent->groupStudentId.'/status')}}" class="btn btn-default btn-delete bg-red" data-toggle="Entrar al grupo" title="Iniciar Examen Final" >
                      Examen Final
                      </a> <br><br>
                      
          
          
          
        </div>
      </div>


		</div>
	</div>
</div>
@endsection
