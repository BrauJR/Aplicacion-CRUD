<?php

// El parámetro de $extensión determina que tipo de imagen no se borrará, por ejmplo se es jpg significa que la imagen con la extensiíon .jpp se queda en el servidor y si existen imagenes con el mismo nombre pero con extensión png o gif se eliminaran, con esta función evito tener imagenes duplicadas con distinta extensiones para cada perfil la funcion file_exists evalua si un archivo existe y la función unlink borra un archivo del servidor
function borrar_imagenes($ruta, $extension)
{
    switch ($extension) {
        case ".jpeg":
            if (file_exists($ruta . ".png")) {
                unlink($ruta . ".png");
            }
            if (file_exists($ruta . ".gif")) {
                unlink($ruta . ".gif");
            }
            break;
        case ".gif":
            if (file_exists($ruta . ".png")) {
                unlink($ruta . ".png");
            }
            if (file_exists($ruta . ".jpeg")) {
                unlink($ruta . ".jpeg");
            }
            break;
        case ".png":
            if (file_exists($ruta . ".jpeg")) {
                unlink($ruta . ".jpeg");
            }
            if (file_exists($ruta . ".gif")) {
                unlink($ruta . ".gif");
            }
            break;
    }
}

// Función para subir la imagen del perfil del usuario
function subir_imagen($tipo, $imagen, $email)
{
    // strstr($cadena1, $caden2) sirve para evaluar si en la primer cadena de texto existe la segunda cadena de texto
    // Si dentro del tipo de archivo se encuentra la palabra image significa que el archivo es una imagen
    if (strstr($tipo, "image")) {
        // El archivo si es una imagen
        if (strstr($tipo, "jpeg")) {
            $extension = ".jpeg";
        } else if (strstr($tipo, "gif")) {
            $extension = ".gif";
        } else if (strstr($tipo, "png")) {
            $extension = ".png";
        }
        // Para saber si la imagen tiene el ancho correcto que es de 420px
        $tam_img = getimagesize($imagen);
        $ancho_img = $tam_img[0];
        $alto_img = $tam_img[1];

        $ancho_img_deseado = 420;
        // Si la imagen es mayor en su ancho que 420px, reajusto su tamaño
        if ($ancho_img > $ancho_img_deseado) {
            // Reajustamos
            // Por una regla de 3 obtengo el alto de la imagen de manera proporcional al ancho nuevo que será 420
            $nuevo_ancho_img = $ancho_img_deseado;
            $nuevo_alto_img = ($alto_img / $ancho_img) * $nuevo_ancho_img;

            // Creo una imagen en color real con las nuevas dimensiones
            $img_reajustada = imagecreatetruecolor($nuevo_ancho_img, $nuevo_alto_img);

            // Creo una imagen basada en la original, dependiendo de su extension es el tipo que crearé
            switch ($extension) {
                case ".jpeg":
                    $img_original = imagecreatefromjpeg($imagen);
                    // Reajusto la imagen nueva con respecto a la original
                    imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, $ancho_img, $alto_img);
                    // Guardo la imagen reescalada en el servidor
                    $nombre_img_ext = "../img/fotos/" . $email . $extension;
                    $nombre_img = "../img/fotos/" . $email;
                    imagejpeg($img_reajustada, $nombre_img_ext, 100);
                    // Ejecuto la función para borrar posibles imágenes dobles para el perfil
                    borrar_imagenes($nombre_img, ".jpeg");
                    break;
                case ".gif":
                    $img_original = imagecreatefromgif($imagen);
                    // Reajusto la imagen nueva con respecto a la original
                    imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, $ancho_img, $alto_img);
                    // Guardo la imagen reescalada en el servidor
                    $nombre_img_ext = "../img/fotos/" . $email . $extension;
                    $nombre_img = "../img/fotos/" . $email;
                    imagegif($img_reajustada, $nombre_img_ext, 100);
                    // Ejecuto la función para borrar posibles imágenes dobles para el perfil
                    borrar_imagenes($nombre_img, ".gif");
                    break;
                case ".png":
                    $img_original = imagecreatefrompng($imagen);
                    // Reajusto la imagen nueva con respecto a la original
                    imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, $ancho_img, $alto_img);
                    // Guardo la imagen reescalada en el servidor
                    $nombre_img_ext = "../img/fotos/" . $email . $extension;
                    $nombre_img = "../img/fotos/" . $email;
                    imagepng($img_reajustada, $nombre_img_ext);
                    // Ejecuto la función para borrar posibles imágenes dobles para el perfil
                    borrar_imagenes($nombre_img, ".png");
                    break;
            }
        } else {
            // No se reajusta y se sube

            // Guardo la ruta que tendra en el servidor la imagen
            $destino = "../img/fotos/" . $email . $extension;

            // Se sube la foto
            move_uploaded_file($imagen, $destino) or die("No se pudo subir la imagen al servidor :(");
            // Ejecuto la función para borrar posibles imágenes dobles para el perfil
            $nombre_img = "../img/fotos/" . $email;
            borrar_imagenes($nombre_img, $extension);
        }

        // Asigno el nombre de la foto que se guargará en la BD como cadena de texto
        $imagen = $email . $extension;
        return $imagen;

    } else {
        return false;
    }
}
