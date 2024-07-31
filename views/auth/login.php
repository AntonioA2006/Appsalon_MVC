<h1 class="nombre-pagina">Login</h1> 
<p class="descripcion-pagina">Inicia sesion con tus datos</p>
<?php 
         include_once __DIR__ . '/../templates/alertas.php';
?>


<form class="formulario" action="/" method="POST">

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="tu E-mail">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="tu Password">
    </div>
    <input class="boton" type="submit" value="iniciar sesion">

</form>


<div class="acciones">
        <a href="/crear-cuenta">crea una cuenta</a>
        <a href="/olvide">olvidaste tu password?</a>
</div>