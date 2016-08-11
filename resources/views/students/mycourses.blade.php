@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
    @include('common.messages')
    @include('common.error')
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >Mis Grupos</div>
				<div class="panel-body" id="pricing">
          <div class="container col-md-12">
          <div class="row">

            @foreach($groups as $group)
            <div class="col-sm-6 col-md-3">
              <div class="wow zoomIn" data-wow-duration="400ms" data-wow-delay="0ms">
                <ul class="pricing">
                  <li class="plan-header">
                    <div class="price-duration">
                      <span class="price">
                        <img src="{{URL::asset('images/book.jpg')}}" alt="" width="100px" />
                      </span>
                      <span class="duration">
                        Grupo {{ $group->nro }}
                      </span>
                    </div>
                    <div class="plan-name">
                      <p>
                        {{ $group->course->cod_sis }}
                      </p>
                      {{ $group->course->name }}
                    </div>
                  </li>
                  <!-- <li>
                    <p>Nique porriqua tquises dolorem desumquia doloresamet consectet adipisci.
							         Masagni dolores eoquie voluptate sequi saliquam quaerat voluptate.
                    </p>
                  </li> -->
                  <li class="plan-purchase">
                <a class="btn btn-primary" href="{{url('student/'.Auth::user()->id.'/group/'.$group->id)}}">Ver Contenido</a>
                  </li>
                </ul>
              </div>
            </div>
            @endforeach
          </div>

          </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
