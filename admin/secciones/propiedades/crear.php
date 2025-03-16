<?php
include("../../db.php");

if($_POST) {

    //Recepcionamos los valores del formulario
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $precio=(isset($_POST['precio']))?$_POST['precio']:"";
    $metros=(isset($_POST['metros']))?$_POST['metros']:"";
    $agua=(isset($_POST['agua']))?$_POST['agua']:"";
    $luz=(isset($_POST['luz']))?$_POST['luz']:"";
    $telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";
    $drenaje=(isset($_POST['drenaje']))?$_POST['drenaje']:"";
    $ubicacion=(isset($_POST['ubicacion']))?$_POST['ubicacion']:"";
    $vendedor=(isset($_POST['vendedor']))?$_POST['vendedor']:"";
    $contacto=(isset($_POST['contacto']))?$_POST['contacto']:"";

    // Carpeta de destino
    $carpeta_destino = "../../../assets/img/portfolio/";

    // Objeto para generar nombres únicos con timestamp
    $fecha_imagen = new DateTime();

    // Array de imágenes
    $imagenes = ["img1", "img2", "img3", "img4", "img5", "img6", "imgprincipal"];
    $nombres_imagenes = [];

    foreach ($imagenes as $img) {
        if (isset($_FILES[$img]["name"]) && $_FILES[$img]["name"] != "") {
            $nombre_archivo = $fecha_imagen->getTimestamp() . "_" . $_FILES[$img]["name"];
            $tmp_imagen = $_FILES[$img]["tmp_name"];

            if ($tmp_imagen != "") {
                move_uploaded_file($tmp_imagen, $carpeta_destino . $nombre_archivo);
            }
            $nombres_imagenes[$img] = $nombre_archivo;
        } else {
            $nombres_imagenes[$img] = ""; // Si no se subió imagen, dejar campo vacío
        }
    }

    //Conexión a la db, inserción
    $sentencia = $conexion->prepare("INSERT INTO `propiedad` (`id`, `titulo`, `descripcion`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `precio`, `metros`, `agua`, `luz`, `telefono`, `drenaje`, `ubicacion`, `vendedor`, `contacto`, `imgprincipal`) 
    VALUES (NULL, :titulo, :descripcion, :img1, :img2, :img3, :img4, :img5, :img6, :precio, :metros, :agua, :luz, :telefono, :drenaje, :ubicacion, :vendedor, :contacto, :imgprincipal);");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":img1", $nombres_imagenes["img1"]);
    $sentencia->bindParam(":img2", $nombres_imagenes["img2"]);
    $sentencia->bindParam(":img3", $nombres_imagenes["img3"]);
    $sentencia->bindParam(":img4", $nombres_imagenes["img4"]);
    $sentencia->bindParam(":img5", $nombres_imagenes["img5"]);
    $sentencia->bindParam(":img6", $nombres_imagenes["img6"]);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":metros", $metros);
    $sentencia->bindParam(":agua", $agua);
    $sentencia->bindParam(":luz", $luz);
    $sentencia->bindParam(":telefono", $telefono);
    $sentencia->bindParam(":drenaje", $drenaje);
    $sentencia->bindParam(":ubicacion", $ubicacion);
    $sentencia->bindParam(":vendedor", $vendedor);
    $sentencia->bindParam(":contacto", $contacto);
    $sentencia->bindParam(":imgprincipal", $nombres_imagenes["imgprincipal"]);

    $sentencia->execute();
    $mensaje = "Propiedad Creada con Éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Propiedades</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input
                    type="text"
                    class="form-control"
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
                    name="descripcion"
                    id="descripcion"
                    aria-describedby="helpId"
                    placeholder="Descripción"
                />
            </div>

            <!-- -->
            <div class="mb-3">
                <label for="img1" class="form-label">Imagen 1:</label>
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
                    name="contacto"
                    id="contacto"
                    aria-describedby="helpId"
                    placeholder="Contacto"
                />
            </div>
            <div class="mb-3">
                <label for="imgprincipal" class="form-label">Imagen Principal:</label>
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
</div>





<?php
include("../../templates/footer.php");
?>