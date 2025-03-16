<?php
include("../../db.php");

if( isset($_GET['txtID']) ){
    //Borrar registro con ID correspondiente
    $txtID= (isset($_GET['txtID']) )?$_GET['txtID']: "";

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);


    $sentencia=$conexion->prepare("DELETE FROM `usuario` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

/*seleccionar registros */
$sentencia=$conexion->prepare("SELECT * FROM `usuario`");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<h5>Usuarios Administradores</h1>

<br/>

<div class="card">
    <div class="card-header">
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Usuario</a
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
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_usuarios as $registros) { ?>
                    <tr class="">
                        <td><?php echo $registros['id']; ?> </td>
                        <td><?php echo $registros['usuario']; ?></td>
                        <td><?php echo $registros['correo']; ?></td>
                        <td><?php echo $registros['password']; ?></td>
                        
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