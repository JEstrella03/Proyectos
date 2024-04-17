<?php
include 'varss.php';

#verificar si veinen los parametros requeridos
if (empty($_POST["id"])) {
    http_response_code(400);
	exit("Falta id"); 
}

if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta nombre nuevo de la mascota"); 
}

if (empty($_POST["edad"])) {
    http_response_code(400);
	exit("falta edad nueva a ingresar"); 
}
if (empty($_POST["estado"])) {
    http_response_code(400);
	exit("falta estado actualizado"); 
}

if (empty($_POST["dueno"])) {
    http_response_code(400);
	exit("falta nombre del dueño a editar"); 
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$maskota=[
    "id"=> $_POST["id"],
    "nombre"=> $_POST["nombre"],
    "edad"=> $_POST["edad"],
    "estado"=> $_POST["estado"],
    "dueno"=> $_POST["dueno"]
];
try{
    # preparando la cosnaulta
    $sentencia = $conex->prepare("update Maskota set nombre=:nombre, edad=:edad, estado=:estado, dueno=:dueno where id=:id;");
    $resultado = $sentencia->execute($maskota);
    http_response_code(200);
    echo "datos actualizados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "ERROR 69:".$exc->getMessage();
}

?>