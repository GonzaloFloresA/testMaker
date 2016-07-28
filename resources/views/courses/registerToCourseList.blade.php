
@extends('layouts.master')

@section('content')
<div class="container-fluid">

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading" >
          <div class="row">
            <div class="col-md-4">
             <h4> Buscar Grupo de Materia</h4>
            </div>

            <div class="col-md-8" >
              <div class="row">
              <form class="form-inline col-md-offset-4" action="{{url('student/'.Auth::user()->id.'/coursesList')}}" method="get">

                  <div class="form-group">
                  <select class="form-control" name="attribute">
                    <option value="anio">Anio</option>
                    <option value="docente" >Docente</option>
                    <option value="materia" selected>Materia</option>
                  </select>
                  </div>
                  <div class="form-group">
                      <input type="text"  name="field" class="form-control" id="field" placeholder="Docente o Materia">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
              </form>
              </div>

            </div>
          </div>

        </div>

        <div class="panel-body">

            <table class="table table-bordered black">
              <thead>
                
                <th class="col-sm-1">Año</th>
                <th>Docente</th>
                <th>Materia</th>
                <th>Nro Grupo</th>
                <th class="col-sm-1">Semestre</th>
                <th class="col-sm-2">Carrera</th>
                <th>Acciones</th>
              </thead>
              <tbody>

               
                
                @foreach($groups as $group)
                  <tr>
                    
                    <td>
                      {{$group->year}}
                    </td> 
                    <td>
                      {{$group->teacherName}}
                    </td>
                    <td>
                      {{$group->courseName}}
                    </td>
                    <td>
                      {{$group->nro}}
                    </td>
                    <td>
                      {{$group->level}}
                    </td>
                    <td>
                      {{$group->careerName}}
                    </td>
                    <td class="text-center">
                      
          
            <a href="{{url('student/'.$group->id.'/confirmCourse')}}" class="btn btn-default btn-delete bg-green" data-toggle="tooltip" title="Inscribirse a Materia" >
                        <span >Inscribirse</span>
                      </a>
                    </td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
            <div class="row text-center">
                {!! $groups->render() !!}
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
