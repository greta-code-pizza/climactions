<?php

namespace Climactions\Models;

class RessourcesModel extends Manager
{

    // search an/several article 
    public function searchArticle($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.name AS resource,image,content,type_id,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` FROM resource 
        WHERE resource.name LIKE :query 
        OR content LIKE :query
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

      // if id resource exist 
      public function exist_idResource($idResource)
      {
          $bdd = $this->connect();
          $req = $bdd->prepare("SELECT COUNT(id) FROM resource WHERE id = ?");
          $req->execute([$idResource]);
  
          $result = $req->fetch()[0];
          return $result;
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

    public function selectRole(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM role");

        $req->execute(array());
        $roles = $req->fetchAll();

        return $roles;
    }

    public function selectPersonality($data){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id FROM personality
        WHERE LOWER(name) = :name
        AND role_id = :role
        ");

        $req->execute(array(
            "name" => strtolower($data['personality']),
            "role" => $data['role']
        ));

        $exist_personality = $req->fetch();

        return $exist_personality;
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

    public function selectMainResources($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.`type_id`,resource.name,resource.theme_id,theme.`name` AS theme,resource.condition_id,`condition`.name AS `condition`,public.name AS public,`type`.`name` AS `type`,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` 
        FROM resource,`type`,admin,`condition`,public,theme 
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id;");

        $req2 = $bdd->prepare("SELECT personality.id,personality.name AS staff,role.name AS role
        FROM staff,role,resource,personality
        WHERE resource.id = ?
        AND resource.id = staff.resource_id
        AND personality.role_id = role.id
        AND personality.id = staff.personality_id;");

        $req->execute(array($idResource));
        $req2->execute(array($idResource));
        $otherResource = $req->fetch();
        $staff = $req2->fetchAll();
        $array = array();
        array_push($array, $otherResource, $staff);
        return $array;
    }

        
    public function selectResourceExpo($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.`type_id`,resource.name,theme_id,theme.`name` AS theme,condition_id,`condition`.name AS `condition`,`type`.`name` AS `type`,public_id,public.name AS public,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date`,poster_bool,sign_bool,kakemono_bool,personality.id AS personality_id,personality.name AS staff,role.name AS role
        FROM resource,`type`,admin,`condition`,theme,exposure,public,staff,role,personality
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id
        AND exposure.resource_id = resource.id
        AND resource.id = staff.resource_id
        AND personality.role_id = role.id
        AND personality.id = staff.personality_id;");

        $req->execute(array($idResource));
        $expo = $req->fetch();

        return $expo;
    }

    public function insertPersonality($data){
            $bdd = $this->connect();
            $req1 = $bdd->prepare("INSERT INTO personality (name,role_id) 
            VALUES (:name,:role_id)");

            $req1->execute(array(
                ":name" => $data['name'],
                "role_id" =>$data['role']
            ));
            $personality = $bdd->lastInsertId();

            return $personality;
    }

    public function insertResource($data,$personality)
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
            "personality_id" => $personality,
            "resource_id" => $idResource
        ));

    }

    

    public function insertResourceExpo($data,$personality)
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

        $req2 = $bdd->prepare("INSERT INTO exposure (poster_bool,sign_bool,kakemono_bool,resource_id)
        VALUES (:poster_bool,:sign_bool,:kakemono_bool,:resource_id)");

        $req2->execute(array(
            "poster_bool" => $data['poster'],
            "sign_bool" => $data['sign'],
            "kakemono_bool" => $data['kakemono'],
            "resource_id" => $idResource

        ));

        $req3 = $bdd->prepare("INSERT INTO staff (personality_id,resource_id)
        VALUES (:personality_id,:resource_id)");

        $req3->execute(array(
            "personality_id" => $personality,
            "resource_id" => $idResource
        ));
    }



    public function updateOtherResourcesImg($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource,staff SET name = :name, theme_id = :theme_id, image = :image, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, condition_id = :condition_id
        WHERE resource.id = :id
        AND staff.resource_id = :id;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "image" =>$data['image'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "condition_id" => $data['condition']   
        ));
    }

    public function updateOtherResources($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource,staff SET name = :name, theme_id = :theme_id, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, condition_id = :condition_id
        WHERE resource.id = :id
        AND staff.resource_id = :id;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "condition_id" => $data['condition']   
        ));
    }

    public function updateResourceExpoImg($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource,exposure,staff SET name = :name, theme_id = :theme_id, image = :image, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, condition_id = :condition_id, poster_bool = :poster_bool, sign_bool = sign_bool,kakemono_bool = :kakemono_bool 
        WHERE resource.id = :id
        AND resource.id = exposure.resource_id
        AND staff.resource_id = :id;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "image" =>$data['image'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "condition_id" => $data['condition'],
            "poster_bool" => $data['poster'],
            "sign_bool" => $data['sign'],
            "kakemono_bool" => $data['kakemono']
            
        ));
    }

    public function updateResourceExpo($data)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("UPDATE resource,exposure,staff SET name = :name, theme_id = :theme_id, content = :content, quantity = :quantity,deposit = :deposit, public_id = :public_id, condition_id = :condition_id, poster_bool = :poster_bool, sign_bool = sign_bool,kakemono_bool = :kakemono_bool 
        WHERE resource.id = :id
        AND resource.id = exposure.resource_id
        AND staff.resource_id = :id;");
        
        $req1->execute(array(
            "id" => $data['id'],
            "name" => $data['name'],
            "theme_id" => $data['theme'],
            "content" =>$data['content'],
            "quantity" => $data['quantity'],
            "deposit" => $data['deposit'],
            "public_id" => $data["public"],
            "condition_id" => $data['condition'],
            "poster_bool" => $data['poster'],
            "sign_bool" => $data['sign'],
            "kakemono_bool" => $data['kakemono']
            
        ));
    }

    public function deleteRessource($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("DELETE FROM resource WHERE resource.id = ?");
        $delete = $req->execute(array($idRessources));
    }
}

