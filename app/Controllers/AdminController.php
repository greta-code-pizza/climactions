<?php

namespace Climactions\Controllers;

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;

require_once "vendor/phpmailer/phpmailer/src/Exception.php";
require_once "vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "vendor/phpmailer/phpmailer/src/SMTP.php";


class AdminController extends Controller {
	
	public function pageConnexionAdmin() {
		
		require $this->viewAdmin('adminInscription');
	}
	
	public function createAdmin($lastname, $firstname, $email, $password) {
		
		extract($_POST);

		$adminManager = new \Climactions\Models\AdminModel();
		$validation = true;
		$erreur = [];

		if (empty($lastname) || empty($firstname) || empty($email) || empty($emailconf) || empty($password) || empty($passwordconf)){
			$validation = false;
			$erreur[] = "Tous les champs sont requis !";
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$validation = false;
			$erreur[] = "L'adresse email n'est pas valide !"; 
		}

		elseif($emailconf != $email){
			$validation = false;
			$erreur[] = "L'email de confirmation n'est pas correcte !";
		}

		elseif($passwordconf != $password){
			$validation = false;
			$erreur[] = "Le mot de passe de confirmation n'est pas correcte !";
		}

		if($adminManager->exist_firstname($firstname)){
			$validation = false;
			$erreur[] = "Ce prénom est déjà utilisé !";
		}
		
		if($adminManager->exist_email($email)){
			$validation = false;
			$erreur[] = "Cet email est déjà utilisé !";
		}

		if($validation && filter_var($email, FILTER_VALIDATE_EMAIL)){

			$admin = $adminManager->creatAdmin($lastname, $firstname, $email, $password);
			require $this->viewAdmin('connexionAdmin');
			
		} else{
			require $this->viewAdmin('adminInscription');
			return $erreur;
		}
		
	}

	// affichage des pages de l'administration

	public function accountAdmin()
	{
		require $this->viewAdmin('account');
	}


	// display page home 
	public function homeAdmin()
	{
		$adminManager = new \Climactions\Models\AdminModel();
		$listAdmin = $adminManager->listAdmin();

		require $this->viewAdmin('home');
	}


	// display page readAdmin 
	public function readAdmin($id)
	{
		$adminManager = new \Climactions\Models\AdminModel();
		$admin = $adminManager->getOneAdmin($id);

		require $this->viewAdmin('readAdmin');
	}

	// delete a admin 
	public function deleteOneAdmin($id)
	{
		$adminManager = new \Climactions\Models\AdminModel();
		$deleteAdmin = $adminManager->deleteOneAdmin($id);

		header('Location: indexAdmin.php?action=homeAdmin');
	}


	 public function emailAdmin($query, $currentPage)
	{
		$emailsManager = new \Climactions\Models\AdminModel();
        
		$search = $emailsManager->searchEmail($query);

		// var_dump($search); die;

		// count nb email
		$nbrEmail = $emailsManager->countEmail();

		// nb email per page 
        $perPage = 8;

		// calcul nb pages total 
        $pages = ceil($nbrEmail / $perPage);
        
        $firstEmail = ($currentPage * $perPage) - $perPage;
        $emails = $emailsManager->emailPage($firstEmail, $perPage);


		require $this->viewAdmin('email');
	}   

	public function resourceAdmin($query, $currentPage)
	{
		$resourcesManager = new \Climactions\Models\AdminModel();
		
        $search = $resourcesManager->searchResource($query);
        
		// count nb Resource
		$nbrResource = $resourcesManager->countResource();

		// nb email per page 
        $perPage = 8;

		// calcul nb pages total 
        $pages = ceil($nbrResource / $perPage);
        
        $firstResource = ($currentPage * $perPage) - $perPage;
        $resources = $resourcesManager->resourcePage($firstResource, $perPage);
		
		require $this->viewAdmin('resource');
	}

	public function addressBookAdmin($query)
	{
		$infoManager = new \Climactions\Models\AdminModel();
        $infos = $infoManager->infos($query);
		require $this->viewAdmin('addressBook');
	}

	// les méthodes de la page Resource.php 

	public function formCreateResource()
	{
		$resources = new \Climactions\Models\RessourcesModel();
		$types = $resources->selectType();
		$themes = $resources->selectTheme();
		$conditions = $resources->selectCondition();
		$publics = $resources->selectPublic();
		$personalities = $resources->selectPersonality();
		require $this->viewAdmin('formResource');
	}

	public function updateResource()
	{
		require $this->viewAdmin('updateResource');
	}
	public function deleteResource()
	{
		require $this->viewAdmin('delete');
	}

