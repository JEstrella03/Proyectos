<?php
include 'varss.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta nombre"); #Terminar el script definitivamente
}

if (empty($_POST["edad"])) {
    http_response_code(400);
	exit("falta edad de la mascota"); #Terminar el script definitivamente
}
if (empty($_POST["estado"])) {
    http_response_code(400);
	exit("falta poner el estado de la mascota"); #Terminar el script definitivamente
}

if (empty($_POST["dueno"])) {
    http_response_code(400);
	exit("falta nombre del dueño"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$maskota=[
    "nombre"=> $_POST["nombre"],
    "edad"=> $_POST["edad"],
    "estado"=> $_POST["estado"],
    "dueno"=> $_POST["dueno"]
];
try{
    # preparando la cosnaulta
    $sentencia = $conex->prepare("insert into maskota(nombre,edad,estado,dueno) values(:nombre, :edad, :estado, :dueno);");
    $resultado = $sentencia->execute($maskota);
    http_response_code(200);
    echo "datos cargados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Error 404:".$exc->getMessage();

}

?>