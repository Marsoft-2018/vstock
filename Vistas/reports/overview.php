<?php
    $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $semaforo=array("danger","warning","info","success");
?>
<header id='encabezado' style='width:90%;visibility:hidden;'>
    <div style='width:99%;height:80px;'>
        <div style='width:40%;'>
            <!-- <img src='img/$logo' style='width:225px;margin:0px;float:left;'> -->
        </div>
        <div style='margin-left:10px;width:55%;font-size:12px;float:left;'>
            <span><h4 style='margin:0px;padding:0px;'>$nombreNegocio</h4></span>
            <span>Nit: $nit</span><br>
            <span>Direccion: $direccion. Teléfono: $tel</span><br>
            <span>Ciudad: $ciudad</span>
        </div>
    </div>
</header>
<h2>Reporte Consolidado</h2>
<br>
<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>
    <thead>
        <tr >
            <?php
            if($data['month'] !=""){ 
            ?>
                <th class='columna3'>Mes</th>
                <th class='columna1'>Día</th>
            <?php 
            }else{
            ?>
                <th class='columna1'>Año</th>
                <th class='columna3'>Mes</th>
            <?php
            }
            ?>

            <th class='columna3' style='text-align:right;padding-right:30px;'>Total</th>
            <th>Porcentaje logrado</th>
        </tr>
    </thead> 
    <tbody>                 
        <?php
            foreach ($registerData[1] as $value) { ?>
            <tr style='padding:0px;height:20px;'>
                <?php
                    if($data['month'] != ""){
                ?>
                        <td style='padding:1px;height:20px;'><?php echo $meses[($data['month']-1)] ?></td>
                        <td style='padding:1px;height:20px;'><?php echo $value['day'] ?></td>
                        <td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ <?php echo number_format($value['amount'], 0, ',', '.') ?></td>
                <?php
                    }else{
                ?>
                        <td style='padding:1px;height:20px;'><?php echo $data['year'] ?></td>
                        <td style='padding:1px;height:20px;'><?php echo $meses[($data['month']-1)] ?></td>
                        <td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ <?php echo number_format($value['amount'], 0, ',', '.') ?></td>
                <?php
                    }
                ?>
            </tr>
        <?php
            }
        ?>
    while ($m=mysql_fetch_array($sqlMes)){
        
        <td style='padding:1px;height:20px;width:600px;'>
                $porcentaje=($m[1]*100)/$total;
                $color=0;

                switch($porcentaje){
                    case ($porcentaje <= 20):
                        $color=0;
                        break;
                    case ($porcentaje<=50):
                        $color=1;
                        break;
                    case ($porcentaje<=80):
                        $color=2;
                        break;
                    case ($porcentaje<=100):
                        $color=3;
                        break;                            
                }                    
                //barra de progreso
                <div class='progress' style='margin:2px;'>
                <div class='progress-bar progress-bar-$semaforo[$color]' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: ".$porcentaje."%'><span>".round($porcentaje,1)."% </span>
                </div>
                </div>
        </td>
        </tr>
    }
        
    </tbody>
    <tfoot>
    <tr>
        <td colspan='2' style='padding:1px;height:20px;'>
            <h5>TOTAL $modulo</h5>
        </td>
        <td>
            $ ".number_format($total, 0, ',', '.')
        </td>
        <td style='padding:1px;height:20px;'>
            <div class='progress' style='margin:2px;'>
                <div class='progress-bar progress-bar-$semaforo[3]' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                    <span>100% </span>
                </div>
            </div>
        </td>
    </tr>
    </tfoot>
</table>