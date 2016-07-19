@extends('layouts.master')
@section('content')
<section id="main-slider">
        <div class="owl-carousel">
            <div class="item" style="background-image: url({{ URL::asset('images/slider/exam2.jpg') }});">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
							<div class="carousel-caption">
                                <div class="carousel-content">
                                    <h2>Test Maker</h2>
                                    <p>Generador de Examenes en Linea</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
             <div class="item" style="background-image: url({{URL::asset('images/slider/book1.jpg')}});">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
							<div class="carousel-caption">
                                <div class="carousel-content">
                                    <h2>Test Maker</h2>
                                    <p>Generador de Examenes en Linea</p>
                                </div>
                            </div>
							</div>
                        </div> </div>
                    </div>
                    <div class="item" style="background-image: url({{ URL::asset('images/slider/exam3.jpg') }});">
                        <div class="slider-inner">
                            <div class="container">
                                <div class="row">
        							<div class="carousel-caption">
                                        <div class="carousel-content">
                                            <h2>Test Maker</h2>
                                            <p>Generador de Examenes en Linea</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/.item-->
                </div>
            </div><!--/.item-->
        </div><!--/.owl-carousel-->
    </section><!--/#main-slider-->

    <section id="services" >
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Nuestros Servicios</h2>
                <p class="text-center wow fadeInDown">Test Maker es el mejor sistema para la generacion de examenes en linea <br> para todos los profesionales de la educacion</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                        <div class="media service-box">
            <div class="hexagon">
              <div class="inner">
                <i class="fa fa-cogs"></i>
              </div>
            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Crea</h4>
                                <p>varios tipos de preguntas  de acuerdo a tus necesidades</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                        <div class="media service-box">
            <div class="hexagon">
              <div class="inner">
              <i class="fa fa-recycle"></i>
              </div>
            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Reusa</h4>
                                <p>preguntas para generar y personalizar tus examenes</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="200ms">
                        <div class="media service-box">
                <div class="hexagon">
              <div class="inner">
                                <i class="fa fa-sitemap"></i>
              </div>
            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Organiza</h4>
                                <p>de forma eficiente los examenes generado por categorias.</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
                        <div class="media service-box">

                <div class="hexagon">
              <div class="inner">
                                <i class="fa fa-check-square"></i>
              </div>
            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Califica</h4>
                                <p>a tus alumnos automaticamente</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms">
                        <div class="media service-box">
              <div class="hexagon">
              <div class="inner">
                                <i class="fa fa-file-pdf-o"></i>
              </div>
            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Genera</h4>
                                <p>los examenes y calificaciones de tus estudiantes en formato pdf.</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="500ms">
                        <div class="media service-box">
              <div class="hexagon">
              <div class="inner">
                                <i class="fa fa-clock-o"></i>
              </div>
            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Resultados</h4>
                                <p> inmediatamente para los estudiantes que rindan un examen</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

@stop
