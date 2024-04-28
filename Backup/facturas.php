<?

$factura=5558; //Ejemplo = 0058 
$tamNumero = strlen($factura); 

if($tamNumero==1) 
  $factura = "000$factura"; 
elseif ($tamNumero==2) 
  $factura = "00$factura"; 
elseif ($tamNumero == 3) 
  $factura = "0$factura"; 
  
echo $factura;
?>