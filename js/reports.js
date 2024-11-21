
function loadSalesRegister(bussines_id){
    loadRegister("sales",bussines_id);		
}
function loadPurchaseRegister(bussines_id){
    loadRegister("purchases",bussines_id);	
}

function loadSoldOutRegister(bussines_id){
    var seccion_modulo = document.querySelector("#parte1");
    const data = {
        accion: "soldOuts",
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
//reporte detallado por fecha
async function loadReports(modulo, bussines_id = 1){
    var dia = document.getElementById('dia').value;
    var mes = document.getElementById('mes').value;
    var anho = document.getElementById('anho').value;        
    const seccion_modulo=document.getElementById('resultadoReporte');
    
    
    let data = {
        accion: "day",
        modulo:modulo,
        day:dia,
        month:mes,
        year:anho,
        bussines_id: bussines_id
    };

    if(dia=='' && mes!='' && anho!=''){
        data = {
            accion:"month",
            modulo:modulo,
            month:mes,
            year:anho,
            bussines_id: bussines_id
        };            
    }
    
    if(dia=='' && mes=='' && anho!=''){           
        data = {
            accion:"year",
            modulo:modulo,
            year:anho,
            bussines_id: bussines_id
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
//Reporte resumen
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


function loadInvoice(modulo,invoice_id,bussines_id,parte){
    var seccion_modulo = document.querySelector("#"+parte);
    const data = {
        accion: "loadInvoice",
        modulo:modulo,
        invoice_id:invoice_id,
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

function findInvoice(modulo,bussines_id,parte){
    var seccion_modulo = document.querySelector("#"+parte);
    const invoice_id = document.querySelector("#id").value;
    const data = {
        accion: "findInvoice",
        modulo:modulo,
        invoice_id:invoice_id,
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

async function loadListInvoiceBySelect(text,parte){
    const modulo = document.querySelector("#type_return").value;
    const data = {
        accion: "loadListInvoiceBySelect",
        modulo:modulo,
        text: text
    };
   
  if (text.length >=1) {
    try {
        const response = await axios.post("Controlador/ctrlReports.php", data); // Petición con Axios
        const invoices = response.data; // La respuesta ya está en formato JSON con Axios
        const listInvoices = document.getElementById(""+parte);
        listInvoices.innerHTML = "";
        // Agregar opciones al select
        invoices.forEach(invoice => {
            const option = document.createElement("option");
            option.value = invoice.id;
            option.textContent = `${invoice.date_at} - $${invoice.amount}`;
            listInvoices.appendChild(option);
        });
    } catch (error) {
        console.error("Error al cargar productos:", error);
    }    
  }		                   
}