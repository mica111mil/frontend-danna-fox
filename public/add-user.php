<?php

use Models\User;

require(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
require(__DIR__ . '/../config/bootstrap.php');

$em = GetEntityManager();
#$createdCampaigns = $em->getRepository('Models\User')->count(['estado' => 'CREADA']);    NO SE USA
#$executedCampaigns = $em->getRepository('Models\User')->count(['estado' => 'EN EJECUCIÓN']);   NO SE USA
#$count = $createdCampaigns + $executedCampaigns;  NO SE USA

if (isset($_POST['submit'])) {  #comprueba que el formulario se envio , esto lo voy a cambiar acorde al usuario


  $user = new User(); #creacion del objeto user

 # $existingUser = $em->getRepository('Models\User')->findOneBy(['cuilcuit' => $_POST['cuitcuil']]); busca el cliente asociado al cuil del formulario

  if (isset($existingUser)) {
    echo "Ya existe un cliente con ese Cuil/Cuit";
    return;
  } else {
    $user->setNombre($_POST['nombre']);
    $user->setApellido($_POST['apellido']);
    $user->setTipoDocumento($_POST['tipodocumento']);
    $user->setNumeroDocumento($_POST['numerodocumento']);
    $user->setEmail($_POST['email']);
    $user->setNacimiento($_POST['nacimiento']);
    $user->setTelefono($_POST['telefono']);
  }

  $em->persist($user); #guardar los datos en la base de datos
  $em->flush(); #ejecuta lo anterior

  header('Location: ../'); #redireccion al inicio
} else {
  echo "El formulario no ha sido enviado correctamente...";
}
