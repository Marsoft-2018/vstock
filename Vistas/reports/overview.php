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
<table class='table table-striped'>
    <thead>
        <tr >
            <?php
            if($data['month'] !=""){ 
            ?>
                <th>Mes</th>
                <th>Día</th>
            <?php 
            }else{
            ?>
                <th>Año</th>
                <th>Mes</th>
            <?php
            }
            ?>

            <th  style='text-align:right; padding-right:30px;'>Total</th>
            <th>Porcentaje logrado</th>
        </tr>
    </thead> 
    <tbody>                 
        <?php
            foreach ($registerData[1] as $value) { 
                $porcentaje = ($value['amount']*100)/$registerData[0];
                $color = 0;

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
            ?>
            <tr>
                <?php
                    if($data['month'] != ""){
                ?>
                        <td style='padding:10px; '><?php echo $meses[($data['month']-1)] ?></td>
                        <td style='padding:10px; '><?php echo $value['day'] ?></td>
                        <td style='padding:10px; text-align:right;padding-right:30px;'>$ <?php echo number_format($value['amount'], 0, ',', '.') ?></td>
                <?php
                    }else{
                ?>
                        <td style='padding:10px; '><?php echo $data['year'] ?></td>
                        <td style='padding:10px; '><?php echo $meses[($value['month']-1)] ?></td>
                        <td style='padding:10px; text-align:right;padding-right:30px;'>$ <?php echo number_format($value['amount'], 0, ',', '.') ?></td>
                <?php
                    }
                ?>
                <td style='padding:10px; width:50%;'>
                    <div class='progress' style='margin:2px;'>
                        <div class='progress-bar progress-bar-striped bg-<?php echo $semaforo[$color] ?>' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: <?php echo $porcentaje ?>%'>
                            <span><?php echo round($porcentaje,1) ?>% </span>
                        </div>
                    </div>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan='2' style='padding:10px; '>
            <h5>TOTAL</h5>
        </td>
        <td style='padding:10px; text-align:right;padding-right:30px;'>
           <h5>$ <?php echo number_format($registerData[0], 0, ',', '.') ?></h5> 
        </td>
        <td style='padding:10px; '>
            <div class='progress' style='margin:2px;'>
                <div class='progress-bar progress-bar-striped bg-<?php echo $semaforo[3] ?>' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                    <span>100% </span>
                </div>
            </div>
        </td>
    </tr>
    </tfoot>
</table>