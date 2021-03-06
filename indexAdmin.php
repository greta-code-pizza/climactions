<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'app/Views/admin/layouts/secure.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Create an instance; passing `true` enables exceptions

// function errorHandler($errno, $errstr) {
  //   throw new Exception($errno, $errstr);
  // }

// set_error_handler('errorHandler');

function eCatcher($e) {
  if($_ENV["APP_ENV"] == "dev") {
    $whoops = new \Whoops\Run;
    $whoops->allowQuit(false);
    $whoops->writeToOutput(false);
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $html = $whoops->handleException($e);
    
    require 'app/Views/errors/error.php';
  }
}

try {

    $backController = new \Climactions\Controllers\AdminController();
    
    if (isset($_GET['action'])) {
        
        if($_GET['action'] == 'pageCreationAdmin') {
          isConnect();
          $backController->pageConnexionAdmin();
    
        }

        // create an admin 
        elseif($_GET['action'] == 'creatAdmin') {
            isConnect();
            $lastname   = htmlspecialchars($_POST['lastname']);
            $firstname  = htmlspecialchars($_POST['firstname']);
            $email       = htmlspecialchars($_POST['email']);
            $pass   = htmlspecialchars($_POST['password']);

            $password   = password_hash($pass, PASSWORD_DEFAULT);

            $erreur = $backController->createAdmin($lastname, $firstname, $email, $password);
        }

        // go to page connect admin 
        elseif($_GET['action'] == 'connexionAdmin'){

          require $this->viewAdmin('connexionAdmin');
        }

        elseif($_GET['action'] == 'connectAdmin') {
          $email = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['password']);
          if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
            $backController->connexion($email, $password); 
          } else {
              throw new Exception('renseigner vos identifiants');
          }
        }

        elseif($_GET['action'] == 'home'){
          if(isset($_SESSION['id'])){
            $backController->dashboardAdmin();
          }
          else {
            throw new Exception("Veuillez renseigner vos identifiants");
          }
        }

        // logout admin 
          elseif($_GET['action'] == 'deconnexion'){
            isConnect();
          $backController->deconnexion();
      }
        
        
        // go to page forgot_password
        elseif($_GET['action'] == 'forgot_password'){
          $backController->forgot_password();
        }

        // send mail to receive new password 
        elseif($_GET['action'] == 'emailPost'){
          $backController->changePassword();
        }

        // go to page create new password 
        elseif($_GET['action'] == 'pageNewPassword'){
          isConnect();
          $backController->pageNewPassword($_GET['id']);
          
          }
          
        // confirm new password 
        elseif($_GET['action'] == 'newPasswordPost'){
          isConnect();
          if(isset($_SESSION['id']) && isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['passwordConfirm'])){

            $id = $_GET['id'];
            $oldPassword = htmlspecialchars($_POST['oldPassword']);
            $newPassword = htmlspecialchars($_POST['newPassword']);
            $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);
            
            $erreur = $backController->createNewPassword($id, $oldPassword, $newPassword);

          }
        }
        
        elseif ($_GET['action'] == 'formUpdateArticle') {
          isConnect();
          $idArticle = $_GET['id'];
          $typeId = $_GET['type_id'];
          $backController->formUpdateArticle($idArticle,$typeId);
        }

        elseif ($_GET['action'] == 'updateResourceExpo') {
          isConnect();
          $idArticle = $_GET['id'];
          $name = htmlspecialchars($_POST['name']);
          $themeId = htmlspecialchars($_POST['theme']);
          $file = $_FILES['image'];
          $path = $backController->upload($file);
          $content = $_POST['editor1'];
          $quantity = htmlspecialchars($_POST['quantity']);
          $deposit = htmlspecialchars($_POST['deposit']);
          $publicId =  $_POST['name-public'];
          $conditionId = htmlspecialchars($_POST['condition']);
          $role = htmlspecialchars($_POST['role']);
          $personality =  htmlspecialchars(trim($_POST["name-author"]));
          $poster = $_POST["format-poster"];
          $sign = $_POST["format-sign"];
          $kakemono = $_POST["format-kakemono"];
          

          $data = [
            "id" => $idArticle,
            "name" => $name,
            "theme" => $themeId,
            "image" =>$path,
            "content" =>$content,
            "quantity" => $quantity,
            "deposit" => $deposit,
            "public" => $publicId,  
            "condition" => $conditionId,
            "poster" =>$poster,
            "sign" => $sign,
            "kakemono" => $kakemono,
            "role" => $role,
            "personality" => $personality 
          ];

          $backController->updateResourceExpo($data);
          

        }

        elseif ($_GET['action'] == 'updateOtherResources') {
          isConnect();
          $idArticle = $_GET['id'];
          $name = htmlspecialchars($_POST['name']);
          $themeId = htmlspecialchars($_POST['theme']);
          $file = $_FILES['image'];
          $path = $backController->upload($file);
          $content = $_POST['editor1'];
          $quantity = htmlspecialchars($_POST['quantity']);
          $deposit = htmlspecialchars($_POST['deposit']);
          $publicId =  $_POST['name-public'];
          $conditionId = htmlspecialchars($_POST['condition']);
          $role = htmlspecialchars($_POST['role']);
          $personality =  htmlspecialchars(trim($_POST["name-author"]));
          $data = [
            "id" => $idArticle,
            "name" => $name,
            "theme" => $themeId,
            "image" =>$path,
            "content" =>$content,
            "quantity" => $quantity,
            "deposit" => $deposit,
            "public" => $publicId,  
            "condition" => $conditionId,
            "role" => $role,
            "personality" => $personality
          ];


          $backController->updateOtherResources($data);
        }
        
        elseif ($_GET['action'] == 'deleteArticle') {
          isConnect();
          $idRessources = $_GET['id'];
          $backController->deleteArticle($idRessources);
        } 
        
        // go to page home admin 
        // les pages de l'administration

        elseif($_GET['action'] == 'homeAdmin'){
          isConnect();
          $backController->homeAdmin();
        }

        elseif($_GET['action'] == 'emailAdmin'){
          isConnect();

          $query = $_POST['query'] ?? "";

          if (isset($_GET['page']) && !empty($_GET['page'])) {

            $currentPage = (int) strip_tags($_GET['page']);

        } else {
            $currentPage = 1;
        }
          $backController->emailAdmin($query, $currentPage);
        }

        elseif($_GET['action'] == 'accountAdmin'){
          isConnect();
          $backController->accountAdmin($_GET['id']);
        }
        // affichage de la page resources.php (barre de recherche et pagination)
        
        elseif($_GET['action'] == 'resourceAdmin'){

          isConnect();

          $query = $_POST['query'] ?? "";

          if (isset($_GET['page']) && !empty($_GET['page'])) {

            $currentPage = (int) strip_tags($_GET['page']);

          } else {
              $currentPage = 1;
          }
            $backController->resourceAdmin($query, $currentPage);
        }
        elseif($_GET['action'] == 'addressBookAdmin'){

          isConnect();
          $query = $_POST['query'] ?? "";
          $backController->addressBookAdmin($query);
          
        }
        
        // les m??thodes de la page Resource.php

        elseif($_GET['action'] == 'formCreateResource'){
          isConnect();
          $backController->formCreateResource();
        }

        // method page home.php 

        elseif($_GET['action'] == 'readAdmin'){
          isConnect();
          $backController->readAdmin($_GET['id']);
        }

        elseif($_GET['action'] == 'deleteAdmin'){
          isConnect();
          $backController->deleteOneAdmin($_GET['id']);
        }

        // les m??thodes de la page email.php

        elseif($_GET['action'] == 'readEmail'){
          isConnect();
          $id = $_GET['id'];
          $read = $_GET['read'];
          $adminId = $_SESSION['id'];
          $backController->readEmail($id,$read,$adminId);
        }
        elseif($_GET['action'] == 'deleteEmail'){
          isConnect();
          $id = $_GET['id'];
          $backController->deleteEmail($id);
        } 

        // les m??thodes de la page addressBook.php

        elseif($_GET['action'] == 'addAddressBook'){
          
          isConnect();
          $id = $_GET['id'];$query = $_POST['query'] ?? "";

          if (isset($_GET['page']) && !empty($_GET['page'])) {

            $currentPage = (int) strip_tags($_GET['page']);

          } else {
              $currentPage = 1;
          }
          $backController->addAddressBook($id,$query, $currentPage);
        }

        elseif($_GET['action'] == 'deleteInfo'){
          isConnect();
          $id = $_GET['id'];
          $backController->deleteInfo($id);
        }

        // enregistrement d'un image

        elseif($_GET['action'] == 'upload'){
          isConnect();
          $file = $_FILES['image'];
          $path = $backController->upload($file);
        }

        // ------------------------------
        // cr??ation d'une ressource
        // ------------------------------

        elseif($_GET['action'] == 'create'){

          $name = htmlspecialchars($_POST['name']);
          $themeId = htmlspecialchars($_POST['theme']);
          $file = $_FILES['image'];
          $path = $backController->upload($file);
          $content = htmlspecialchars($_POST['editor1']);
          $quantity =  $_POST['quantity'];
          $deposit =  htmlspecialchars($_POST['deposit']);
          $publicId =  $_POST['name-public'];  
          $typeId =  $_POST['type'];
          $conditionId = $_POST['condition'];
          $role = htmlspecialchars($_POST['role']);
          $adminId = $_SESSION['id'];      
          $personality =  htmlspecialchars(trim($_POST["name-author"]));
          
          $data = [
            "name" => $name,
            "theme" => $themeId,
            "image" => $path,
            "content" =>$content,
            "quantity" => $quantity,
            "deposit" => $deposit,
            "public" => $publicId,
            "type" => $typeId,
            "condition" => $conditionId,
            "admin" => $adminId,
            "role" => $role,
            "personality" => $personality          
          ];

          $backController->createResource($data);
        }

        // // // -------------------------
        // // // cr??ation d'une exposition
        // // // -------------------------

        elseif($_GET['action'] == 'create-expo'){
          isConnect();
          
          $name = htmlspecialchars($_POST['name']);
          $themeId = htmlspecialchars($_POST['theme']);
          $file = $_FILES['image'];
          $path = $backController->upload($file);
          $content = $_POST['editor1'];
          $quantity = htmlspecialchars($_POST['quantity']);
          $deposit = htmlspecialchars($_POST['deposit']);
          $publicId =  $_POST['name-public'];
          $typeId = htmlspecialchars($_POST['type']);
          $conditionId = htmlspecialchars($_POST['condition']);
          $role = htmlspecialchars($_POST['role']);
          $adminId = $_SESSION['id'];      
          $personality =  htmlspecialchars(trim($_POST["name-author"]));
          $poster = $_POST["format-poster"];
          $sign = $_POST["format-sign"];
          $kakemono =$_POST["format-kakemono"];
          

          $data = [
            "name" => $name,
            "theme" => $themeId,
            "image" =>$path,
            "content" =>$content,
            "quantity" => $quantity,
            "deposit" => $deposit,
            "public" => $publicId,  
            "type" => $typeId,
            "condition" => $conditionId,
            "admin" => $adminId, 
            "role" => $role,
            "personality" => $personality, 
            "poster" =>$poster,
            "sign" => $sign,
            "kakemono" => $kakemono
          ];
          
          $backController->createResourceExpo($data);
        }

        else {
          // require "app/Views/errors/404.php";
          throw new Exception("La page demand??e n'existe pas");
        }
       
        

  } else {
      $backController->connexionAdmin();
 }
        
} catch (Exception $e) {
  eCatcher($e);
  if($e->getCode() === 404) {
    die('Erreur : ' .$e->getMessage());
  } else {
    require "app/Views/errors/404.php";
  } 
  
} catch (Error $e) {
  eCatcher($e);
  require "app/Views/errors/notAdmin.php";
}