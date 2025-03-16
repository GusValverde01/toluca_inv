<?php
include("../../db.php");

if( isset($_GET['txtID']) ){
    //Borrar registro con ID correspondiente
    $txtID= (isset($_GET['txtID']) )?$_GET['txtID']: "";

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);


    $sentencia=$conexion->prepare("DELETE FROM `entrada` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

/*seleccionar registros */
$sentencia=$conexion->prepare("SELECT * FROM `entrada`");
$sentencia->execute();
$lista_entrada=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<h5>Lista de Entradas</h1>

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
                        <th scope="col">Contacto</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Nombre Completo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_entrada as $registros) { ?>
                    <tr class="">
                        <td><?php echo $registros['id']; ?> </td>
                        <td><?php echo $registros['contacto']; ?></td>
                        <td><?php echo $registros['correo']; ?></td>
                        <td><?php echo $registros['nombre']; ?></td>
                        
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