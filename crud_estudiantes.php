<?php

if (!empty($_POST)) {

    $sql = "";

    if (isset($_POST["btn_agregar"])) {
        $txt_carne = $_POST["txt_carne"];
        $txt_nombres = $_POST["txt_nombres"];
        $txt_apellidos = $_POST["txt_apellidos"];
        $txt_direccion = $_POST["txt_direccion"];
        $txt_telefono = $_POST["txt_telefono"];
        $txt_email= $_POST["txt_email"];
        $txt_fn= $_POST['txt_fn'];
        $txt_tipo_sangre= $_POST['txt_tipo_sangre'];

        $sql = "INSERT INTO estudiantes(carne,nombres,apellidos,direccion,telefono,correo_electronico,fecha_nacimiento,id_tipo_sangre) VALUES ('". $txt_carne ."', '". $txt_nombres ."', '". $txt_apellidos ."', '". $txt_direccion ."', '". $txt_telefono ."', '". $txt_email ."', '" . $txt_fn ."', ". $txt_tipo_sangre .")";
    }else{
        $txt_id = $_POST["txt_id2"];
        $txt_carne = $_POST["txt_carne2"];
        $txt_nombres = $_POST["txt_nombres2"];
        $txt_apellidos = $_POST["txt_apellidos2"];
        $txt_direccion = $_POST["txt_direccion2"];
        $txt_telefono = $_POST["txt_telefono2"];
        $txt_email= $_POST["txt_email2"];
        $txt_fn= $_POST['txt_fn2'];
        $txt_tipo_sangre= $_POST['txt_tipo_sangre2'];

        if (isset($_POST["btn_modificar"])) {
            $sql = "UPDATE estudiantes SET carne='". $txt_carne ."', nombres='". $txt_nombres ."', apellidos='". $txt_apellidos ."', direccion='". $txt_direccion ."', telefono='". $txt_telefono ."', correo_electronico='". $txt_email ."', fecha_nacimiento='". $txt_fn ."', id_tipo_sangre='". $txt_tipo_sangre ."' WHERE id_estudiante = " . $txt_id;
        }
        if (isset($_POST["btn_eliminar"])) {
            $sql = "DELETE FROM estudiantes WHERE id_estudiante = " . $txt_id;
        }
    }
    include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_name);
            
            if ($db_conexion->query($sql)===true) {
                $db_conexion ->close();
                header("Location: /app-php/estudiantes.php");
            }else{
                echo"Error" . $sql . "<br>". $db_conexion -> close();
            }
}
?>