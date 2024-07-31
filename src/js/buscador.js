document.addEventListener('DOMContentLoaded',()=>{
    iniciarApp.index()
});
const iniciarApp = (function(){
    return {
        index:function(){
            buscador.index()
        }
    }
})()    
const buscador = (function(){

    function buscarPorFecha(){
        const inputFecha = document.querySelector('#fecha');
        inputFecha.addEventListener('input',(e)=>{
                const fecha = e.target.value;

                window.location = `?fecha=${fecha}`
        }); 
    }   


    return {
        index:function() {
            buscarPorFecha();
        }
    }
}) ()