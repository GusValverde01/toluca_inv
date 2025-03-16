<?php

include("../../db.php");

if( isset($_GET['txtID']) ){
    //Borrar registro con ID correspondiente
    $txtID= (isset($_GET['txtID']) )?$_GET['txtID']: "";
    $sentencia=$conexion->prepare(" SELECT * FROM anuncio WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $titulo=$registro['titulo'];
    $descripcion=$registro['descripcion'];
    $precio=$registro['precio'];
    $metros=$registro['metros'];
    $imagen=$registro['imagen'];
    $id_propiedad=$registro['id_propiedad'];
    /* falta imagen */
}

if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $precio=(isset($_POST['precio']))?$_POST['precio']:"";
    $metros=(isset($_POST['metros']))?$_POST['metros']:"";
    $id_propiedad=(isset($_POST['id_propiedad']))?$_POST['id_propiedad']:"";
    /* falta imagen */
    /*conexión a la db */
    $sentencia=$conexion->prepare("UPDATE anuncio 
    SET 
    titulo=:titulo, 
    descripcion=:descripcion, 
    precio=:precio,
    metros=:metros,
    imagen=:imagen,
    id_propiedad=:id_propiedad
    WHERE id=:id; ");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":metros", $metros);
    $sentencia->bindParam(":imagen", $imagen);
    $sentencia->bindParam(":id_propiedad", $id_propiedad);

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    //si hay una imagen se obtienen los datos
    if($_FILES["imagen"]["tmp_name"] != ""){
        $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "")? $fecha_imagen->getTimestamp()."_".$imagen:"";

        $tmp_imagen=$_FILES["imagen"]["tmp_name"];
        
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/".$nombre_archivo_imagen);
        //Borrado del archivo anterior
        $sentencia=$conexion->prepare("SELECT imagen FROM `anuncio` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

        if( isset($registro_imagen["imagen"]) ) {
            if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
            } 
        } 

        $sentencia=$conexion->prepare("UPDATE anuncio SET imagen=:imagen WHERE id=:id; ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

    }

    $mensaje = "Registro Modificado con Éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Editar Anuncio</div>
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
                <label for="titulo" class="form-label">Título: </label>
                <input
                    value="<?php echo $titulo;?>"
                    type="text"
                    class="form-control"
                    name="titulo"
                    id="titulo"
                    aria-describedby="helpId"
                    placeholder="Título"
                />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción: </label>
                <input
                    value="<?php echo $descripcion;?>"
                    type="text"
                    class="form-control"
                    name="descripcion"
                    id="descripcion"
                    aria-describedby="helpId"
                    placeholder="Descripcion"
                />
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio: </label>
                <input
                    value="<?php echo $precio;?>"
                    type="text"
                    class="form-control"
                    name="precio"
                    id="precio"
                    aria-describedby="helpId"
                    placeholder="Precio"
                />
            </div>
            <div class="mb-3">
                <label for="metros" class="form-label">Metros Cuadrados: </label>
                <input
                    value="<?php echo $metros;?>"
                    type="text"
                    class="form-control"
                    name="metros"
                    id="metros"
                    aria-describedby="helpId"
                    placeholder="Metros Cuadrados"
                />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="imagen"
                    id="imagen"
                    placeholder="Imagen"
                    aria-describedby="fileHelpId"
                />
            </div>
            <div class="mb-3">
                <label for="id_propiedad" class="form-label">ID Propiedad: </label>
                <input
                    value="<?php echo $id_propiedad;?>"
                    type="text"
                    class="form-control"
                    name="id_propiedad"
                    id="id_propiedad"
                    aria-describedby="helpId"
                    placeholder="# Propiedad"
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