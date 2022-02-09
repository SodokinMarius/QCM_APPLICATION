<?php
session_start();
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de Jeux</title>
</head>
<body>
 <head></head>
 <nav></nav>
 <section>

 <?php
require_once("connexion_bd.php");

//Recuperation des numeros des questions et melange aléatoire
  
  $questions=$connexion->query("SELECT num_question FROM question ");
  $num_questions=array();
  
  while($donnes=$questions->fetch())
  {
   //echo $donnes['num_question'];
   
   array_push($num_questions,$donnes['num_question']);
   
  }
  
  shuffle($num_questions);



//print_r($num_questions);

$question_cible=(int)$num_questions[0];

//Contenu des questions après melange
$contenu_questions=array();
$contenu=$connexion->prepare("SELECT contenu_question FROM question WHERE num_question=?");
$contenu->execute(array($question_cible));
while($temp=$contenu->fetch())
{
  //echo $temp['contenu_question'];
  array_push($contenu_questions,$temp['contenu_question']);
}

//Affichage de la liste des reponses asociées au question choisie
$reponses=array();
 $reponse=$connexion->prepare("SELECT contenu_reponse FROM reponse where num_question=?");

$reponse->execute(array($question_cible));
 

 while($donnes=$reponse->fetch())
 {
   // echo $donnes['contenu_reponse'];
    array_push($reponses,$donnes['contenu_reponse']);
}
shuffle($reponses);

$reponse->closeCursor();

?>


     </div>
    
     <div>Welcome <?php echo htmlspecialchars($_SESSION['prenom']).' '. htmlspecialchars($_SESSION['nom'])?>
     Your game space is waiting for you
     </div>
        <?php echo  htmlspecialchars($contenu_questions[0])?>
     <div class="question_space">
     <form method="POST" action=" ">
         <div class="list_reponse">    
             <?php
             $nombre_reponse=4;
             for($i=0;$i<$nombre_reponse;$i++){
             ?>
             <div>
             <input type="checkbox" name="reponse" value="<?php $reponses[$i] ?> ">
             <label for="<?php $reponses[$i] ?>">  <?php echo htmlspecialchars($reponses[$i]); ?></label> <br>
             </div>    
               <?php } ?>
               <input type="submit" value="Valider">
               <div>
               <?php
       
        $reponse_joueur=isset($_POST['reponse']);
          $score=0;
       if(isset($reponse_joueur));
       {
       $reponse_correct=$reponses[1];
       $score=0;
       if($reponse_correct==$reponse_joueur)
       {
          $score+=200;
       }
        $score_envoi=$connexion->prepare("INSERT INTO score_reponse(Id_joueur,num_question,date_jeu,heure_jeu,score) 
        values(?,?,CURDATE(),CURTIME(),?)");

        $joueur=$connexion->query("SELECT Id_Joueur FROM joueur");
       $id=current($joueur);
       
       $score_envoi->execute(array(
            $id,
            $question_cible,
           $score    

       ));

       //Retourner le score et qualification du joueur
       if($score<100)
       $qualification="Desolé ! Vous avez fait un travail mediocre";
      
       elseif($score >=100 and $score<500)
       $qualification="Travail Acceptable";
      
       elseif($score>500 and $score<800)
       $qualification="Vous avez bien abbatu";
      
       elseif($score>800 and $score<900)
       $qualification="Vous êtes trop brillant";
      
       else 
       $qualification="Vous êtes Excellent";
      }

      echo $qualification;
    ?>
               </div>
             </div> 
             
    </form>

   

 

 
    
 </section>
</body>
</html>