<?php
include "index.php";
// Elimina la imagen del servidor
if(file_exists($nombre_archivo) && file_exists($nombre_archivo_com)) {
    unlink($nombre_archivo);
    unlink($nombre_archivo_com);
}

