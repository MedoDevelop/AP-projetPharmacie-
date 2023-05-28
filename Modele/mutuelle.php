<?php
 include_once "bd.inc.php";
 
function DeleteMutuelle($id){
            $db = connexionPDO();
            $req = "DELETE FROM mutuelle WHERE idMutuelle=?;";
            $query = $db->prepare($req);
            $query->execute([$id]);
}

function GetAllMutuelle(){
           	$db = connexionPDO();
            $query = $db->query("SELECT * FROM mutuelle");
            return $query->fetchAll(PDO::FETCH_ASSOC);
}

function verifyAssociationWithClient($id){
            $db = connexionPDO();
            $query = $db->prepare("SELECT * FROM client WHERE idMutuelle= :id;");
            $query->bindValue(":id",$id,PDO::PARAM_INT);
            $query->execute();
            $count=$query->rowCount();
            return $count;
}

function GetMutuelleLike($nom){
            $db = connexionPDO();
            $req = "SELECT * FROM mutuelle
                    WHERE nom LIKE CONCAT('%', ?, '%')
                    LIMIT 20;";
            $query = $db->prepare($req);
            $query->execute([$nom]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
}

function CreateMutuelle($nom,$mail,$tel){
            $db = connexionPDO();
            $req = "INSERT INTO mutuelle(nom,mail,tel)
                    VALUES (?,?,?);";
            $query = $db->prepare($req);
            $query->execute([$nom,$mail,$tel]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
}

function updateMutuelle($id,$nom,$mail,$tel){
            $db = connexionPDO();
            $req = "UPDATE mutuelle SET nom=?,mail=?,tel=? WHERE idMutuelle=?;";
            $query = $db->prepare($req);
            $query->execute([$nom,$mail,$tel,$id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
}






?>