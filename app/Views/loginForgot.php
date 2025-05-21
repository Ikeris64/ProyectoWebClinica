<?php include_once("header.php"); ?>
                    <h1 class = "text-center"><?php print $data["subtitle"]; ?></h1>
                    <div class ="card p-4 bg-light">
                        <form action="<?php print ROUTE; ?>Login/forgotlogin" method="POST">
                            <div class = "form-group text-left">
                                <label for="Correo">Correo Electronico:</label>
                                <input type="text" name="Correo" class="form-control" placeholder="Correo Electronico" required>
                            </div>
                            <div class = "form-group text-left">
                                <input type="submit" value= "Enviar" class = "btn btn-primary mt-3">
                                <a href = "<?php print ROUTE; ?>" type="button" value= "Atrás" class = "btn btn-secondary mt-3">Atrás</a>
                            </div>
                        </form>
                    </div> 
<?php include_once("footer.php"); ?>