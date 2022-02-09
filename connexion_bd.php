<?php   

         try{
             $host="localhost";
                $dbname="game_question";
                $server='root';
                $passwd='';
                $connexion=new PDO("mysql:host=$host;dbname=$dbname",$server,$passwd);
                $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $connexion->exec('SET NAMES UTF8');
                return $connexion;
         }
         catch(Exception $err){
             die("Erreur de connexion ".$err->getMessage());
         }
     

    
    
    
    
    
?>