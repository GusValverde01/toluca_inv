<?php

include("../../db.php");

if( isset($_GET['txtID']) ){
    //Borrar registro con ID correspondiente
    $txtID= (isset($_GET['txtID']) )?$_GET['txtID']: "";
    $sentencia=$conexion->prepare(" SELECT * FROM entrada WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $contacto=$registro['contacto'];
    $correo=$registro['correo'];
    $nombre=$registro['nombre'];
}

if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $contacto=(isset($_POST['contacto']))?$_POST['contacto']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    /*conexión a la db */
    $sentencia=$conexion->prepare("UPDATE entrada 
    SET 
    contacto=:contacto, 
    correo=:correo,
    nombre=:nombre
    WHERE id=:id; ");

    $sentencia->bindParam(":contacto", $contacto);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":nombre", $nombre);

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro Modificado con Éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Editar Entrada</div>
    <div class="card-body">
        
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID: </label>
                <input
                    readonly
                    value="<?php echo $txtID;?>"
                    type="text"
                    class="form-control"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder="ID"
                />
            </div>
            

            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto: </label>
                <input
                    value="<?php echo $contacto;?>"
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
                    value="<?php echo $correo;?>"
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
                    value="<?php echo $nombre;?>"
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
                Actualizar
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