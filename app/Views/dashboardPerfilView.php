<?php include_once("header.php"); ?>
<script src="<?php print ROUTE; ?>js/dashboardPerfil.js"></script>
<h1 class="text-center">
    <?php
    if (isset($data["subtitle"])){
        print $data["subtitle"];
    }
    ?>
</h1>
<div class="card p-4 bg-light">
    <form enctype="multipart/form-data" action="<?php print ROUTE; ?>Dashboard/perfil/" method="POST">
        <div class="form-group text-left">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?php print isset($data['data']['nombre']) ? $data['data']['nombre'] : ''; ?>" required placeholder="Nombre" />
        </div>
        
        <div class="form-group text-left">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" class="form-control" name="correo" value="<?php print isset($data['data']['correo']) ? $data['data']['correo'] : ''; ?>" required placeholder="Correo Electrónico" />
        </div>
        
        <div class="form-group text-left">
            <label for="password">Contraseña actual:</label>
            <input type="password" class="form-control" name="password" placeholder="Contraseña actual" />
        </div>
        
        <div class="form-group text-left">
            <label for="newPassword">Nueva Contraseña:</label>
            <input type="password" class="form-control" name="newPassword" placeholder="Nueva Contraseña" />
        </div>
        
        <div class="form-group text-left">
            <label for="confirmacionPassword">Confirma tu Nueva Contraseña:</label>
            <input type="password" class="form-control" name="confirmacionPassword" placeholder="Confirma tu Nueva Contraseña" />
        </div>
        
        <div class="form-group text-left">
            <input type="hidden" name="id" id="id" value="<?php print isset($data['data']['id']) ? $data['data']['id'] : ''; ?>">
            <input type="submit" class="btn btn-primary mt-3" value="Actualizar Perfil" />
            <a href="<?php print ROUTE; ?>Dashboard" class="btn btn-secondary mt-3">Cancelar</a>
        </div>
    </form>
</div>
<?php include_once("footer.php"); ?>