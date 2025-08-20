<style>
    table {
        border-collapse: collapse;
        width: 50%;
        margin: auto;
        text-align: center;
        /* Bordes juntos */
    }

    table,
    th,
    td {
        border: 1px solid black;
        /* Borde de 1px de ancho, sólido y negro */
    }
</style>
<form action="tabla.php" method="POST">
 <!--   <input type="text" name="cedula" placeholder="Ingresa tu cedula">
    <input type="text" name="nombre" placeholder="Ingresa tu nombre">
    <input type="text" name="apellido" placeholder="Ingresa tu apellido"> -->
    <input type="text" name="cedula">
    <input type="text" name="nombre">
    <button type="button" id="reset">Resetear tabla</button>
    <button type="submit">CONSULTAR</button>
</form>
    <?php
    include("conexion.php");
    //error_reporting(0);
    $variable = (!empty($_POST['cedula']) && !empty($_POST['nombre'])) ? true : false;
    if ($variable) {
    ?>
    <table style="border: 1;">
        <tr>
            <th>ID</th>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellido</th>
        </tr>
        <tbody>
            <?php
            //Sencia que valide si el id existe y no lo inserte
            // $stmtExiste = $bd->prepare('SELECT cedula, nombre FROM usuarios WHERE cedula = :cedula AND nombre = :nombre');
            // $stmtExiste->bindValue(':cedula', $_POST['cedula'], PDO::PARAM_STR);
            // $stmtExiste->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
            // $stmtExiste->execute();

            // $operador = ($stmtExiste->rowCount() > 0) ? 'La cedula existe para ese usuario' : 'La cedula no existe para ese usuario';
            // echo $operador;     

         /*   $inserto = false;
            $stmtInsert = $bd->prepare('INSERT INTO usuarios (cedula,nombre,apellido) VALUES (:cedula, :nombre, :apellido)');
            $stmtInsert->bindValue(':cedula', $_POST['cedula'], PDO::PARAM_STR);
            $stmtInsert->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
            $stmtInsert->bindValue(':apellido', $_POST['apellido'], PDO::PARAM_STR);
            $stmtInsert->execute();

            if($stmtInsert->rowCount() > 0) {
                $inserto = true;
                return $inserto;
            }

            if($inserto) {
                echo ' se registro el usuario';
            } else {
                echo ' no se registro el usuario';
            }*/

          /*  $sentencia1 = $bd->prepare('SELECT id, cedula, nombre FROM usuarios WHERE id BETWEEN :valor1 AND :valor2');
            $sentencia1->bindValue(":valor1", $_POST['num1'], PDO::PARAM_INT);
            $sentencia1->bindValue(":valor2", $_POST['num2'], PDO::PARAM_INT);
            $sentencia1->execute();*/

            // if($sentencia1->rowCount() > 0) {
                // $resultado1 = $sentencia1->fetchAll(PDO::FETCH_ASSOC);
            // }

            // prepare query
           /* $sentencia = $bd->prepare('SELECT id, nombre FROM usuarios WHERE id BETWEEN 1 AND 4');
            $sentencia->execute();*/
            /*
            $sentencia = $bd->prepare('SELECT cedula, nombre, apellido FROM usuarios');
            $sentencia->execute();*/

             $statement = $bd->prepare("SELECT * FROM usuarios ORDER BY id ASC");
             $statement->execute(); 

            // print results
            if ($statement->rowCount() > 0) {
                $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultado as $key) {
            ?>
                    <tr>
                        <td><?= htmlspecialchars($key['id']) ?></td>
                        <td><?= htmlspecialchars($key['cedula']) ?></td>
                        <td><?= htmlspecialchars($key['nombre']) ?></td>
                        <td><?= htmlspecialchars($key['apellido']) ?></td>                       
                        <td><input type="checkbox" name="editar" id=""></td>                       
                    </tr>
        <?php
                }
            }
        } else {
            echo 'no llego ';
        }
        ?>
        </tbody>
    </table>
    <script>
        document.getElementById('reset').addEventListener('click', function(e) {
            window.location.href = "tabla.php";
        });
    </script>