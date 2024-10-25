<?php
$uploadDir = 'uploads/';
$defaultImage = 'calavera.jpg';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $alias = htmlspecialchars($_POST['alias']);
    $edad = (int)$_POST['edad'];
    $armas = isset($_POST['armas']) ? implode(', ', $_POST['armas']) : 'Ninguna';
    $artesMagicas = $_POST['artes_magicas'] === 'si' ? 'Sí' : 'No';

    $imagenSubida = $defaultImage;
    $errorImagen = '';

    if (isset($_FILES['imagen'])) {
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['imagen']['tmp_name'];
            $fileName = basename($_FILES['imagen']['name']);
            $fileSize = $_FILES['imagen']['size'];
            $fileType = mime_content_type($fileTmpPath);

            if ($fileType === 'image/png' && $fileSize <= 10240) {
                $destPath = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $imagenSubida = $destPath;
                } else {
                    $errorImagen = 'Error al mover la imagen al directorio de uploads.';
                }
            } else {
                $errorImagen = 'La imagen debe ser un archivo PNG y no exceder 10 kB.';
            }
        } else {
            $errorImagen = 'Error en la subida del archivo: ' . $_FILES['imagen']['error'];
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: yellow;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .info {
            max-width: 600px;
            padding: 20px;
            margin-right: 20px;
            display: inline-block;
            vertical-align: top;
        }
        .info h2 {
            text-align: center;
        }
        .info p {
            margin: 10px 0;
        }
        .image-container {
            text-align: center;
            display: inline-block;
            margin-left: 20px;
        }
        .image-wrapper {
            border: 2px solid #333;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
        img {
            width: 150px;
            height: auto;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="info">
            <h2>Datos del Jugador</h2>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Alias:</strong> <?php echo $alias; ?></p>
            <p><strong>Edad:</strong> <?php echo $edad; ?></p>
            <p><strong>Armas seleccionadas:</strong> <?php echo $armas; ?></p>
            <p><strong>¿Practica artes mágicas?:</strong> <?php echo $artesMagicas; ?></p>
        </div>
        <div class="image-container">
            <?php if ($imagenSubida !== $defaultImage) { ?>
                <strong>Imagen subida:</strong><br>
                <div class="image-wrapper">
                    <img src="<?php echo $imagenSubida; ?>" alt="Imagen del jugador">
                </div>
            <?php } else { ?>
                <strong>No se subió ninguna imagen.</strong><br>
                <div class="image-wrapper">
                    <img src="<?php echo $defaultImage; ?>" alt="Calavera">
                </div>
            <?php } ?>
            <?php if ($errorImagen) { ?>
                <p class="error"><?php echo $errorImagen; ?></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
<?php
} else {
    include('captura.html');
}
?>






