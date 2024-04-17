<?php
include 'varss.php';
$conex = new PDO("sqlite:" . $nombre_fichero);

$stmt = $conex->prepare('SELECT * FROM Maskota;');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

//cerrar la bd
$stmt=null;
$conex=null;
//responder
http_response_code(200);
echo json_encode($data);

?>