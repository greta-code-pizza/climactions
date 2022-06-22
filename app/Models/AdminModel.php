<?php

namespace Climactions\Models;

class AdminModel extends Manager
{

    public function creatAdmin($lastname, $firstname, $email, $password)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare('INSERT INTO admin (lastname, firstname, email,  password) VALUE (:lastname, :firstname, :email, :password)');
        $req->execute([
            "lastname" => htmlspecialchars($lastname), 
            "firstname" => htmlspecialchars($firstname), 
            "email" => htmlspecialchars($email), 
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return $req;
    }

    // if email exist 
    public function exist_email($email)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM admin WHERE email = ?");
        $req->execute([$email]);

        $result = $req->fetch()[0];
        return $result;
    }
    
    // if firstname exist 
    public function exist_firstname($firstname)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM admin WHERE firstname = ?");
        $req->execute([$firstname]);

        $result = $req->fetch()[0];
        return $result;
    }

   



    public function collectPassword($email)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT email,password,lastname,firstname,id FROM admin WHERE email=:email');
        $req->execute(array(':email' => $email));

        return $req;
    }

    // change password sent by email
    public function getNewPassword($hashedPassword)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE admin SET password = ? WHERE email = ?");
        $req->execute([$hashedPassword, $_POST['email']]);
        
    }

    // retrieve password 
    public function newPasswordAdmin($id)
    {
        $bdd =  $this->connect();
        $req = $bdd->prepare("SELECT id, password FROM admin WHERE id =?");
        $req->execute(array($id));

        return $req;
    }

    // create new personalized password 
    public function createNewPassword($id, $newPass)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $req->execute(array($newPass, $id));

        return $req;
    }


    // ------------------------------------------------------------------------------------------------------------------

    // display list admin 
    public function listAdmin()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id, `firstname`, `email`, `role` FROM admin");
        $req->execute(array());
        return $req;
    }

    // disply one admin 
    public function getOneAdmin($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id, firstname, lastname, email, role FROM admin WHERE id = ?");
        $req->execute(array($id));
        return $req->fetch();
    }

    // if id admin exist 
    public function exist_idAdmin($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM admin WHERE id = ?");
        $req->execute([$id]);
       
        $result = $req->fetch()[0];
        return $result;
    }

    // if id exist for resources (update)
    public function exist_idResource($idArticle)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM resource WHERE id = ?");
        $req->execute([$idArticle]);
       
        $result = $req->fetch()[0];
        return $result;
    }

    // delete one admin 
    public function deleteOneAdmin($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("DELETE FROM `admin` WHERE id = ? AND `role` = 'Administrateur'");
        $req->execute(array($id));
    }

    // afficher les articles

    public function getArticles()
    {
        $bdd = $this->connect();
        $req = $bdd->query("SELECT id, title, content FROM article ORDER BY id DESC");
        $article = $req->fetchAll();
        return $article;
    }
    // afficher un article
    
    public function getArticle($idArticle)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT * FROM article WHERE id = ?");
        $req->execute(array($idArticle));
        return $req->fetch();
    }

    //   créer un article

    public function addArticle($title, $content)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('INSERT INTO article (title, content) VALUE (?, ?)');
        $req->execute(array($title, $content));
        header('Location: indexAdmin.php?action=pageAddArticle');
    }
    // mettre à jour un article

    public function updateArticle($idArticle, $title, $content)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('UPDATE `article` SET title = :title , content = :content WHERE id = :id');
        $req->execute([
            'id' => $idArticle,
            'title' => $title,
            'content' => $content
        ]);
        return $req;
        // header('Location: indexAdmin.php?action=pageAddArticle');

    }

    // supprimer un article

    public function deleteArticle($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('DELETE FROM resource WHERE id = ?');
        $req->execute(array($id));
    }

    /* ----------------------------------------------------------------------*/

    // gestion des emails (page email.php)

    // afficher tous les emails

    public function emailPage($firstEmail, $perPage)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `lastname`, `firstname`, `email`, `object`, `message`, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date`,`read`
                              FROM `email` 
                              ORDER BY `created_at` DESC LIMIT :firstemail, :perpage");
                              $req->bindValue(':firstemail', $firstEmail, \PDO::PARAM_INT);
                              $req->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $req->execute();
        $emails = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $emails;
    }

    // count all email 

    public function countEmail()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) AS nb_email FROM email");
        $req->execute();
        $result = $req->fetch();
        $nbEmail = $result['nb_email'];
        return $nbEmail;
    }

    public function searchEmail($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT id, lastname, firstname, message, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date`,`read` 
                                FROM email 
                                WHERE lastname LIKE :query 
                                OR firstname LIKE :query
                                OR message LIKE :query
                                ORDER BY id 
                                DESC LIMIT 6");
        $req->execute([':query' => '%'.$query.'%']);
    
        $searchEmail = $req->fetchAll();
        return $searchEmail;
    }

    public function readValidate($adminId,$id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE email SET admin_id = ?, `read` = 1
                            WHERE id = ?");

        $req->execute(array($adminId,$id));
    }

      // if id email exist 
      public function exist_idEmail($id)
      {
          $bdd = $this->connect();
          $req = $bdd->prepare("SELECT COUNT(id) FROM email WHERE id = ?");
          $req->execute([$id]);
  
          $result = $req->fetch()[0];
          return $result;
      }

    /* ----------------------------------------------------------------------*/

    // gestion des ressources (page resource.php)

    // afficher toutes les ressources

    public function resourcePage($firstResource, $perPage)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `type_id`, `name`, `image`, `content`, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` 
                              FROM `resource` 
                              ORDER BY `created_at` DESC LIMIT :firstresource, :perpage");
                              $req->bindValue(':firstresource', $firstResource, \PDO::PARAM_INT);
                              $req->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $req->execute();
        $resources = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $resources;
    }

    // ----------------------------------------
    
    public function searchResource($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT id, name, image,type_id, content ,DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` 
                                FROM resource 
                                WHERE name LIKE :query 
                                OR content LIKE :query
                                ORDER BY id 
                                DESC LIMIT 6");
        $req->execute([':query' => '%'.$query.'%']);
    
        $searchResource = $req->fetchAll();
        return $searchResource;
    }
    
    // compter les ressources
    
    public function countResource()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) AS nb_resources FROM resource");
        $req->execute();
        $result = $req->fetch();
        $nbResource = $result['nb_resources'];
        return $nbResource;
    }
    
    // ----------------------------------------
    
    // supprimer un email
    
     public function deleteEmail($id){
        $bdd = $this->connect();
        $req = $bdd->prepare('DELETE FROM `email` 
                              WHERE id = ?');
        $req->execute(array($id));
    }

    // lire un email

    public function readEmail($id,$adminId){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT admin.firstname AS prenom,admin.lastname AS nom,`email`.`id`,`admin`.`id`, `email`.`lastname`, `email`.`firstname`, `email`.`email`, `object`, `message`, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` 
                             FROM `email`,`admin`
                              WHERE email.id = ?
                              AND `admin`.id = ?");
        $req->execute(array($id,$adminId));
        $email = $req->fetch();
        return $email;
    }

    
    /* ----------------------------------------------------------------------*/

    // gestion carnet d'adresse

    public function email($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT firstname, lastname,`email`
                             FROM `email`
                            WHERE email.id = ?");
        $req->execute(array($id));
        $email = $req->fetch();
        return $email;
    }

    public function exist_adress($adressBook)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM contact WHERE email = ?");
        $req->execute([$adressBook]);

        $result = $req->fetch()[0];
        return $result;
    }

    public function addAdressBook($data)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("INSERT INTO contact (firstname,lastname,email) VALUES (:firstname,:lastname,:email)");        $req->execute(array(
            "firstname" => $data["firstname"],
            "lastname" => $data["lastname"],
            "email" => $data["email"]
        ));
    }

    public function infos($query)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `lastname`, `firstname`, `email`
                              FROM `contact`
                              WHERE lastname LIKE :query 
                                OR firstname LIKE :query
                                OR email LIKE :query
                                ORDER BY lastname 
                                DESC LIMIT 6");
        $req->execute([':query' => '%'.$query.'%']);
        $infos = $req->fetchAll();
        return $infos;
    }

    public function deleteInfo($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('DELETE FROM `contact` 
                              WHERE id = ?');
        $req->execute(array($id));
    } 
    
}
