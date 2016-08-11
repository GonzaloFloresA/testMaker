<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		
		<title>Examen de Prueba</title>
		<style>

			
			
			header{
				top: 0;
				border-bottom: 1px solid bladk;
				padding-bottom: 0.3em;
				font-size: 0.8em;
			}

			#course{
				position: absolute;
				top: 0;
				right: 0;
				/* margin-left: 50em; */
			}

			#institution{
				
			}
			#container{
				
				margin-top: 1em;
				word-wrap:  break-word;
			}
			.row{
				margin-bottom: 0.8em;
			}

			#container #title{
				color: black;
				font-size: 1.2em;
				font-family: Helvetica;
				font-weight: bold;
				text-align: center;
				margin-bottom: 0.5em;
			}

			#container #description{
				margin-top: 1em;
				text-align: justify;
			}

			.pie{
				/* position: fixed; */
				/* top: 0px;
				position: fixed;
				text-align: center;
				width: 100%; */
				/* border-top: 1px solid black; */
				/* padding-top: 0.1em; */
				/* font-size: 1em; */
			}

			.multiple, .develop, .falsoVerdad, .complemento{
				text-align: justify;
				padding-right: 1em;
				font-family: 'Pacifico', cursive;
				word-wrap:  break-word;
				font-size: 0.9em;
				margin: 0;
			}

		</style>
	</head>
	<body>
		<header>
			<span id="institution">{{$exam->institution}}</span>
			<div id="course">{{$exam->name_course}}</div>
		</header>
		<div id="container">
			<div id="title">{{$exam->title}} </div>
			<div id="personal-info">
				<div class="row">
					<span id="name">Nombre: ..................................................................................................................      </span>
					<span id="cod_sis">Codigo Sis: ......................</span>
				</div>
				<div class="row">
					<span id="date">Fecha: ..............................................</span>
					<span id="group">Grupo: ............................................</span>
					<span id="sign">Firma: .............................................</span>
				</div>
			</div>
			
			<div id="description">{{$exam->description}}</div>
		
		</div>
		@yield('questions')
	
</div>
	</body>

</html>