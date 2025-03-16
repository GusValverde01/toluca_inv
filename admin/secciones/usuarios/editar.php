<?php

include("../../db.php");

if( isset($_GET['txtID']) ){
    //Borrar registro con ID correspondiente
    $txtID= (isset($_GET['txtID']) )?$_GET['txtID']: "";
    $sentencia=$conexion->prepare(" SELECT * FROM usuario WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro['usuario'];
    $password=$registro['password'];
    $correo=$registro['correo'];
}

if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    /*conexión a la db */
    $sentencia=$conexion->prepare("UPDATE usuario 
    SET 
    usuario=:usuario,
    password=:password, 
    correo=:correo
    WHERE id=:id; ");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);

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
                <label for="usuario" class="form-label">Usuario: </label>
                <input
                    value="<?php echo $usuario;?>"
                    type="text"
                    class="form-control"
                    name="usuario"
                    id="usuario"
                    aria-describedby="helpId"
                    placeholder="Usuario"
                />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password: </label>
                <input
                    value="<?php echo $password;?>"
                    type="text"
                    class="form-control"
                    name="password"
                    id="password"
                    aria-describedby="helpId"
                    placeholder="Password"
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