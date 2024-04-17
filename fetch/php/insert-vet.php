<?php
include 'varss.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["cedula"])) {
    http_response_code(400);
	exit("Falta cedula"); #Terminar el script definitivamente
}

if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("falta nombre"); #Terminar el script definitivamente
}
if (empty($_POST["puesto"])) {
    http_response_code(400);
	exit("falta puesto laboral"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Empleados=[
    "cedula"=> $_POST["cedula"],
    "nombre"=> $_POST["nombre"],
    "puesto"=> $_POST["puesto"]
];
try{
    # preparando la consulta
    $sentencia = $conex->prepare("insert into Empleados(cedula,nombre,puesto) values(:cedula, :nombre, :puesto);");
    $resultado = $sentencia->execute($Empleados);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Error 404:".$exc->getMessage();

}

?>