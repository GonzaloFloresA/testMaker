@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Carreras</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

          <table class="table table-bordered">
            <thead>
              <th>Nombre</th>
              <th>Abreviacion</th>
            </thead>
            <tbody>
              <tr>
                <form class="form-inline" action="{{url('admin/career')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <td>
                  <input  class="form-control" type="text" name="name" value="">
                </td>
                <td>
                  <input  class="form-control" type="text" name="abbr" value="">
                </td>
                <td class="text-center">
                  <button  class="btn btn-default btn-create" type="submit" name="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </td>
                </form>
              </tr>
              @foreach($careers as $career)
                <tr>
                  <td>
                    {{$career->name}}
                  </td>
                  <td>
                    {{$career->abbr}}
                  </td>
                  <td class="text-center">
                    <a href="{{url('admin/career/'.$career->id.'/edit')}}" class="btn btn-default btn-edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href="{{url('admin/career/'.$career->id.'/delete')}}" class="btn btn-default btn-delete" ><i class="fa fa-trash" aria-hidden="true"></i></a>
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
