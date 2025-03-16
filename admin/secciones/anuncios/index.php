<?php
include("../../db.php");

if( isset($_GET['txtID']) ){
    //Borrar registro con ID correspondiente
    $txtID= (isset($_GET['txtID']) )?$_GET['txtID']: "";

    $sentencia=$conexion->prepare("SELECT imagen FROM `anuncio` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if( isset($registro_imagen["imagen"]) ) {
        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
        } 
    } 

    $sentencia=$conexion->prepare("DELETE FROM `anuncio` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

/*seleccionar registros */
$sentencia=$conexion->prepare("SELECT * FROM `anuncio`");
$sentencia->execute();
$lista_anuncios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<h5>Lista de Anuncios</h1>

<br/>

<div class="card">
    <div class="card-header">
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Anuncio</a
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
                        <th scope="col">Metros</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">ID Propiedad</th>
                        <th scope="col">Acción</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_anuncios as $registros) { ?>
                    <tr class="">
                        <td><?php echo $registros['id']; ?> </td>
                        <td><?php echo $registros['titulo']; ?></td>
                        <td><?php echo $registros['descripcion']; ?></td>
                        <td><?php echo $registros['precio']; ?></td>
                        <td><?php echo $registros['metros']; ?></td>
                        
                        <td>
                            <img width="50" src="../../../assets/img/portfolio/<?php echo $registros['imagen']; ?> " />
                        </td>

                        <td><?php echo $registros['id_propiedad']; ?></td>
                        <td>
                            <a
                                name=""
                                id=""
                                class="btn btn-info"
                                href="editar.php?txtID=<?php echo $registros['id']; ?>"
                                role="button"
                                >Editar</a
                            >
                            
                            | 
                            <a
                                name=""
                                id=""
                                class="btn btn-danger"
                                href="index.php?txtID=<?php echo $registros['id']; ?>"
                                role="button"
                                >Eliminar</a
                            >
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