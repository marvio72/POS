<?php 
require_once 'bdconfig.php';

class Conexion{
    
    public static function conectar(){

        $link = new PDO(HOST,USER,PASS);
                     
        $link->exec("set names utf8");

        return $link;
        
        
        
    }
}