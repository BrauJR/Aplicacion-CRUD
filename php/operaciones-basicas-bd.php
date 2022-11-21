<?php
$conexion = mysqli_connect("localhost", "root", "") or die("No se pudo conectar con el servidor de BD");
echo "Conectado al servidor de BD MySQL <br/>";
mysqli_select_db($conexion, "mis_contactos") or die("No se pudo seleccionar la BD");
echo "BD seleccionada: <b>mis_contactos</b><br/>";
echo "<h1>Las 4 operaciones b&aacute;sicas a una BD</h1>";
echo "<h2>1) INSERCI&Oacute;N DE DATOS</h2>";
// INSERT INTO nombre_tabla (campos_tabla) VALUES (valores_campos)
$consulta = "INSERT INTO contactos (email, nombre, sexo, nacimiento, telefono, pais, imagen) VALUES ('juanZe@hotmail.com', 'Juan Pérez', 'M', '2000-03-29', '525532124310', 'M&eacute;xico', 'juan.png')";
           // $ejecutar_consulta = mysqli_query($conexion, $consulta);
echo "Se han insertado los datos :) <br/>";

echo "<h2>ELIMINACI&Oacute;N DE DATOS</h2>";
// DELETE FROM nombre_tabla WHERE campo = valor
$consulta = "DELETE FROM contactos WHERE email = 'juanQe@hotmail.com'";
           //$ejecutar_consulta = mysqli_query($conexion, $consulta);
echo "Datos eliminados :) <br/>";

echo "<h2>MODIFICACI&Oacute;N DE DATOS</h2>";
// UPDATE nombre_tabla SET nombre_campo = valor_campo, otro_campo = otro_valor WHERE campo = valor
$consulta = "UPDATE contactos SET email = 'actualizado@hotmail.com', nombre = 'NewJuan', imagen = 'image.jpeg' WHERE email = 'juanPe@hotmail.com'";
$ejecutar_consulta = mysqli_query($conexion, $consulta);
echo "Los datos han sido modificados :) <br/>";

echo "<h2>CONSULTA (b&uacute;squeda) DE DATOS</h2>";
// SELECT * FROM nombre_tabla WHERE campo = valor
$consulta = "SELECT * FROM contactos";
$ejecutar_consulta = mysqli_query($conexion, $consulta);

echo "<h3>CONSULTA QUE TRAE TODOS LOS REGISTROS DE LA TABLA</h3>";

while($registro = mysqli_fetch_array($ejecutar_consulta)) {
    echo $registro["email"]."---";
    echo $registro["nombre"]."---";
    echo $registro["sexo"]."---";
    echo $registro["nacimiento"]."---";
    echo $registro["telefono"]."---";
    echo $registro["pais"]."---";
    echo $registro["imagen"]."---";
    echo "<br/>";
}

$consulta = "SELECT * FROM contactos WHERE nombre = 'NewJuan'";
$ejecutar_consulta = mysqli_query($conexion, $consulta);

echo "<h3>CONSULTA QUE TRAE TODOS LOS REGISTROS DE LA TABLA  CON EL nombre = 'NewJuan'</h3>";

while($registro = mysqli_fetch_array($ejecutar_consulta)) {
    echo $registro["email"]."---";
    echo $registro["nombre"]."---";
    echo $registro["sexo"]."---";
    echo $registro["nacimiento"]."---";
    echo $registro["telefono"]."---";
    echo $registro["pais"]."---";
    echo $registro["imagen"]."---";
    echo "<br/>";
}

$consulta = "SELECT * FROM contactos WHERE sexo = 'M' AND nacimiento = '2000-03-29'";
$ejecutar_consulta = mysqli_query($conexion, $consulta);

echo "<h3>CONSULTA QUE TRAE TODOS LOS REGISTROS DE LA TABLA  CON EL sexo = 'M' y nacimiento = '2000-03-29'</h3>";

while($registro = mysqli_fetch_array($ejecutar_consulta)) {
    echo $registro["email"]."---";
    echo $registro["nombre"]."---";
    echo $registro["sexo"]."---";
    echo $registro["nacimiento"]."---";
    echo $registro["telefono"]."---";
    echo $registro["pais"]."---";
    echo $registro["imagen"]."---";
    echo "<br/>";
}


mysqli_close($conexion);
echo "<br/>Conexi&oacute;n CERRADA";
?>