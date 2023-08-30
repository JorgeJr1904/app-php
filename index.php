<!doctype html>
<html lang="en">

<head>
  <title>app-php</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <h1>Formularios Empleados</h1>

    <div class="container">
        <form class="d-flex" action="crud_empleados.php" method="POST">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_id" class="form-label">ID</label>
                    <input type="text" name="txt_id" id="txt_id" class="form-control" placeholder="ID" value="0" readonly>
                </div>
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label">Codigo</label>
                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Codigo: E001" aria-describedby="helpId" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label">Nombres</label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Ejemplo: Juan Jose" aria-describedby="helpId" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Ejemplo: Gonzalez Lopez" aria-describedby="helpId" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_direccion" class="form-label">Direccion</label>
                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Ejemplo: 4ta calle 4-52 A zona 1 Boca del monte" aria-describedby="helpId" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label">Telefono</label>
                    <input type="text" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Ejemplo: 33225566" aria-describedby="helpId" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="txt_fecha_nacimiento" id="txt_fecha_nacimiento" class="form-control" placeholder="mm/dd/yyyy" aria-describedby="helpId" required>
                </div>
                <div class="mb-3">
                  <label for="lbl_puesto" class="form-label">Puesto</label>
                  <select class="form-select form-select-lg" name="txt_puesto" id="txt_puesto">
                        <option selected disabled>Seleccione un puesto</option>
                        <?php
                        include("datos_conexion.php");
                        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_name);
                        $sql = "SELECT id_puesto as id, puesto FROM db_empresa.puesto";
                        $db_conexion ->real_query($sql);
                        $resultado = $db_conexion->use_result();
                        while($fila = $resultado->fetch_assoc()){
                            echo"<option value=". $fila['id'] .">". $fila['puesto'] ."</option>";
                        }
                        $db_conexion -> close();
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" name="btn_guardar" id="btn_guardar" class="btn btn-primary" value="Agregar" required>
                    <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value="Modificar" required>
                    <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" value="Eliminar" required>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="table-inverse">
                <tr>
                    <th>Codigo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Puesto</th>
                    <th>Nacimiento</th>
                </tr>
                </thead>
                <tbody id="tbl_empleados">                   
                <?php 
                        include("datos_conexion.php");
                        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_name);
                        $sql = "SELECT e.id_empleados as id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, e.fecha_nacimiento, p.puesto, e.id_puesto FROM empleados as e INNER JOIN puesto as p on e.id_puesto = p.id_puesto;";
                        $db_conexion->real_query($sql);
                        $resultado = $db_conexion->use_result();
                        while($fila = $resultado->fetch_assoc()){
                            echo"<tr data-id=". $fila['id'] . " data-idp=" . $fila['id_puesto'] . ">";
                            echo"<td>". $fila['codigo'] ."</td>";
                            echo"<td>". $fila['nombres'] ."</td>";
                            echo"<td>". $fila['apellidos'] ."</td>";
                            echo"<td>". $fila['direccion'] ."</td>";
                            echo"<td>". $fila['telefono'] ."</td>";
                            echo"<td>". $fila['puesto'] ."</td>";
                            echo"<td>". $fila['fecha_nacimiento'] ."</td>";
                            echo"<tr>";
                        }
                        $db_conexion->close();
                ?>
                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
    </div>
    
    
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Validacion del boton -->

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    $('#tbl_empleados').on('click','tr td',function(evt){
        var target,id,idp,codigo,nombres,apellidos,direccion,telefono,nacimiento;
        target = $(event.target);
        id = target.parent().data('id');
        idp = target.parent().data('idp');
        codigo = target.parent("tr").find("td").eq(0).html();
        nombres = target.parent("tr").find("td").eq(1).html();
        apellidos =  target.parent("tr").find("td").eq(2).html();
        direccion = target.parent("tr").find("td").eq(3).html();
        telefono = target.parent("tr").find("td").eq(4).html();
        nacimiento  = target.parent("tr").find("td").eq(6).html();
        $("#txt_id").val(id);
        $("#txt_codigo").val(codigo);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_telefono").val(telefono);
        $("#txt_fecha_nacimiento").val(nacimiento);
        $("#txt_puesto").val(idp);
        $("#modal_empleados").modal('show');
        
    });
  </script>
</body>

</html>