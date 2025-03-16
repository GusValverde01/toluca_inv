<?php
include("../../db.php");

if($_POST) {

    //Recepcionamos los valores del formulario
    $contacto=(isset($_POST['contacto']))?$_POST['contacto']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";

    /*conexión a la db */
    $sentencia=$conexion->prepare("INSERT INTO `entrada` (`id`, `contacto`, `correo`, `nombre`) 
    VALUES (NULL, :contacto, :correo, :nombre);");

    $sentencia->bindParam(":contacto", $contacto);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":nombre", $nombre);

    $sentencia->execute();
    $mensaje = "Registro Creado con Éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>


<div class="card">
    <div class="card-header">Crear Entrada</div>
    <div class="card-body">
        
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto: </label>
                <input
                    type="text"
                    class="form-control"
                    name="contacto"
                    id="contacto"
                    aria-describedby="helpId"
                    placeholder="Contacto"
                />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo: </label>
                <input
                    type="text"
                    class="form-control"
                    name="correo"
                    id="correo"
                    aria-describedby="helpId"
                    placeholder="Correo"
                />
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre: </label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Nombre Completo"
                />
            </div>
        
            <button
                type="submit"
                class="btn btn-success"
            >
                Agregar
            </button>
            
            <a
                name=""
                id=""
                class="btn btn-primary"
                href="index.php"
                role="button"
                >Cancelar</a
            >
            

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>