<?php
include 'varss.php';

#verificar si vienen losparametros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta nombre del medicamento"); #Terminar el script definitivamente
}

if (empty($_POST["stock"])) {
    http_response_code(400);
	exit("falta la cantidad en stock"); #Terminar el script definitivamente
}
if (empty($_POST["precio"])) {
    http_response_code(400);
	exit("falta precio del producto"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Medicina=[
    "nombre"=> $_POST["nombre"],
    "stock"=> $_POST["stock"],
    "precio"=> $_POST["precio"]
];
try{
    # preparando la cosnaulta
    $sentencia = $conex->prepare("insert into Medicina(nombre,stock,precio) values(:nombre, :stock, :precio);");
    $resultado = $sentencia->execute($Medicina);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Error 404:".$exc->getMessage();

}

?>