<?php
include("../../db.php");

if (isset($_GET['txtID'])) {
    // Obtener el ID del registro a eliminar
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Obtener los nombres de las imágenes asociadas a este registro
    $sentencia = $conexion->prepare("SELECT img1, img2, img3, img4, img5, img6, imgprincipal FROM `propiedad` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    // Lista de imágenes a eliminar
    $imagenes = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'imgprincipal'];

    foreach ($imagenes as $imagen) {
        if (isset($registro_imagen[$imagen]) && !empty($registro_imagen[$imagen])) {
            $ruta_imagen = "../../../assets/img/portfolio/" . $registro_imagen[$imagen];
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen); // Eliminar archivo del servidor
            }
        }
    }

    // Eliminar el registro de la base de datos
    $sentencia = $conexion->prepare("DELETE FROM `propiedad` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

/* Seleccionar registros */
$sentencia = $conexion->prepare("SELECT * FROM `propiedad`");
$sentencia->execute();
$lista_propiedad = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>
<h5>Lista de Propiedades</h1>

<br/>

<div class="card">
    <div class="card-header">
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Propiedad</a
        >
    </div>
    <div class="card-body">
        
        <div
            class="table-responsive-sm"
        >
            <table
                class="table"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Imagen Principal</th>

                        <th scope="col">Acción</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_propiedad as $registros) { ?>
                        <tr>
                            <td scope="col"><?php echo $registros['id']; ?></td>
                            <td scope="col"><?php echo $registros['titulo']; ?></td>
                            <td scope="col"><?php echo $registros['descripcion']; ?></td>
                            <td scope="col"><?php echo $registros['precio']; ?></td>
                            
                            <!-- Mostrar imagen principal -->
                            <td scope="col">
                                <?php if (!empty($registros['imgprincipal'])) { ?>
                                    <img width="50" src="../../../assets/img/portfolio/<?php echo $registros['imgprincipal']; ?>" alt="Imagen de la propiedad">
                                <?php } else { ?>
                                    <span>Sin imagen</span>
                                <?php } ?>
                            </td>

                            <td scope="col">
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registros['id']; ?>" role="button">Editar</a> |
                                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registros['id']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        

    </div>
</div>


<?php
include("../../templates/footer.php");
?>