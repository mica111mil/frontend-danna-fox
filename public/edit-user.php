<?php

use Doctrine\Common\Collections\ArrayCollection;

require(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
require(__DIR__ . '/../config/bootstrap.php');

$em = GetEntityManager();  


if (isset($_POST['edit'])) {

  $user = isset($_GET['id']) ? $em->getReference('Models\User', $_GET['id']) : null;

  if (isset($user)) {

    #$client = $campaign->getCliente();   NO SE COMO VA
    #$localities = new ArrayCollection();    NO VA
    #$rawLocalities = $_POST['localidades'];    NO var

    /*foreach ($rawLocalities as $id) {
      $locality = $em->find('Models\Locality', $id);
      $localities->add($locality);
    }  ESTO TAMPOCO VA*/

    #$campaign->setLocalidades($localities);
    $campaign->setNombre($_POST['nombre_campania']);
    $campaign->setTexto($_POST['text']);

    if (!empty($_POST['cantidad_mensajes'])) {
      $campaign->setCantidadMensajes($_POST['cantidad_mensajes']);
    }

    if (!empty($_POST['estado'])) {
      $campaign->setEstado($_POST['estado']);
    }

    $user->setNombre($_POST['nombre']);
    $user->setApellido($_POST['apellido']);
    $user->setTipoDocumento($_POST['tipodocumento']);
    $user->setNumeroDocumento($_POST['numerodocumento']);
    $user->setEmail($_POST['email']);
    $user->setNacimiento($_POST['nacimiento']);
    $user->setTelefono($_POST['telefono']);


    #$campaign->setCliente($client);
    
    $em->flush(); #ejecuta lo anterior
    header('Location: ../?id=' . $_GET['id']);
  }
}
