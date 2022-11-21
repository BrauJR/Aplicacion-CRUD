<br>
<div>
    <label for="m">Sexo:</label>
    <input type="hidden" name="op" value="consultas">
    <input type="radio" name="sexo_rdo" id="m" title="Tu sexo" value="M" required>
    <label for="m" id="lm">Masculino</label> &nbsp;&nbsp;&nbsp;
    <input type="radio" name="sexo_rdo" id="f" title="Tu sexo" value="F" required>
    <label for="f" id="lf">Femenino</label> 
</div>
<input type="submit" id="enviar-buscar" class="cambio" name="enviar_btn" value="buscar">
<?php
if($_GET["sexo_rdo"] != null) {
    $sexo = $_GET["sexo_rdo"];
    $consulta = "SELECT * FROM contactos WHERE sexo = '$sexo'";
    include("tabla-resultados.php");
}
?>