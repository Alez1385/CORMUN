<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cormun</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet">
    <link rel="icon" href="./Imagenes/logo_cormun.png" type="image/png">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scflorez_cormun";

    // Crear conexión
    if(isset($_GET['id'])){
        $conexion = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Obtener el ID de usuario desde el código QR
        $id_usuario = $_GET['id'];

        // Consulta SQL para obtener los datos del usuario
        $sql = "SELECT del.*, carg.*, com.* FROM delegado del
        INNER JOIN cargo carg ON carg.cargo_ID = del.cargo_ID
        INNER JOIN comision com ON com.comision_ID = del.comision_ID
        WHERE del.delegado_id = $id_usuario";

        $resultado = $conexion->query($sql);

        // Verificar si se encontró algún usuario con ese ID
        if ($resultado->num_rows > 0) {
            // Mostrar los datos del usuario
            $usuario = $resultado->fetch_assoc();
            $nombre_del = $usuario['nombre_del'];
            $institucion_del = $usuario['institucion_del'];
            $tipo_doc_del = $usuario['tipo_doc_del'];
            $doc_del = $usuario['doc_del'];
            $grado_del = $usuario['grado_del'];
            $exp_modelos = $usuario['exp_modelos'];
            $img = $usuario['img'];
            $nombre_cargo = $usuario['nombre_cargo'];
            $desc_cargo = $usuario['desc_cargo'];
            $nombre_com = $usuario['nombre_com'];
            $desc_com = $usuario['desc_com'];
            $img_com = $usuario['img_com'];

            $img_del = imagecreatefromstring($img);
            $nombre_archivo = 'img_delegado.jpg';
            imagejpeg($img_del, $nombre_archivo);
            imagedestroy($img_del);


            $img_com = imagecreatefromstring($img_com);
            $nombre_archivo_com = 'img_com.jpg';
            imagejpeg($img_com, $nombre_archivo_com);
            imagedestroy($img_com);



            $conexion->close();
        }
    }
    ?>
</head>

<body>
    <div class="contenedor-principal">
        <div class="informacion-general">
            <div class="contenedor__imagen">
                <?php echo '<img src="' . $nombre_archivo . '" alt="Imagen" class="imagen_principal" id="img_del">'; ?>
            </div>


            <div class="text_principal_img">
                <div class="cont">
                    <h1 class="descripcion-profesion">Diputado</h1>
                </div>

                <div class="informacion__diputado__contenedor campos">
                    <div class="descripcion-informacion__diputado">
                        <h2 class="nombre informacion__diputado campos">Nombre: </h2>
                        <h2 class="institucion informacion__diputado campos">Institucion: </h2>
                        <h2 class="id__diputado informacion__diputado campos"><?php echo $tipo_doc_del; ?>: </h2>
                        <h2 class="grado informacion__diputado campos">Grado: </h2>
                    </div>
                    <div class="descripcion-informacion__diputado">
                        <h2 class="nombre informacion__diputado"><?php echo $nombre_del; ?></h2>
                        <h2 class="institucion informacion__diputado"><?php echo $institucion_del; ?></h2>
                        <h2 class="id__diputado informacion__diputado"><?php echo $doc_del; ?></h2>
                        <h2 class="grado informacion__diputado"><?php echo $grado_del; ?></h2>
                    </div>
                </div>

                <div class="experiencia__contenedor">
                    <h1 class="titulo-experiencia">Experiencia en modelos</h1>
                    <p class="descripcion__delegado"><?php echo $exp_modelos; ?></p>
                </div>

                <div class="comision__contenedor">
                    <h1 class="nombre-comision"><?php echo $nombre_com; ?></h1>
                    <div class="informacion__comision__contenedor">
                        <?php echo '<img src="' . $nombre_archivo_com . '" alt="Imagen" class="imagen_principal" id="imagen_del">'; ?>
                        <p class="informacion__comision"><?php echo $desc_com; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('beforeunload', function(event) {
            // Envía una solicitud AJAX al script PHP para eliminar la imagen
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'eliminar_imagen.php', true);
            xhr.send();
        });
    </script>


</body>

</html>