<?php
// Pasos para conectarme a una BD MySQL con PHP
// 1. Conectarme a la BD, mysql_connect necesita 3 datos:
      // a) Servidor
      // b) Usuario de la BD
      // C) Password del usuario de la BD
$conexion = mysqli_connect("localhost", "root", "") or die("No se pudo conectar con el servido de BD");
echo "Estoy conectado a MySQL <br/>";
// 2. Seleccionar la base d edatos con la que vamos a trabajar
mysqli_select_db($conexion, "mis_contactos") or die("No se pudo seleccionar la BD: mis_contactos");
echo "BD seleccionada: mis_contactos <br/>";
// 3. Crear una consulta SQL
$consulta = "SELECT * FROM pais";
// 4. Ejecutar la consulta SQL
$ejecutar_consulta = mysqli_query($conexion, $consulta) or die ("No se pudo ejecutar la consulta");
echo "Se ejecut&oacute la consulta SQL <br/>";
// 5. Mostrar el resultado de ejecutar la consulta, dentro de un ciclo y en una variable voy a ingresar la función mysqli_fetch_array()
while($registro = mysqli_fetch_array($ejecutar_consulta)) {
    echo $registro["id_pais"]." - ".$registro["pais"]."<br/>";
}
// Cerrar la conexión a la BD
mysqli_close($conexion) or die ("Ocurrió un error al cerrar la BD");
echo "Conexión cerrada"
?>