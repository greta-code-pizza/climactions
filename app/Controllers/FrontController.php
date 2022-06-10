<?php

namespace Climactions\Controllers;

class FrontController extends Controller {
    public function home() {

        $articleManager = new \Climactions\Models\RessourcesModel();
        $lastArticles = $articleManager->lastArticles();
        require "app/Views/frontend/home.php";
    
    }


    // fonction afficher page des articles avec pagination 
    public function pageArticle($query)
    {
        $articleManager = new \Climactions\Models\RessourcesModel();
        $types = $articleManager->selectType();
        $ressources = $articleManager->selectResources();
        $search = $articleManager->searchArticle($query);
        require "app/Views/frontend/pageArticle.php";
    }

    // fonction afficher un article grâce à l'id 
    public function article($idResource)
    {
        $articleManager = new \Climactions\Models\RessourcesModel();
        $article = $articleManager->afficherDetailArticle($idResource);
        if(isset($article['type_id']) && ($article['type_id'] === 1)){
            $game = $articleManager->selectResourceGame($idResource);
            
            // var_dump($game);  
        }
        if(isset($article['type_id']) && ($article['type_id'] === 2 || 3 || 5 || 6)){
            $otherResource = $articleManager->selectOtherResources($idResource);
            // var_dump($otherResource);die;
        }
        if(isset($article['type_id']) && ($article['type_id'] === 4)){
            $flyer = $articleManager->selectResourceExpo($idResource);
            // var_dump($flyer);die;
        }
        

        require "app/Views/frontend/article.php";
    }


    // afficher page contact.php 
    public function contact()
    {
        require $this->viewFrontend('contact');
    }

    // afficher page legalNotice.php
    public function legalNotice()
    {
        require $this->viewFrontend('legalNotice');
    }
    // afficher page cookies.php
    public function cookies()
    {
        require $this->viewFrontend('cookies');
    }
    // afficher page cgu.php
    public function cgu()
    {
        require $this->viewFrontend('cgu');
    }


    // fonction envoyer contact en bdd 
    public function contactPost($lastname, $firstname, $email, $object, $message)
    {
        $contactManager = new \Climactions\Models\ContactModel();
        extract($_POST);
		$validation = true;
		$erreur = [];
        

        if(empty($lastname) || empty($firstname) || empty($email) || empty($confirmEmail) || empty($object) || empty($message)){
            $validation = false;
            $erreur[] = "Tous les champs sont requis !";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validation = false;
            $erreur[] = "Ladresse email n'est pas valide !";
        }
        if($email != $confirmEmail){
            $validation = false;
            $erreur[] = "Vos e-mails ne sont pas identiques !";
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && $email === $confirmEmail) {
            $validation;
            $Mail = $contactManager->postMail($lastname, $firstname, $email, $object, $message);

            unset($_POST['lastname']);
            unset($_POST['firstname']);
            unset($_POST['email']);                 // vide/détruit ce qui est en mémoire
            require 'app/Views/frontend/confirmSendEmail.php';
        
        }
        else{
            require $this->viewFrontend("contact");
            return $erreur;
        }
        
    }
}


