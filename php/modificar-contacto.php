<?php
// Asigno a variables php los valores que viene del formulario como el cmapo del email
$email = $_POST["email_txt"];
$nombre = $_POST["nombre_txt"];
$sexo = $_POST["sexo_rdo"];
$nacimiento = $_POST["nacimiento_txt"];
$telefono = $_POST["telefono_txt"];
$pais = $_POST["pais_slc"];

include ("conexion.php");
$consulta = "SELECT * FROM contactos WHERE email = '$email'";
$ejecutar_consulta = $conexion->query($consulta);
$num_regs = $ejecutar_consulta->num_rows;

if ($num_regs == 1) {
    // Si la foto viene vacia asignamos el botón oculto de la foto que tiene el valor anteriror a la busqueda, sino subo la nueva foto y reemplazo el valor
    if (empty($_FILES["foto_fls"]["tmp_name"])) {
        $imagen = $_POST["foto_hdn"];
    } else {
        // Se ejecuta la función para subir la imagen
        include "funciones.php";
        $tipo = $_FILES["foto_fls"]["type"];
        $archivo = $_FILES["foto_fls"]["tmp_name"];
        $imagen = subir_imagen($tipo, $archivo, $email);
    }
    // Actualizo los datos a la BD
    $consulta = "UPDATE contactos SET nombre = '$nombre', sexo = '$sexo', nacimiento = '$nacimiento', telefono = '$telefono', pais = '$pais', imagen = '$imagen' WHERE email = '$email'";
    $ejecutar_consulta = $conexion->query(($consulta));
    if($ejecutar_consulta) {
        $mensaje = "Se han hecho los cambios en los datos del contacto con el email <b>$email :)</b>";
    } else {
        $mensaje = "No se han hecho los cambios en los datos del contacto con el email <b>$email :(</b>";
    }

} else {
    $mensaje = "No se pudieron hacer los cambios en los datos del contacto con el email <b>$email</b> porque no existe o está duplicado";
}
$conexion->close();
header("Location:../index.php?op=cambios&mensaje=$mensaje");
