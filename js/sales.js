
function cargarVentas(bussines_id){
    var seccion_modulo =document.querySelector('#parte1');
    var data = {
        'accion': 'new',
        'bussines_id': bussines_id
    }

    axios.post('Controlador/ctrlVentas.php', data)
        .then(function(res) {
           //console.log(res.data);
            if(res.status == 200) {
                seccion_modulo.innerHTML = res.data;                
            }
        })
        .catch(function(err) {
            Swal.fire({
                position: "left-end",
                icon: 'error',
                title: 'Error',
                text: err
            });
        }
    );    
    
}	