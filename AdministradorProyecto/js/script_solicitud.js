const solicitudes = document.querySelector('#lista-solicitudes');
eventListeners();

function eventListeners(){
    if(solicitudes){
        solicitudes.addEventListener('click', eliminarSolicitud);
        solicitudes.addEventListener('click', aceptarSolicitud);
    }
}

function eliminarSolicitud(e){
    if(e.target.parentElement.classList.contains('btn-borrar')){
        //tomar el ID
        const id = e.target.parentElement.getAttribute('data-id');
        //Preguntar al usuario
        const respuesta = confirm('¿Estas Seguro(a)?');
        if(respuesta){
            //Llamado a Ajax
            //Crear el objeto
            const xhr = new XMLHttpRequest();
            //abrir la conexion
            xhr.open('GET', `inc/modelos/modelo-solicitud.php?id=${id}&accion=borrar`, true);

            //leer la respuesta
            xhr.onload = function() {
                if(this.status === 200){
                    const resultado = JSON.parse(xhr.responseText);

                    if(resultado.respuesta === 'correcto'){
                        //Eliminar el registro del DOM
                        e.target.parentElement.parentElement.parentElement.remove();
                        Swal({
                            type: 'success',
                            title: 'Usuario Eliminado',
                            text: '¡Solicitud Eliminada!'
                        })

                    }
                    else{
                        //Mostrar una notificacion
                        Swal({
                            type: 'error',
                            title: 'Error',
                            text: '¡Hubo un error!'
                        })
                    }

                }
            }

            //enviar la peticion
            xhr.send();
        }
    }
}

function aceptarSolicitud(e){
    if(e.target.parentElement.classList.contains('btn-aceptar')){
        //tomar el ID
        const id = e.target.parentElement.getAttribute('data-id');

        console.log('click Aceptar');
        console.log(id);
        //Preguntar al usuario
        const respuesta = confirm('¿Estas Seguro(a)?');
        if(respuesta){
            //Llamado a Ajax
            //Crear el objeto
            const xhr = new XMLHttpRequest();
            //abrir la conexion
            xhr.open('GET', `inc/modelos/modelo-solicitud.php?id=${id}&accion=aceptar`, true);

            //leer la respuesta
            xhr.onload = function() {
                if(this.status === 200){
                    const resultado = JSON.parse(xhr.responseText);

                    if(resultado.respuesta === 'correcto'){
                        //Eliminar el registro del DOM
                        e.target.parentElement.parentElement.parentElement.remove();
                        Swal({
                            type: 'success',
                            title: 'Usuario Acptado',
                            text: '¡Solicitud Aceptada!'
                        })

                    }
                    else{
                        //Mostrar una notificacion
                        Swal({
                            type: 'error',
                            title: 'Error',
                            text: '¡Hubo un error!'
                        })
                    }

                }
            }

            //enviar la peticion
            xhr.send();
        }
    }
}