document.addEventListener("DOMContentLoaded",()=>{
    iniciarApp.iniciar();
})
const iniciarApp = (function(){
return {
    iniciar:function (){
       tab.tabs(); 
       consultarAPI.index();
    }

}
})()

const tab = (function(){
    let paso = 1
    const pasoinicial = 1
    const pasofinal = 3;
    const botones = document.querySelectorAll('.tabs button');
    const anterior = document.getElementById('anterior');
    const siguiente = document.getElementById('siguiente');
    


    function mostrarSeccion(){
     const seccionAnterior = document.querySelector('.mostrar');
        if (seccionAnterior) {
            
            seccionAnterior.classList.remove('mostrar');
        }


        const seccion = document.querySelector(`#paso-${paso}`);
        seccion.classList.add('mostrar');
 
    }
    function cambiarAactual (){
        const tabAnterior = document.querySelector('.actual');
        if(tabAnterior){
            tabAnterior.classList.remove('actual');
        }
        const bat = document.querySelector(`[data-paso="${paso}"]`)    
        bat.classList.add('actual')

    }
    function iterarBotones(num = 0){
        botones.forEach((e)=>{
                e.addEventListener('click',(e)=>{
                    paso = parseInt(e.target.dataset.paso);
                    botonesPaginador();
                    cambiarAactual();         
                      mostrarSeccion();
             
                        

                })
        });
    }
     function botonesPaginador(){
   

        if(paso === 1){
            anterior.classList.add('ocultar');
            siguiente.classList.remove('ocultar');
        }else if(paso === 3){
            anterior.classList.remove('ocultar');
            siguiente.classList.add('ocultar');
            consultarAPI.resumen();
            
        }else{
            anterior.classList.remove('ocultar');
            siguiente.classList.remove('ocultar');
        }



      mostrarSeccion();
        cambiarAactual()
     }
     function Paginasiguiente(){
        siguiente.addEventListener('click', ()=>{
            if (paso >= pasofinal) return;
            paso++
            botonesPaginador();
        });
    }
    function Paginaanterior(){
        anterior.addEventListener('click', ()=>{
            if (paso <= pasoinicial) return;
            paso--
            botonesPaginador();
        });
    }

    return{
        tabs:function(){
            iterarBotones();
            mostrarSeccion();
            botonesPaginador();
            Paginaanterior();
            Paginasiguiente();
        }   
    }
})()
const cita ={
    id:"",
    nombre:'',
    fecha:'',
    hora:'',
    servicios:[]

}
const consultarAPI = (function(){
    async function api(){
        try {
            const url = '/api/servicios';
            const resultado = await fetch(url) 
            const respuesta  = await resultado.json()
            mostrarServicios(respuesta);
        } catch (error) {
            console.log(error)
        }
        
    }
    function mostrarServicios(respuesta){
        respuesta.forEach((e)=>{
            const {id, nombre, precio} = e;

            const nombreServicio = document.createElement("P");
            nombreServicio.classList.add('nombre-servicio');
            nombreServicio.textContent = nombre

            const precioServicio = document.createElement("P");
            precioServicio.classList.add('precio-servicio');
            precioServicio.textContent = `$ ${precio}`

            const servicioDiv = document.createElement("Div");
            servicioDiv.classList.add('servicio');
            servicioDiv.dataset.idServicio = id;
            servicioDiv.onclick = function(){
                seleccionarServicio(e);
            }

            servicioDiv.appendChild(nombreServicio);
            servicioDiv.appendChild(precioServicio);

            document.querySelector('#servicios').appendChild(servicioDiv);
        });
    }
    function seleccionarServicio(res){
        const {servicios}  = cita;   
        const {id} = res;

        if(servicios.some(e=>e.id === id)){
            cita.servicios = servicios.filter(a => a.id !== id);
        }else{

            cita.servicios = [...servicios, res];
        }
   




        const divServicio = document.querySelector(`[data-id-servicio='${id}']`);
        divServicio.classList.toggle('selecionado');
        
    }
    function nombreCliente(){
        const nombreCliente = document.querySelector('#nombre').value;
        cita.nombre = nombreCliente;
    }
    function idCLiente(){
        const idCliente = document.querySelector('#id').value;
        cita.id = idCliente;
    }
    function seleccionarFecha(){
        const inputFecha = document.querySelector('#fecha');

        inputFecha.addEventListener('input',(e)=>{
            const dia  = new Date(e.target.value).getUTCDay();

            if ([0,6].includes(dia)) {
                e.target.value = '';
               mostrarAlerta('Error', 'El dia no esta disponible');
            }else{
                cita.fecha = e.target.value

            }
            
        });
    }
    function mostrarAlerta(msg, tipo){
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
         
          toastr.error(tipo, msg)

    }
     function seleccoHora(){
        const inputHora = document.querySelector("#hora");

        inputHora.addEventListener('input', (e)=>{
            let horaCita = e.target.value;
            let hora = horaCita.split(':')[0];

            if(hora > 10 || hora > 18){
                mostrarAlerta('Error', 'Hora no disponible');
                e.target.value = '';
            }else{
                cita.hora = e.target.value

                
            }
            
        });
     }
     function mostrarResumen(params) {
        console.log(cita);
        const resumen = document.querySelector('.contenido-resumen');
        while(resumen.firstChild){
            resumen.removeChild(resumen.firstChild)
        }
       

         
        if(Object.values(cita).includes('') || cita.servicios.length === 0){
            mostrarAlerta('Error', 'hacen faltan datos o servicios')
            return 
        }
        const {nombre, fecha, hora, servicios} = cita;
        
        //heading para servicios
        const headingServicios = document.createElement('h3');
        headingServicios.textContent = 'Resumen de servicios';
        resumen.append(headingServicios);



        //servicios    
        servicios.forEach((e)=>{
            const {id, precio, nombre } = e
            const contenedorServicio = document.createElement('DIV');
            contenedorServicio.classList.add('contenedor-servicio');

            const textoServicio = document.createElement("P");
            textoServicio.textContent = nombre;

            const precioServicio =document.createElement('P');
            precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

            contenedorServicio.appendChild(textoServicio);
            contenedorServicio.appendChild(precioServicio);

            resumen.appendChild(contenedorServicio);
        });
        const resumenCita = document.createElement('h3');
        resumenCita.textContent = 'Resumen de cita';
        resumen.append(resumenCita);



        const nombreCliente = document.createElement("P");
        nombreCliente.innerHTML = `<span>Nombre: </span>${nombre}`;

        //formatear fecha

        const fechaObj = new Date(fecha);
        const mes = fechaObj.getMonth();
        const dia = fechaObj.getDate() + 2;
        const year = fechaObj.getFullYear();

        const fechaUTC = new Date(Date.UTC(year, mes, dia));
        const opciones = { weekday: 'long', year: 'numeric', month : 'long', day:'numeric' }
        const fechaFormateada = fechaUTC.toLocaleDateString('es-MX',opciones);

        const fechaCita = document.createElement("P");
        fechaCita.innerHTML = `<span>Fecha: </span>${fechaFormateada}`;
        
        const horaCita = document.createElement("P");
        horaCita.innerHTML = `<span>Cita: </span>${hora} Horas`;

        const botonReservar = document.createElement('BUTTON');
        botonReservar.classList.add('boton');
        botonReservar.textContent = "Reservar Cita";
        botonReservar.onclick = ()=>{
            reserVarcita.index();
        }




        
        resumen.appendChild(nombreCliente);
        resumen.appendChild(fechaCita);
        resumen.appendChild(horaCita);
        resumen.appendChild(botonReservar);

        
     }
    
     
    return {
        index:function(){
            api()
            nombreCliente();
            idCLiente()
            seleccionarFecha();
            seleccoHora();
        },
        resumen:function(){
           mostrarResumen();
        }
    }
})()    

const reserVarcita = (function(){
    
    async function reservar(){
        const {id, fecha, hora, servicios} = cita

        const idServicios = servicios.map((e)=> e.id);
        // console.log(idServicios);

        const datos  =  new FormData();
        datos.append('usuarios_id', id);
        datos.append('fecha', fecha);
        datos.append('hora', hora);
        datos.append('servicios', idServicios);
        try {
            const url = '/api/citas';
            const respuesta = await fetch(url, {
                method : "POST",
                body: datos
            });
            const resultado = await respuesta.json();
            console.log(resultado)
            if(resultado.resultado){
                Swal.fire({
                    icon: "success",
                    title: "Cita creada",
                    text: "tu cita fue creada exitosamente",
                    button: "OK"
                  }).then(()=>{
                    window.location.reload();
                  })
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error al crear tu cita",
                button: "OK"
              }).then(()=>{
                window.location.reload();
              })
        }
      
      

    


     }






    return{
        index:function(){
            reservar()
        }
    }


})()