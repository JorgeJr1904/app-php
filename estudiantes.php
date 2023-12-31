<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Tarea 2 NodeJs</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Jorge Villagran</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Sub Menu
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ubicacion</a>
                </li>
            </ul>
        </div>
    </nav>

    <h1 style="margin-top: 50px; margin-bottom: 20px; text-align: center;">Tabla de Estudiantes</h1>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Carne</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo Electronico</th>
                <th scope="col">Nacimiento</th>
                <th scope="col">Tipo de Sangre</th>
            </tr>
        </thead>
        <tbody id="tbl_estudents">
            <?php
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name);
            $sql = "SELECT e.id_estudiante, e.carne, e.nombres, e.apellidos, e.direccion, e.telefono, e.correo_electronico, e.fecha_nacimiento, s.id_tipo_sangre, s.sangre FROM estudiantes as e INNER JOIN tipos_sangre as s ON e.id_tipo_sangre = s.id_tipo_sangre;";
            $db_conexion->real_query($sql);
            $resultado = $db_conexion->use_result();
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr data-id=" . $fila['id_estudiante'] . " data-ids=" . $fila['id_tipo_sangre'] . ">";
                echo "<td>" . $fila['carne'] . "</td>";
                echo "<td>" . $fila['nombres'] . "</td>";
                echo "<td>" . $fila['apellidos'] . "</td>";
                echo "<td>" . $fila['direccion'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>" . $fila['correo_electronico'] . "</td>";
                echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
                echo "<td>" . $fila['sangre'] . "</td>";
                echo "<tr>";
            }
            $db_conexion->close();
            ?>
        </tbody>
    </table>

    <button type="button" id="btn_nuevo" name="btn_nuevo" data-toggle="modal" data-target="#newStudentModal"
        class="btn btn-outline-primary">Nuevo</button>

    <footer style="margin-top: 50px;">
        <div class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Desarrollo Web: Jorge Andres Villagran Vargas &copy; 2023</span>
        </div>
    </footer>

    <!-- Crud Modal -->
    <div class="modal fade" id="crudModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edicion de Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="crud_estudiantes.php" method="POST" onsubmit="return confirmDelete()">
                        <div class="form-group">
                            <input id="txt_id2" class="form-control" name="txt_id2" type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label for="txt_carne2">Carne</label>
                            <input id="txt_carne2" class="form-control" name="txt_carne2" type="text"
                                placeholder="E001 - E999" required="" maxlength=45
                                pattern="E00[1-9]|E0[1-9][0-9]|E[1-9][0-9][0-9]"
                                title="Ingrese un valor válido (E001 hasta E999)">
                        </div>
                        <div class="form-group">
                            <label for="txt_nombres2">Nombres</label>
                            <input type="text" class="form-control" id="txt_nombres2" name="txt_nombres2"
                                placeholder="Juan Jose" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_apellidos2">Apellidos</label>
                            <input type="text" class="form-control" id="txt_apellidos2" name="txt_apellidos2"
                                placeholder="Peralta Villeda" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_direccion2">Direccion</label>
                            <input type="text" class="form-control" id="txt_direccion2" name="txt_direccion2"
                                placeholder="Ciudad" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_telefono2">Telefono</label>
                            <input type="text" class="form-control" id="txt_telefono2" name="txt_telefono2"
                                placeholder="24427115" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_email2">email</label>
                            <input type="email" class="form-control" id="txt_email2" name="txt_email2"
                                placeholder="tuemal@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_fn2">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="txt_fn2" name="txt_fn2" placeholder="mm/dd/yyyy"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_tipo_sangre2" class="form-label">Tipo de Sangre</label>
                            <select class="form-control" name="txt_tipo_sangre2" id="txt_tipo_sangre2">
                                <option selected disabled>Selecciona un tipo de Sangre</option>
                                <?php
                                include("datos_conexion.php");
                                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name);
                                $sql = "SELECT id_tipo_sangre, sangre FROM tipos_sangre;";
                                $db_conexion->real_query($sql);
                                $resultado = $db_conexion->use_result();
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option value=". $fila["id_tipo_sangre"]. ">" . $fila["sangre"] . "</option>";
                                }
                                $db_conexion->close();
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="btn_modificar" name="btn_modificar" class="btn btn-primary"
                                value="Modificar">
                            <input type="submit" id="btn_eliminar" name="btn_eliminar" class="btn btn-danger"
                                value="Eliminar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- New Strudent Modal -->
    <div class="modal fade" id="newStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="crud_estudiantes.php" method="POST">
                        <div class="form-group">
                            <label for="txt_carne">Carne</label>
                            <input class="form-control" name="txt_carne" type="text" placeholder="E001 - E999"
                                required="" maxlength=45 pattern="E00[1-9]|E0[1-9][0-9]|E[1-9][0-9][0-9]"
                                title="Ingrese un valor válido (E001 hasta E999)">
                        </div>
                        <div class="form-group">
                            <label for="txt_nombres">Nombres</label>
                            <input type="text" class="form-control" id="txt_nombres" name="txt_nombres"
                                placeholder="Juan Jose" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="txt_apellidos" name="txt_apellidos"
                                placeholder="Peralta Villeda" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_direccion">Direccion</label>
                            <input type="text" class="form-control" id="txt_direccion" name="txt_direccion"
                                placeholder="Ciudad" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_telefono">Telefono</label>
                            <input type="text" class="form-control" id="txt_telefono" name="txt_telefono"
                                placeholder="24427115" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_email">email</label>
                            <input type="email" class="form-control" id="txt_email" name="txt_email"
                                placeholder="tuemal@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_fn">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="txt_fn" name="txt_fn" placeholder="YY/MM/DD"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_tipo_sangre" class="form-label">Tipo de Sangre</label>
                            <select class="form-control" name="txt_tipo_sangre" id="txt_tipo_sangre">
                                <option selected disabled>Selecciona un tipo de Sangre</option>
                                <?php
                                include("datos_conexion.php");
                                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_name);
                                $sql = "SELECT id_tipo_sangre, sangre FROM tipos_sangre;";
                                $db_conexion->real_query($sql);
                                $resultado = $db_conexion->use_result();
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option value=". $fila["id_tipo_sangre"]. ">" . $fila["sangre"] . "</option>";
                                }
                                $db_conexion->close();
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <input type="submit" id="btn_agregar" name="btn_agregar" class="btn btn-primary"
                                value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <script>
        $('#tbl_estudents').on('click', 'tr td', function (evt) {
            var target, id, ids, carne, nombres, apellidos, direccion, telefono, email, nacimiento;
            target = $(event.target);
            id = target.parent().data('id');
            ids = target.parent().data('ids');
            carne = target.parent("tr").find("td").eq(0).html().trim();
            nombres = target.parent("tr").find("td").eq(1).html().trim();
            apellidos = target.parent("tr").find("td").eq(2).html().trim();
            direccion = target.parent("tr").find("td").eq(3).html().trim();
            telefono = target.parent("tr").find("td").eq(4).html().trim();
            email = target.parent("tr").find("td").eq(5).html().trim();
            nacimiento = target.parent("tr").find("td").eq(6).html().trim();
            $("#txt_id2").val(id);
            $("#txt_carne2").val(carne);
            $("#txt_nombres2").val(nombres);
            $("#txt_apellidos2").val(apellidos);
            $("#txt_direccion2").val(direccion);
            $("#txt_telefono2").val(telefono);
            $("#txt_email2").val(email);
            $("#txt_fn2").val(nacimiento);
            $("#txt_tipo_sangre2").val(ids);
            $("#crudModal2").modal('show');
        });
    </script>

    <script>
        document.getElementById('btn_eliminar').addEventListener('click', function (event) {
            if (!window.confirm("¿Estás seguro de que deseas eliminar este estudiante?")) {
                event.preventDefault(); // Evita el envío del formulario si se cancela la confirmación
            }
        });
    </script>
</body>

</html>