<?php

session_start();
$url_base= "http://localhost/toluca_inv/admin/";
//¿Existe el usuario?
if(!isset($_SESSION['correo'])) {
    header("Location:".$url_base."login.php");
}
?>

<!doctype html>
<html lang="es">
    <head>
        <title>Administrador</title></title>
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

        <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="#" aria-current="page"
                        >Administrador <span class="visually-hidden">(current)</span></a
                    >
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/propiedades/">Propiedades</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/anuncios/">Anuncios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/entradas/">Entradas</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar Sesión</a>

                </div>
            </nav>
            
        </header>
        <main class="contenedor">
            <br/>

            <script>
                <?php if(isset($_GET['mensaje'])) ?>
                Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
                <?php ?>
            </script>