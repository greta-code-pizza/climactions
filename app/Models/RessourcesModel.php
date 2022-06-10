<?php

namespace Climactions\Models;

class RessourcesModel extends Manager
{

    // search an/several article 
    public function searchArticle($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.name AS resource,image,content,type_id,`type`.name AS type,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` FROM resource,`type`  
        WHERE resource.name LIKE :query 
        OR content LIKE :query
        AND resource.type_id = `type`.id
        ORDER BY id 
        DESC LIMIT 6");

        $req->execute([':query' => '%'.$query.'%']);
    
        $search = $req->fetchAll();
        return $search;
    }


    // afficher un article en fonction de l'id 
    public function afficherDetailArticle()
    {
        $bdd = $this->connect();
        $idResource = $_GET['id'];
        $req = $bdd->prepare("SELECT * FROM resource WHERE id = ?");

        $req->execute([$idResource]);
        $article = $req->fetch();

        return $article;
    }


    public function lastArticles()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, type_id, `name`, `image` FROM `resource` ORDER BY `id` DESC LIMIT 3");

        $req->execute(array());
        $articles = $req->fetchAll();

        return $articles;
    }

    public function selectType()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,`name` FROM type");

        $req->execute(array());
        $types = $req->fetchAll();

        return $types;
    }

    public function selectTheme()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM theme");

        $req->execute(array());
        $themes = $req->fetchAll();

        return $themes;
    }

    public function selectCondition()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM `condition`");

        $req->execute(array());
        $conditions = $req->fetchAll();

        return $conditions;
    }
    

    public function selectPublic()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM public");

        $req->execute(array());
        $publics = $req->fetchAll();

        return $publics;
    }

    public function selectPersonality(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT personality.id AS id,personality.name AS name,role.name AS role FROM personality,role
        WHERE personality.role_id = role.id");

        $req->execute(array());
        $personalities = $req->fetchAll();

        return $personalities;
    }

    public function selectGameFormat(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM game_format");

        $req->execute(array());
        $formats = $req->fetchAll();

        return $formats;
    }

    public function selectResources(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT resource.id,resource.name,image,content,type_id,`type`.name AS type,DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` FROM resource INNER JOIN `type` 
        ON resource.type_id = `type`.id
        ORDER BY resource.id DESC" );

        $req->execute(array());
        $articles = $req->fetchAll();

        return $articles;
    }

