<?php

session_start();

if($_POST) {

    include("./db.php");

    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";

    /*seleccionar registros */
    $sentencia=$conexion->prepare("SELECT *, count(*) as n_correo 
            FROM `usuario`
            WHERE correo=:correo
            AND password=:password
            ");
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":correo", $correo);
    $sentencia->execute();
    $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);

    if($lista_usuarios['n_correo'] > 0) {
        $_SESSION['correo']= $lista_usuarios['correo'];
        $_SESSION['logueado']= true;

        header("Location:index.php");

    }
    else{
        $mensaje="Error: El Correo o Password son incorrectos";
    }
}

?>

<!doctype html>
<html lang="es">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

            <div class="container">
                <div class="row">
                    <div
                        class="col-4"
                    >
                    </div>
                    <div
                        class="col-4"
                    >

                    <br/> <br/> <br/> <br/>

                    <?php if(isset($mensaje)) { ?>

                        <div
                            class="alert alert-danger alert-dismissible fade show"
                            role="alert"
                        >
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                            <strong><?php echo $mensaje; ?></strong>
                        </div>
                    <?php } ?>    
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                        
                        <script>
                            var alertList = document.querySelectorAll(".alert");
                            alertList.forEach(function (alert) {
                                new bootstrap.Alert(alert);
                            });
                        </script>
                        

                        <form action="" method="post">

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input
                                type="text"
                                class="form-control"
                                name="correo"
                                id="correo"
                                aria-describedby="helpId"
                                placeholder=""
                            />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="password"
                                aria-describedby="helpId"
                                placeholder=""
                            />
                        </div>
                        
                        <input
                            name=""
                            id=""
                            class="btn btn-primary"
                            type="submit"
                            value="Entrar"
                        />
                        
                        

                        </form>
                            
                        </div>
                    </div>
                    

                    </div>
                    
                </div>
            </div>
            

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
