<?php include_once("header.php"); ?>
                    <h1 class = "text-center"><?php print $data["subtitle"]; ?></h1>
                    <div class ="card p-4 bg-light">
                        <form action="<?php print ROUTE; ?>Login/Restablecer/" method="POST">
                            <div class="form-group text-left">
                                <label for="nueva_contrasena">Nueva Contraseña:</label>
                                <input type="password" name="nueva_contrasena" class="form-control" placeholder="Nueva Contraseña" required>
                            </div>
                            <div class="form-group text-left">
                                <label for="repite_nueva_contrasena">Repita Nueva Contraseña: </label>
                                <input type="password" name="repite_nueva_contrasena" class="form-control" placeholder="Repita Nueva Contraseña" required>
                            </div>
                            <div class="form-group text-left">
                                <input type="hidden" name="id" value="<?php print $data["data"]; ?>">
                                <input type="submit" value="Cambiar" class="btn btn-primary mt-3">
                            </div>
                        </form>
                    </div> 
<?php include_once("footer.php"); ?>