
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

async function loadReports(modulo){
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

    await axios
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

async function loadOverview(modulo){
    var mes = document.getElementById('mes').value;
    var anho = document.getElementById('anho').value;        
    const seccion_modulo=document.getElementById('resultadoResumen');
    
    
    let data = {
        accion: "overview",
        modulo:modulo,
        month:mes,
        year:anho
    };

    await axios
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
