<?php


session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// function errorHandler($errno, $errstr) {
//   throw new Exception($errno, $errstr);
// }

// set_error_handler('errorHandler');

function eCatcher($e)
{
  if ($_ENV["APP_ENV"] == "dev") {
    $whoops = new \Whoops\Run;
    $whoops->allowQuit(false);
    $whoops->writeToOutput(false);
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $html = $whoops->handleException($e);

    require 'app/Views/errors/error.php';
  }
}
try {
  $controllerFront = new \Climactions\Controllers\FrontController();


  if (isset($_GET['action']) && !empty($_GET['action'])) {

    // afficher page home
    if ($_GET['action'] == 'home') {
      $controllerFront->home();
    }


    // afficher page des articles 
    elseif ($_GET['action'] == 'pageArticle') {
      $query = $_POST['query'] ?? "";
      $controllerFront->pageArticle($query);
    }


    // afficher un article 
    elseif ($_GET['action'] == 'article') {
      $idResource = $_GET['id'];
    // $idType = $_GET['type'];
    // var_dump(($_GET['action'] == 'article&id=&type='));die;
          if((!$idResource)){
              header('Location: pageArticle');
          }
          else{

            $controllerFront->article($idResource);
          }
    }
    


    // afficher page contact 
    elseif ($_GET['action'] == 'contact') {
      $controllerFront->contact();
    }

    // afficher page legalMention
    elseif ($_GET['action'] == 'legalNotice') {
      $controllerFront->legalNotice();
    }

    // afficher page cgu.php
    elseif ($_GET['action'] == 'cgu') {
      $controllerFront->cgu(); 
    }

    // afficher page cookies.php
    elseif ($_GET['action'] == 'cookies') {
      $controllerFront->cookies();
    }

    // envoi mail en BDD 
    elseif ($_GET['action'] == 'contactPost') {
      $lastname = htmlspecialchars($_POST['lastname']);
      $firstname = htmlspecialchars($_POST['firstname']);
      $email = htmlspecialchars($_POST['email']);
      $object = htmlspecialchars($_POST['object']);
      $message = htmlspecialchars($_POST['message']);

      if (!empty($lastname) && (!empty($firstname) && (!empty($email) && (!empty($object) && (!empty($message)))))) {
        $controllerFront->contactPost($lastname, $firstname, $email, $object, $message);
      } else {
        throw new Exception('Tous les champs ne sont pas remplis!!');
      }
    }
    else{
      throw new Exception("Cette page n'existe pas !");
    }
  } else {
    $controllerFront->home();
  }
} catch (Exception $e) {
  eCatcher($e);
  if ($e->getCode() === 404) {
    die('Erreur : ' . $e->getMessage());
  } else {
    require "app/Views/errors/404.php";
  }
  // require "app/Views/errors/404.php";
} 
catch (Error $e) {
  eCatcher($e);
  header("location: app/Views/errors/oops.php");
}
