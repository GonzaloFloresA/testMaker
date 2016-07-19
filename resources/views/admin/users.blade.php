@extends('layouts.master')
@section('content')
<div class="row">
	<h1 class="text-center">Lista de Usuarios Registrados</h1>
	
	<div class="col-md-1"></div>
	<div class="col-md-10">
    @include('admin.tools')
    <table class="table table-bordered table-hover">
    	<thead class="thead-inverse text-center">
            <th> </th>
    	    <th>Imagen</th>
    		<th>Nombre</th>
    		<th>Email</th>
    		<th>Telefono</th>
            <th>Activo</th>
            <th>Tipo</th>
    	</thead>
    	<tbody>
    	@foreach ($users as $user)
    		<tr>
                <td><input type="checkbox"></td>
    		    <td>
                    @if ($user->user_img != '')
    		        <img src="images/users_photo/{{$user->user_img}}" alt="default" class="img-circle" width="30px" height="30px">
    		        @else
    		        <img src="images/users_photo/default_avatar.png" alt="default" class="img-circle" width="30px" height="30px">
    		        @endif
    		    </td>    			
    		    <td>{{$user->name}}</td>
    			<td>{{$user->email}}</td>
    			<td>{{$user->phone}}</td>
    			<td>{{$user->active}}</td>
    			<td>{{$user->type}}</td>
    		</tr>
    	@endforeach
    	</tbody>
    </table>


	</div>
	<div class="col-md-1"></div>

</div>
@stop