    public function selectResourceMovieBook($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.name,theme.`name` AS theme,`condition`.name AS `condition`,public.name AS public,`type`.`name` AS `type`,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` 
        FROM resource,`type`,admin,`condition`,public,theme 
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id;");

        $req2 = $bdd->prepare("SELECT personality.name AS staff,role.name AS role
        FROM staff,role,resource,personality
        WHERE resource.id = ?
        AND resource.id = staff.resource_id
        AND personality.role_id = role.id
        AND personality.id = staff.personality_id;");

        $req->execute(array($idResource));
        $req2->execute(array($idResource));
        $movieBook = $req->fetch();
        $staff = $req2->fetchAll();

        return $movieBook;
        return $staff;
    }

    public function selectResourceGame($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.name,theme.`name` AS theme,`condition`.name AS `condition`,public.name AS public,`type`.`name` AS `type`,game_format.name AS game_format,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date`
        FROM resource,`type`,admin,`condition`,public,theme,game,game_format
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id
        AND game.id_resource = resource.id
        AND game.id_format = game_format.id");

       $req2 = $bdd->prepare("SELECT resource.id,personality.name AS staff,role.name AS role
       FROM staff,role,resource,personality
        WHERE resource.id = ?
        AND resource.id = staff.resource_id
        AND personality.role_id = role.id
        AND personality.id = staff.personality_id;");

        $req->execute(array($idResource));
        $req2->execute(array($idResource));
        // var_dump($idResource);
        $game = $req->fetch();
        $staff = $req2->fetchAll();
        $array = array();
        array_push($array, $game, $staff);
        // return $array;
        return $game;
        // return $staff;
        
        }

    // public function selectStaffGame($idResource){
    //     $bdd = $this->connect();

    //     $req2 = $bdd->prepare("SELECT personality.name AS staff,role.name AS role
    //     FROM staff,role,resource,personality
    //     WHERE resource.id = ?
    //     AND resource.id = staff.resource_id
    //     AND personality.role_id = role.id
    //     AND personality.id = staff.personality_id;");


    //     return $staff;
    // }

    // public function selectGame($idResource){
    //     selectResourceGame();
    //     selectStaffGame();
    // }
        
        
    public function selectResourceExpo($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.name,theme.`name` AS theme,`condition`.name AS `condition`,`type`.`name` AS `type`,public.name AS public,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date`,poster_bool,sign_bool
      FROM resource,`type`,admin,`condition`,theme,exposure,public
       WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id
        AND exposure.resource_id = resource.id;");

        $req->execute(array($idResource));
        $expo = $req->fetch();

        return $expo;
    }

    public function insertResourceMovieBook($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO resource (name,theme_id,image,content,quantity,deposit,public_id,type_id,condition_id,admin_id) 
        VALUES (:name,:theme_id,:image,:content,:quantity,:deposit,:public_id,:type_id,:condition_id,:admin_id)");

        $req1->execute(array(
            ":name" => $data['name'],
            ":theme_id" => $data['theme'],
            ":image" =>$data['image'],
            ":content" =>$data['content'],
            ":quantity" => $data['quantity'],
            ":deposit" => $data['deposit'],
            ":public_id" => $data['public'],
            ":type_id" => $data['type'],
            ":condition_id" => $data['condition'],
            ":admin_id" => $data['admin']
        ));
        $idResource = $bdd->lastInsertId();

        $req2 = $bdd->prepare("INSERT INTO staff (personality_id,resource_id)
        VALUES (:personality_id,:resource_id)");

        $req2->execute(array(
            "personality_id" => $data['personality'],
            "resource_id" => $idResource
        ));

    }

    public function insertResourceExpo($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO resource (name,theme_id,image,content,quantity,deposit,type_id,condition_id,admin_id) 
        VALUES (:name,:theme_id,:image,:content,:quantity,:deposit,:type_id,:condition_id,:admin_id)");
        // var_dump($data);die;
        $req1->execute(array(
            ":name" => $data['name'],
            ":theme_id" => $data['theme'],
            ":image" =>$data['image'],
            ":content" =>$data['content'],
            ":quantity" => $data['quantity'],
            ":deposit" => $data['deposit'],
            ":type_id" => $data['type'],
            ":condition_id" => $data['condition'],
            ":admin_id" => $data['admin']
        ));
        // var_dump($data);die;
        $idResource = $bdd->lastInsertId();

        $req2 = $bdd->prepare("INSERT INTO exposure (poster_bool,sign_bool,resource_id)
        VALUES (:poster_bool,:sign_bool,:resource_id)");

        $req2->execute(array(
            "poster_bool" => $data['poster'],
            "sign_bool" => $data['sign'],
            "resource_id" => $idResource

        ));
        // var_dump($data); die;
    }

    public function insertResourceGame($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO resource (name,theme_id,image,content,quantity,deposit,public_id,type_id,condition_id,admin_id) 
        VALUES (:name,:theme_id,:image,:content,:quantity,:deposit,:public_id,:type_id,:condition_id,:admin_id)");
        
        $req1->execute(array(
            ":name" => $data['name'],
            ":theme_id" => $data['theme'],
            ":image" =>$data['image'],
            ":content" =>$data['content'],
            ":quantity" => $data['quantity'],
            ":deposit" => $data['deposit'],
            ":public_id" => $data['public'],
            ":type_id" => $data['type'],
            ":condition_id" => $data['condition'],
            ":admin_id" => $data['admin']
        ));
        $idResource = $bdd->lastInsertId();
        
        $req2 = $bdd->prepare("INSERT INTO game (id_format,id_resource)
        VALUES (:id_format,:id_resource)");

        $req2->execute(array(
            ":id_format" => $data['format'], 
            ":id_resource" => $idResource
        ));

        $req3 = $bdd->prepare("INSERT INTO staff (personality_id,resource_id)
        VALUES (:personality_id,:resource_id)");

        $req3->execute(array(
            ":personality_id" => $data['personality'],
            ":resource_id" => $idResource
        ));
    }

    public function updateResourceMovieBook($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource SET name = :name, theme_id = :theme_id, image = :image, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, type_id = :type_id, condition_id = :condition_id, theme_id = :theme_id, admin_id = :admin_id 
        WHERE id = :id ;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "image" =>$data['image'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "type_id" => $data['type'],
            "condition_id" => $data['condition'],
            "admin_id" => $data['admin']
        ));
    }

    public function updateResourceExpo($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource,exposure SET name = :name, theme_id = :theme_id, image = :image, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, type_id = :type_id, condition_id = :condition_id, theme_id = :theme_id, admin_id = :admin_id, poster_bool = :poster_bool, sign_bool = sign_bool 
        WHERE resource.id = :id
        AND resource.id = exposure.resource_id;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "image" =>$data['image'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "type_id" => $data['type'],
            "condition_id" => $data['condition'],
            "admin_id" => $data['admin'],
            "poster_bool" => $data['poster'],
            "sign_bool" => $data['sign']
        ));
    }

    public function updateGame($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource,game SET name = :name, theme_id = :theme_id, image = :image, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, type_id = :type_id, condition_id = :condition_id, theme_id = :theme_id, admin_id = :admin_id, id_format = :id_format
        WHERE resource.id = :id
        AND resource.id = game.id_resource;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "image" =>$data['image'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "type_id" => $data['type'],
            "condition_id" => $data['condition'],
            "admin_id" => $data['admin'],
            "id_format" => $data['format']
        ));
    }

    public function deleteRessource($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("DELETE FROM resource WHERE resource.id = ?");
        $delete = $req->execute(array($idRessources));
    }
}

