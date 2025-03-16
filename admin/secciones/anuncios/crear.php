<?php
include("../../db.php");

if($_POST) {

    //Recepcionamos los valores del formulario
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $precio=(isset($_POST['precio']))?$_POST['precio']:"";
    $metros=(isset($_POST['metros']))?$_POST['metros']:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $id_propiedad=(isset($_POST['id_propiedad']))?$_POST['id_propiedad']:"";

    //Adjuntar imagen hacia el destino portfolio
    $fecha_imagen = new DateTime();
    $nombre_archivo_imagen = ($imagen != "")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }

    /*conexión a la db */
    $sentencia=$conexion->prepare("INSERT INTO `anuncio` (`id`, `titulo`, `descripcion`, `precio`, `metros`, `imagen`, `id_propiedad`) 
    VALUES (NULL, :titulo, :descripcion, :precio, :metros, :imagen, :id_propiedad);");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":metros", $metros);
    $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
    $sentencia->bindParam(":id_propiedad", $id_propiedad);

    $sentencia->execute();
    $mensaje = "Anuncio Creado con Éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>


<div class="card">
    <div class="card-header">Crear Anuncio</div>
    <div class="card-body">
        
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título: </label>
                <input
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