@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
    @include('common.messages')
    @include('common.error')
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >Materias Impartidas</div>
<div class="panel-body">

            <table class="table table-bordered black">
              <thead>
                <th class="col-sm-1">Nro Grupo</th>
                <th >Materia</th>
                <th>Usuario</th>
                
                <th class="col-sm-1">Semestre</th>
                
                <th>Acciones</th>
              </thead>
              <tbody>

               
                
                @foreach($courses as $course)
                  <tr>
                    <td>
                      {{$course->nro}}
                    </td>
                    <td>
                    <a href="{{url('student/'.$course->groupStudentId.'/status')}}" class="btn btn-default btn-delete bg-blue" data-toggle="Entrar al grupo" title="Entrar al Curso" >
                      {{$course->courseName}}  
                      </a>
                      
                    </td> 
                    <td>
                      {{$course->userName}}
                    </td>
                    
                    <td>
                      {{$course->semester}}
                    </td>
                    
                    <td class="text-center">
                      
          
            <a href="{{url('student/'.$course->groupStudentId.'/leaveGroupConfirm')}}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Abandonar Grupo" >
                        <span class="glyphicon glyphicon-log-out"></span>
                      </a>
                    </td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
            </div>
			</div>
		</div>
	</div>
</div>
@endsection