	// les méthodes de la page Email.php

	public function readEmail($id,$read,$adminId)
	{
		$email = new \Climactions\Models\AdminModel();
		
		if($read == 0){
			$readValidate = $email->readValidate($adminId,$id);
		}
		$readEmail = $email->readEmail($id,$adminId);
		require $this->viewAdmin('readEmail');
	}
	public function deleteEmail($id)
	{
		$email = new \Climactions\Models\AdminModel();
		$deleteEmail = $email->deleteEmail($id);
		header('Location: indexAdmin.php?action=emailAdmin');
	}

	// les méthodes de la page addressBook.php

	public function addAddressBook($id,$query, $currentPage)
	{
		
		$emailsManager = new \Climactions\Models\AdminModel();
		$search = $emailsManager->searchEmail($query);

		// var_dump($search); die;

		// count nb email
		$nbrEmail = $emailsManager->countEmail();

		// nb email per page 
		$perPage = 8;

		// calcul nb pages total 
		$pages = ceil($nbrEmail / $perPage);
		
		$firstEmail = ($currentPage * $perPage) - $perPage;
		$emails = $emailsManager->emailPage($firstEmail, $perPage);
		$email = $emailsManager->email($id);
		$data = [
			"firstname" => $email['firstname'],
			"lastname" => $email['lastname'],
			"email" => $email['email']
		];
		$adressBook = $email['email'];
		$validation = true;
		$erreur = [];
		if($emailsManager->exist_Adress($adressBook)){
			$validation = false;
			$erreur[] = "Cet email est déjà enregistré !";
		}

		if($validation){
			$addAdress = $emailsManager->addAdressBook($data);
			require $this->viewAdmin('email');
		}else{
			require $this->viewAdmin('email');
			return $erreur;	
		}
	}

	public function deleteInfo($id)
	{
		$info = new \Climactions\Models\AdminModel();
		$deleteInfo = $info->deleteInfo($id);
		header('Location: indexAdmin.php?action=addressBookAdmin');
	}

	public function connexionAdmin() {
		require $this->viewAdmin('connexionAdmin');
	}

	public function connexion($email,$password){
		$adminManager = new \Climactions\Models\AdminModel();
		$listAdmin = $adminManager->listAdmin();
		$connexAdm = $adminManager->collectPassword($email,$password);
		$result = $connexAdm->fetch();
		if(!empty($result)){
			$isPasswordCorrect = password_verify($password,$result['password']);

			$_SESSION['email'] = $result['email']; // transformation des variables recupérées en session
			$_SESSION['password'] = $result['password'];
			$_SESSION['id'] = $result['id'];
			$_SESSION['firstname'] = $result['firstname'];
			$_SESSION['lastname'] = $result['lastname'];
		
			
			if ($isPasswordCorrect) {
				require $this->viewAdmin('home');
			} else {
        		echo 'Vos identifiants sont incorrects';
			}
		} else {
			echo "il ya une erreur, ce compte n'existe pas!";
		}
	}

	// logout admin 
	public function deconnexion()
	{
		unset($_SESSION['id']);
        session_destroy();
        header('Location:/');
	}


	// go to page forgot_password 
	public function forgot_password()
	{
		require $this->viewAdmin('forgot_password');
	}

	// change password 
	public function changePassword()
	{
		$adminManager = new \Climactions\Models\AdminModel();
		$adminController = new \Climactions\Controllers\AdminController();
		if(isset($_POST['email']))
		{
			$mail = new PHPMailer(true);
			try{
				// configuration pour voir les bugs
				// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
			
				// on configure le SMTP
				$mail->isSMTP();
				$mail->Host = 'localhost';
				$mail->Port = 1025; //port mailhog 
			
				// charset 
				$mail->CharSet = 'utf-8';
			
				// destinataires 
				$mail->addAddress($_POST['email']);
				
			
				// expéditeur 
				$mail->setFrom('no-reply@site.fr');
			
				// contenu 
				$mail->isHTML();
				$mail->Subject = "Nouveau mot de passe";
				$password = uniqid();
				$mail->Body = "Bonjour ".$_POST['email']. "Votre nouveau mot de passe: ".$password;
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$changePassword = $adminManager->getNewPassword($hashedPassword);
				
		
				// on envoie 
				$mail->send();
				echo "Message envoyé";
				
			
			} 
			
			catch (Exception) 
			{
				
				echo "Message non envoyé. Erreur: $mail->ErrorInfo}";
			}
		}

		header('Location: indexAdmin.php');
	}

	// page create new password 
	public function pageNewPassword()
	{
		require $this->viewAdmin('pageNewPassword');
	}

