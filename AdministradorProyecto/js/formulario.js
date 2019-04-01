eventListener();

function eventListener(){
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}

function validarRegistro(e){
    e.preventDefault();

    var usuario = document.querySelector('#usuario').value,
        correo='';
        password = document.querySelector('#password').value,
        tipo= document.querySelector('#tipo').value;
        if(tipo === 'crear'){
            correo = document.querySelector('#correo').value;
            if(document.querySelector('#tipoUsuario').checked){
                console.log('selecciono admin');
                tipoUsuario = parseInt(document.querySelector('#tipoUsuario').value);
                console.log(tipoUsuario);
            }else{
                tipoUsuario  = 0;
            }
            if(usuario === '' || password === '' || correo === ''){
                // la validacion fallo
                Swal({
                    type: 'error',
                    title: 'Error',
                    text: '¡Todos los campos son obligatorios!'
                  });
            }
        }
        if(usuario === '' || password === ''){
            // la validacion fallo
            Swal({
                type: 'error',
                title: 'Error',
                text: '¡Todos los campos son obligatorios!'
              });
        }
        
        else{
            // todos los campos son correctos, mandar ejecutar Ajax

            //Datos que se envian al serividor
            var datos = new FormData();
            datos.append('usuario', usuario);            
            datos.append('password', password);
            datos.append('accion', tipo);
            if(tipo === 'crear'){
                datos.append('correo', correo);
                datos.append('tipo', tipoUsuario);
            }

            // Llamado a Ajax
            //crear el llmado a Ajax
            var xhr = new XMLHttpRequest();

            // abrir la conexion
            xhr.open('POST', 'inc/modelos/modelo-cuenta.php', true);

            // retorno de datos
            xhr.onload = function(){
                if(this.status === 200){
                    var respuesta = JSON.parse(xhr.responseText);
                    
                    //Si la respuesta es correcta
                    if(respuesta.respuesta === 'correcto'){
                        //si es un nuevo usuario
                        if(respuesta.tipo === 'crear'){
                            Swal({
                                type: 'success',
                                title: 'Usuario Creado',
                                text: '¡El solicitud enviada!'
                            })
                            .then(resultado => {
                                if(resultado.value){
                                    window.location.href = 'index.php';
                                }
                            })
                        }
                        else if(respuesta.tipo === 'login'){
                            swal({
                                type: 'success',
                                title: 'Login Correcto',
                                text: '¡Presiona OK para abrir el dashboard!'
                            })
                            .then(resultado => {
                                if(resultado.value){
                                    window.location.href = 'index.php';
                                }
                            })
                        }
                    }
                    else if(respuesta.respuesta === 'error_usuario'){
                        Swal({
                            type: 'error',
                            title: 'Error',
                            text: '¡El Usuario ya existe!'
                          })
                          window.setTimeout(function () {
                            var form = document.querySelector('#formulario');
                            form.reset();
                          }, 1000);
                        }
                        else if(respuesta.respuesta === 'error_correo'){
                            Swal({
                                type: 'error',
                                title: 'Error',
                                text: '¡El Correo ya existe!'
                            })
                            window.setTimeout(function () {
                                var form = document.querySelector('#formulario');
                                form.reset();
                            }, 1000);
                        }
                        else{
                            //hubo un error
                            Swal({
                                type: 'error',
                                title: 'Error',
                                text: '¡Hubo un error!'
                            })
                            window.setTimeout(function () {
                                var form = document.querySelector('#formulario');
                                form.reset();
                            }, 1000);
                    }
                }
            }

            //enviar la peticion
            xhr.send(datos);
        }
}