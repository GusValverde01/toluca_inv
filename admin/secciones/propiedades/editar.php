<?php
include("../../db.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM propiedad WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $registro['titulo'];
    $descripcion = $registro['descripcion'];
    $imagen1 = $registro['img1'];
    $imagen2 = $registro['img2'];
    $imagen3 = $registro['img3'];
    $imagen4 = $registro['img4'];
    $imagen5 = $registro['img5'];
    $imagen6 = $registro['img6'];
    $precio = $registro['precio'];
    $metros = $registro['metros'];
    $agua = $registro['agua'];
    $luz = $registro['luz'];
    $telefono = $registro['telefono'];
    $drenaje = $registro['drenaje'];
    $ubicacion = $registro['ubicacion'];
    $vendedor = $registro['vendedor'];
    $contacto = $registro['contacto'];
    $imagen_principal = $registro['imgprincipal'];
}

if ($_POST) {
    $txtID = $_POST['txtID'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $metros = $_POST['metros'];
    $agua = $_POST['agua'];
    $luz = $_POST['luz'];
    $telefono = $_POST['telefono'];
    $drenaje = $_POST['drenaje'];
    $ubicacion = $_POST['ubicacion'];
    $vendedor = $_POST['vendedor'];
    $contacto = $_POST['contacto'];

    $sentencia = $conexion->prepare("UPDATE propiedad 
        SET titulo=:titulo, descripcion=:descripcion, precio=:precio, metros=:metros, 
        agua=:agua, luz=:luz, telefono=:telefono, drenaje=:drenaje,
        ubicacion=:ubicacion, vendedor=:vendedor, contacto=:contacto
        WHERE id=:id ");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":metros", $metros);
    $sentencia->bindParam(":agua", $agua);
    $sentencia->bindParam(":luz", $luz);
    $sentencia->bindParam(":telefono", $telefono);
    $sentencia->bindParam(":drenaje", $drenaje);
    $sentencia->bindParam(":ubicacion", $ubicacion);
    $sentencia->bindParam(":vendedor", $vendedor);
    $sentencia->bindParam(":contacto", $contacto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Manejo de imágenes
    $imagenes = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'imgprincipal'];
    foreach ($imagenes as $imagen) {
        if ($_FILES[$imagen]["tmp_name"] != "") {
            $imagen_nombre = $_FILES[$imagen]["name"];
            $fecha_imagen = new DateTime();
            $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen_nombre;
            $tmp_imagen = $_FILES[$imagen]["tmp_name"];

            move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);

            // Borrar imagen anterior
            $sentencia = $conexion->prepare("SELECT $imagen FROM propiedad WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
            $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

            if (isset($registro_imagen[$imagen])) {
                $ruta_imagen = "../../../assets/img/portfolio/" . $registro_imagen[$imagen];
                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }
            }

            // Actualizar base de datos con la nueva imagen
            $sentencia = $conexion->prepare("UPDATE propiedad SET $imagen=:imagen WHERE id=:id");
            $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
        }
    }

    $mensaje = "Propiedad Modificada con Éxito";
    header("Location:index.php?mensaje=" . $mensaje);
}


include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Propiedades</div>
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
                <label for="titulo" class="form-label">Título:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $titulo; ?>"
                    name="titulo"
                    id="titulo"
                    aria-describedby="helpId"
                    placeholder="Titulo"
                />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $descripcion; ?>"
                    name="descripcion"
                    id="descripcion"
                    aria-describedby="helpId"
                    placeholder="Descripción"
                />
            </div>

            <!-- -->
            <div class="mb-3">
                <label for="img1" class="form-label">Imagen 1:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen1; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="img1"
                    id="img1"
                    placeholder="Imagen 1"
                    aria-describedby="fileHelpId"
                />
            </div>
            <div class="mb-3">
                <label for="img2" class="form-label">Imagen 2:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen2; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="img2"
                    id="img2"
                    placeholder="Imagen 2"
                    aria-describedby="fileHelpId"
                />
            </div>
            <div class="mb-3">
                <label for="img3" class="form-label">Imagen 3:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen3; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="img3"
                    id="img3"
                    placeholder="Imagen 3"
                    aria-describedby="fileHelpId"
                />
            </div>
            <div class="mb-3">
                <label for="img4" class="form-label">Imagen 4:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen4; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="img4"
                    id="img4"
                    placeholder="Imagen 4"
                    aria-describedby="fileHelpId"
                />
            </div>
            <div class="mb-3">
                <label for="img5" class="form-label">Imagen 5:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen5; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="img5"
                    id="img5"
                    placeholder="Imagen 5"
                    aria-describedby="fileHelpId"
                />
            </div>
            <div class="mb-3">
                <label for="img6" class="form-label">Imagen 6:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen6; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="img6"
                    id="img6"
                    placeholder="Imagen 6"
                    aria-describedby="fileHelpId"
                />
            </div>

            <!-- -->
            
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $precio; ?>"
                    name="precio"
                    id="precio"
                    aria-describedby="helpId"
                    placeholder="Precio"
                />
            </div>
            <div class="mb-3">
                <label for="metros" class="form-label">Metros Cuadrados:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $metros; ?>"
                    name="metros"
                    id="metros"
                    aria-describedby="helpId"
                    placeholder="Metros Cuadrados"
                />
            </div>
            <div class="mb-3">
                <label for="agua" class="form-label">Agua:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $agua; ?>"
                    name="agua"
                    id="agua"
                    aria-describedby="helpId"
                    placeholder="Agua"
                />
            </div>
            <div class="mb-3">
                <label for="luz" class="form-label">Luz:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $luz; ?>"
                    name="luz"
                    id="luz"
                    aria-describedby="helpId"
                    placeholder="Luz"
                />
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $telefono; ?>"
                    name="telefono"
                    id="telefono"
                    aria-describedby="helpId"
                    placeholder="Telefono"
                />
            </div>
            <div class="mb-3">
                <label for="drenaje" class="form-label">Drenaje:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $drenaje; ?>"
                    name="drenaje"
                    id="drenaje"
                    aria-describedby="helpId"
                    placeholder="Drenaje"
                />
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $ubicacion; ?>"
                    name="ubicacion"
                    id="ubicacion"
                    aria-describedby="helpId"
                    placeholder="Ubicacion"
                />
            </div>
            <div class="mb-3">
                <label for="vendedor" class="form-label">Vendedor:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $vendedor; ?>"
                    name="vendedor"
                    id="vendedor"
                    aria-describedby="helpId"
                    placeholder="Vendedor"
                />
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $contacto; ?>"
                    name="contacto"
                    id="contacto"
                    aria-describedby="helpId"
                    placeholder="Contacto"
                />
            </div>
            <div class="mb-3">
                <label for="imgprincipal" class="form-label">Imagen Principal:</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen_principal; ?> "/>
                <input
                    type="file"
                    class="form-control"
                    name="imgprincipal"
                    id="imgprincipal"
                    placeholder="Imagen Principal"
                    aria-describedby="fileHelpId"
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
</div>


<?php
include("../../templates/footer.php");
?>