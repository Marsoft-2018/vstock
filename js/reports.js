
function loadSalesRegister(bussines_id){
    loadRegister("sales",bussines_id);		
}
function loadPurchaseRegister(bussines_id){
    loadRegister("purchases",bussines_id);	
}

function loadSoldOutRegister(bussines_id){
    loadRegister("soldOuts",bussines_id);					
}

function loadStockReport(bussines_id){
    loadRegister("stock",bussines_id);	                   
}

function loadRegister(modulo,bussines_id){
    var seccion_modulo = document.querySelector("#parte1");
    const data = {
        accion: "index",
        modulo:modulo,
        bussines_id: bussines_id
    };
    axios
        .post("Controlador/ctrlReports.php", data)
        .then(function (res) {
        //console.log(res.data);
        if (res.status == 200) {
            seccion_modulo.innerHTML = res.data;
        }
        })
        .catch(function (err) {
        Swal.fire({
            position: "left-end",
            icon: "error",
            title: "Error",
            text: err,
        });
    });				
}

function loadReports(modulo){
        var dia = document.getElementById('dia').value;
        var mes = document.getElementById('mes').value;
        var anho = document.getElementById('anho').value;        
        const seccion_modulo=document.getElementById('resultadoReporte');
        
        
        let data = {
            accion: "day",
            modulo:modulo,
            day:dia,
            month:mes,
            year:anho
        };

        if(dia=='' && mes!='' && anho!=''){
            data = {
                accion:"month",
                modulo:modulo,
                month:mes,
                year:anho
            };            
        }
        
        if(dia=='' && mes=='' && anho!=''){           
            data = {
                accion:"year",
                modulo:modulo,
                year:anho
            };            
        }

        axios
            .post("Controlador/ctrlReports.php", data)
            .then(function (res) {
            //console.log(res.data);
            if (res.status == 200) {
                seccion_modulo.innerHTML = res.data;
            }
            })
            .catch(function (err) {
            Swal.fire({
                position: "left-end",
                icon: "error",
                title: "Error",
                text: err,
            });
        });	
        
}

function loadSummary(){
    var mes = document.getElementById('mes').value;
    var anho = document.getElementById('anho').value;       
    var modulo=document.getElementById('moduloRep').value;
            
    if(anho!=''){
        $("#resultadoResumen").load("Controlador/ctrlReports.php",{modulo:modulo,mes:mes,anho:anho,accion:"resumen"},function(){
            alertify.success("Resumen Anual cargado con éxito"); 
        });           
    }else{
        alertify.error("Por favor digite un año para poder realizar la consulta"); 
    }
    
}