	// confirm new passsword 
	public function createNewPassword($id, $oldPassword, $newPassword)
	{

		extract($_POST);
		$validation = true;
		$erreur = [];

		if(empty($oldPassword) || empty($newPassword) || empty($passwordConfirm)){
			$validation = false;
			$erreur[] = "Tous les champs sont requis!";
		}

		if ($newPassword){
			$adminManager = new \Climactions\Models\AdminModel();
			$getPassword = $adminManager->newPasswordAdmin($id);

			$verifPassword = $getPassword->fetch();
			$isPasswordCorrect = password_verify($oldPassword, $verifPassword['password']);

			if(!$isPasswordCorrect){
				$validation = false;
				$erreur[] = "le mot de passe actuel est erroné";
			}

			if ($newPassword != $passwordConfirm){
				$validation = false;
				$erreur[] = 'Vos mots de passe ne sont pas identiques';
			}
			
			if($isPasswordCorrect && $newPassword === $passwordConfirm){
				$newPass = password_hash($newPassword, PASSWORD_DEFAULT);
				$changePassword = $adminManager->createNewPassword($id, $newPass);

				require $this->viewAdmin('account');
			} else{
				require $this->viewAdmin('pageNewPassword');
				return $erreur;
			}
		}
	}

	public function pageAddArticle()
	{
		$articles = new \Climactions\Models\AdminModel();
		$allArticles = $articles->getArticles();
		require $this->viewAdmin('pageAddArticle');
	}
	public function viewUpdateArticle($idArticle)
	{
		$article = new \Climactions\Models\AdminModel();
		$oneArticle = $article->getArticle($idArticle);
		require $this->viewAdmin('updateArticle');
	}

	public function addArticle($title, $content)
	{
		$adminManager = new \Climactions\Models\AdminModel();
		$admin = $adminManager->addArticle($title, $content);
		require $this->viewAdmin('pageAddArticle');

	}

	public function deleteArticle($id) {
		$article = new \Climactions\Models\AdminModel();
		$deleteArticle = $article->deleteArticle($id);

		header('Location: indexAdmin.php?action=pageAddArticle');


	}
	public function updateArticle($idArticle, $title, $content)
	{
		$article = new \Climactions\Models\AdminModel();
		$updateArticle = $article->updateArticle($idArticle, $title, $content);
		
		header('Location: indexAdmin.php?action=pageAddArticle');
	}

	// téléchargement d'une image

	// enregistrement d'une image
    public function upload(array $file)
    {
        // récupération des valeurs de $_FILES
        if (isset($file)) {
            $name = $file['name'];
            $tmpName = $file['tmp_name'];
            $error = $file['error'];
            $size = $file['size'];
        }

        // séparation du nom de l'image et de son extension 
        $tabExtension = explode('.', $name);
        // transformation de l'extension en minuscule
        $extension = strtolower(end($tabExtension));
        // extensions accepté
        $extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
        // taille maximum d'une image
        $maxSize = 40000000;
        // si le nom de l'extension, la taille maximum et le code d'erreur est égal à 0 (aucune erreur de téléchargement)...
        if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
            // créer un nom unique ...
            $uniqueName = uniqid('', true);
            // rajouter le point et le nom de l'extension 
            $file = $uniqueName . "." . $extension;
            // télécharger l'image      
            $path = "Public/img/" . $file;
            move_uploaded_file($tmpName,  $path);
			return $path;
        } else {
            echo 'Une erreur est survenue';
        }
        
    }

	// -----------------------------------------------------------------------
	
	public function createResource($data)
	{
		
		$adminManager = new \Climactions\Models\RessourcesModel();
		

		$admin = $adminManager->insertResource($data);

		
		header('Location: indexAdmin.php?action=resourceAdmin');

	}
	
	
	public function createResourceExpo($data)
	{
		
		$adminManager = new \Climactions\Models\RessourcesModel();
		
		if($data['sign'] == 'on' ){
			$data['sign'] = 1;	
		}
		if($data['poster'] == 'on'){
			$data['poster'] = 1;
		}
		if($data['kakemono'] == 'on'){
			$data['kakemono'] = 1;
		}
		if($data['sign'] == null){
			$data['sign'] = 0;	
		}
		if( $data['poster'] == null ){
			$data['poster'] = 0;
		}
		if($data['kakemono'] == null){
			$data['kakemono'] = 0;	
		}
		
		$admin = $adminManager->insertResourceExpo($data);

		header('Location: indexAdmin.php?action=resourceAdmin');

	}	
	// -----------------------------------------------------------------------	
}