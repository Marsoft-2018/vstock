    <?
		$antes="2010-10-01";
		$hoy="2010-10-26";
		$antes2;
		$hoy2;
		$fechaHoy = explode('-',$hoy); 
		$fechaantes=explode('-',$antes);
		$hoy2=$fechaHoy[1]+$fechaHoy[2];
		$antes2=$fechaantes[1]+$fechaantes[2];
		echo "Despues del explode: ".  $hoy2  ."<br>";
		echo "Despues del explode: ".$antes2 ."<br>";
		$total=$hoy2-$antes2;
		echo "Resta para dias ".$total."<br>";
		
	?>