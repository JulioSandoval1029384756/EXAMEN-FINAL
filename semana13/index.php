<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
    $conexion = new PDO('mysql:host=localhost;dbname=FINAL_0907-23-19529', 'root', '', $pdo_options);

    if (isset($_POST["accion"])){
        echo "quieres " . $_POST["accion"];
        if ($_POST["accion"] == "crear"){
            $insert = $conexion->prepare("INSERT INTO Producto (Codigo, Nombre, Precio, Existencia) VALUES
            (:Codigo,:,Nombre:Precio,:Existencia)");
            $insert->bindvalue('Codigo', $_POST['Codigo']);
            $insert->bindvalue('Nombre', $_POST['Nombre']);
            $insert->bindvalue('Precio', $_POST['Precio']);
            $insert->bindvalue('Existencia', $_POST['Existencia']);
            $insert->execute();
        }
    }

    $select = $conexion->query("SELECT Codigo, Nombre, Precio, Existencia FROM Producto");
    ?>

<form method="POST">
    <input type="text" name="Codigo" placeholder="Ingresa el Codigo"/>
    <input type="text" name="Nombre" placeholder="Ingresa el Nombre"/>
    <input type="text" name="Precio" placeholder="Ingresa el Precio"/>
    <input type="text" name="Existencia" placeholder="Ingresa el Existencia"/>
    <input type="hidden" name="accion" value="crear"/>
    <button type="submit">crear </button>
</form>

    <table border="1">
        <thead>
            <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>acciones</th>
</tr>
</thead>
<tbody>
    <tr>
    <?php foreach($select->fetchAll() as $Producto) { ?>
       <tr>
        <td> <?php echo $Producto["Codigo"] ?> </td>
        <td> <?php echo $Producto["Nombre"] ?> </td>
        <td> <?php echo $Producto["Precio"] ?> </td>
        <td> <?php echo $Producto["Existencia"] ?> </td>
        <td> <form method="POST" >
        <button type="submit">Editar</button>
<input type="hidden" value="Editar" />
<input type="hidden" value="<?php echo $Producto["Codigo"] ?>" />
</form>
    </tr>
    <?php }?>

</tbody>
</table>


      
    
</body>
</html>