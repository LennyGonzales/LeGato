<?php

abstract class Model{

    public static function selectById(String $id){
        $db = Connection::initConnection();
        $stmnt = "SELECT * FROM ".get_called_class()." WHERE ID = ? ";
        $sth = $db->prepare($stmnt);
        $sth->execute(array($id));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public static function deleteByID(String $id) : bool{
        $db = Connection::initConnection();
        $stmnt = "DELETE FROM ".get_called_class()." WHERE ID = ? ";
        $sth = $db->prepare($stmnt);
        return $sth->execute(array($id));
    }

    public static function create(Array $A_postParams) : bool{
        $db = Connection::initConnection();

        $keys = " ";
        $vals = " ";
        foreach (array_keys($A_postParams) as &$key){
            $keys .= $key.",";
            $vals .= "?,";
        }
        $keys[-1] = " ";
        $vals[-1] = " ";

        $stmnt = "INSERT INTO ".get_called_class()." ($keys) VALUES ($vals)";
        $sth = $db->prepare($stmnt);
        return $sth->execute(array_values($A_postParams));
    }

    public static function updateById(Array $A_postParams,String $id ) : bool{
        $db = Connection::initConnection();

        $keys = "";
        foreach (array_keys($A_postParams) as &$key){
            $keys.= $key."= ? ,";
        }
        $keys[-1] = " ";

        $stmnt = "UPDATE ".get_called_class()." SET ".$keys." WHERE ID = ?";
        $sth = $db->prepare($stmnt);
        array_push($A_postParams,$id);
        return $sth->execute(array_values($A_postParams));
    }

    public static function selectHowMany() : int{
        $db = Connection::initConnection();
        $stmnt = "SELECT count(*) FROM ".get_called_class();
        $sth = $db->prepare($stmnt);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public static function selectAll(): Array{
        $O_db = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class();
        $sth = $O_db->prepare($S_stmnt);
        $sth->execute();
        return $sth->fetchAll();
    }

    public static function uploadPictures(Array $A_postParams) : Array{
        $A_picture = UploadPicture::uploadPicture($A_postParams);
        $A_postParams['picture'] = $A_picture;
        return $A_postParams;
    }
}