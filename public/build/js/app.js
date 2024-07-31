document.addEventListener("DOMContentLoaded",(()=>{iniciarApp.iniciar()}));const iniciarApp={iniciar:function(){tab.tabs(),consultarAPI.index()}},tab=function(){let e=1;const t=document.querySelectorAll(".tabs button"),n=document.getElementById("anterior"),o=document.getElementById("siguiente");function a(){const t=document.querySelector(".mostrar");t&&t.classList.remove("mostrar");document.querySelector(`#paso-${e}`).classList.add("mostrar")}function c(){const t=document.querySelector(".actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${e}"]`).classList.add("actual")}function i(){1===e?(n.classList.add("ocultar"),o.classList.remove("ocultar")):3===e?(n.classList.remove("ocultar"),o.classList.add("ocultar"),consultarAPI.resumen()):(n.classList.remove("ocultar"),o.classList.remove("ocultar")),a(),c()}return{tabs:function(){t.forEach((t=>{t.addEventListener("click",(t=>{e=parseInt(t.target.dataset.paso),i(),c(),a()}))})),a(),i(),n.addEventListener("click",(()=>{e<=1||(e--,i())})),o.addEventListener("click",(()=>{e>=3||(e++,i())}))}}}(),cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]},consultarAPI=function(){async function e(){try{const e="/api/servicios",t=await fetch(e);!function(e){e.forEach((e=>{const{id:t,nombre:n,precio:o}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=n;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`$ ${o}`;const i=document.createElement("Div");i.classList.add("servicio"),i.dataset.idServicio=t,i.onclick=function(){!function(e){const{servicios:t}=cita,{id:n}=e;t.some((e=>e.id===n))?cita.servicios=t.filter((e=>e.id!==n)):cita.servicios=[...t,e];const o=document.querySelector(`[data-id-servicio='${n}']`);o.classList.toggle("selecionado")}(e)},i.appendChild(a),i.appendChild(c),document.querySelector("#servicios").appendChild(i)}))}(await t.json())}catch(e){console.log(e)}}function t(e,t){toastr.options={closeButton:!1,debug:!1,newestOnTop:!1,progressBar:!0,positionClass:"toast-top-right",preventDuplicates:!1,onclick:null,showDuration:"300",hideDuration:"1000",timeOut:"5000",extendedTimeOut:"1000",showEasing:"swing",hideEasing:"linear",showMethod:"fadeIn",hideMethod:"fadeOut"},toastr.error(t,e)}return{index:function(){e(),function(){const e=document.querySelector("#nombre").value;cita.nombre=e}(),function(){const e=document.querySelector("#id").value;cita.id=e}(),document.querySelector("#fecha").addEventListener("input",(e=>{const n=new Date(e.target.value).getUTCDay();[0,6].includes(n)?(e.target.value="",t("Error","El dia no esta disponible")):cita.fecha=e.target.value})),document.querySelector("#hora").addEventListener("input",(e=>{let n=e.target.value.split(":")[0];n>10||n>18?(t("Error","Hora no disponible"),e.target.value=""):cita.hora=e.target.value}))},resumen:function(){!function(){console.log(cita);const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void t("Error","hacen faltan datos o servicios");const{nombre:n,fecha:o,hora:a,servicios:c}=cita,i=document.createElement("h3");i.textContent="Resumen de servicios",e.append(i),c.forEach((t=>{const{id:n,precio:o,nombre:a}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicio");const i=document.createElement("P");i.textContent=a;const r=document.createElement("P");r.innerHTML=`<span>Precio:</span> $${o}`,c.appendChild(i),c.appendChild(r),e.appendChild(c)}));const r=document.createElement("h3");r.textContent="Resumen de cita",e.append(r);const s=document.createElement("P");s.innerHTML=`<span>Nombre: </span>${n}`;const d=new Date(o),l=d.getMonth(),u=d.getDate()+2,m=d.getFullYear(),p=new Date(Date.UTC(m,l,u)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),h=document.createElement("P");h.innerHTML=`<span>Fecha: </span>${p}`;const v=document.createElement("P");v.innerHTML=`<span>Cita: </span>${a} Horas`;const f=document.createElement("BUTTON");f.classList.add("boton"),f.textContent="Reservar Cita",f.onclick=()=>{reserVarcita.index()},e.appendChild(s),e.appendChild(h),e.appendChild(v),e.appendChild(f)}()}}}(),reserVarcita={index:function(){!async function(){const{id:e,fecha:t,hora:n,servicios:o}=cita,a=o.map((e=>e.id)),c=new FormData;c.append("usuarios_id",e),c.append("fecha",t),c.append("hora",n),c.append("servicios",a);try{const e="/api/citas",t=await fetch(e,{method:"POST",body:c}),n=await t.json();console.log(n),n.resultado&&Swal.fire({icon:"success",title:"Cita creada",text:"tu cita fue creada exitosamente",button:"OK"}).then((()=>{window.location.reload()}))}catch(e){Swal.fire({icon:"error",title:"Error",text:"Error al crear tu cita",button:"OK"}).then((()=>{window.location.reload()}))}}()}};