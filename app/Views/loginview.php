<?php include_once("header.php"); ?>
<h1 class="text-center"><?php print $data["subtitle"]; ?></h1>
<div class="card p-4 bg-light">
    <form action="<?php print ROUTE; ?>login/validar">
        <div class="form-group text-left">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        </div>
        <div class="form-group text-left">
            <label for="Contraseña">Contraseña: </label>
            <input type="text" name="Contraseña" class="form-control" placeholder="Contraseña" required>
        </div>
        <div class="form-group text-left mb-2">
            <input type="checkbox" name="recordar" value="Recordar" id="recordar">
            <label for="recordar">Recordar</label>
        </div>
        <div class="form-group text-left">
            <input type="submit" value="Iniciar Sesión" class="btn btn-primary mt-3">
        </div>
    </form>
    <a href="<?php print ROUTE; ?>Login/loginForgot" class="btn btn-link mt-3">Olvidaste tu contraseña?</a>
</div>
<?php include_once("footer.php"); ?>