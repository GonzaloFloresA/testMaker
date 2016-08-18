<? 

function obtenCaracterAleatorio($arreglo) {
		$clave_aleatoria = array_rand($arreglo, 1);	
		return $arreglo[ $clave_aleatoria ];	
	}
 
	function obtenCaracterMd5($car) {
		$md5Car = md5($car.Time());	
		$arrCar = str_split(strtoupper($md5Car));	
		$carToken = obtenCaracterAleatorio($arrCar);	
		return $carToken;
	}
 
	function obtenToken() {
		
		$mayus = "ABCDEFGHIJKMNPQRSTUVWXYZ";
		$mayusculas = str_split($mayus);	
		$numeros = range(0,9);
		shuffle($mayusculas);
		shuffle($numeros);		
		$arregloTotal = array_merge($mayusculas,$numeros);
		$newToken = "";
		
		for($i=0;$i<=10;$i++) {
				$miCar = obtenCaracterAleatorio($arregloTotal);
				$newToken .= obtenCaracterMd5($miCar);
		}
		return $newToken;
	}
 
	
	?>