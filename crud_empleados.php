<?php
if (!empty($_POST)) {
    $txt_id = $_POST["txt_id"];
    $txt_codigo = utf8_decode($_POST["txt_codigo"]);
    $txt_nombres = utf8_decode($_POST["txt_nombres"]);
    $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $txt_puesto= utf8_decode($_POST["txt_puesto"]);
    $txt_fecha_nacimiento= utf8_decode($_POST['txt_fecha_nacimiento']);

    $sql = "";

    if (isset($_POST["btn_guardar"])) {
        $sql = "INSERT INTO empleados(codigo,nombres,apellidos,direccion,telefono,fecha_nacimiento,id_puesto) VALUES ('". $txt_codigo ."', '". $txt_nombres ."', '". $txt_apellidos ."', '". $txt_direccion ."', '". $txt_telefono ."', '". $txt_fecha_nacimiento ."', ". $txt_puesto .")";
    }
    if (isset($_POST["btn_modificar"])) {
        $sql = "UPDATE empleados SET codigo='". $txt_codigo ."', nombres='". $txt_nombres ."', apellidos='". $txt_apellidos ."', direccion='". $txt_direccion ."', telefono='". $txt_telefono ."', fecha_nacimiento='". $txt_fecha_nacimiento ."', id_puesto='". $txt_puesto ."' WHERE id_empleados = " . $txt_id;
    }
    if (isset($_POST["btn_eliminar"])) {
        $sql = "DELETE FROM empleados WHERE id_empleados = " . $txt_id;
    }
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_name);
        
        
        if ($db_conexion->query($sql)===true) {
            $db_conexion ->close();
            header("Location: /app-php");
        }else{
            echo"Error" . $sql . "<br>". $db_conexion -> close();
        }
}
?>