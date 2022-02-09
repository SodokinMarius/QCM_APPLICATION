





































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
  echo $temp['contenu_question'];
  array_push($contenu_questions,$temp['contenu_question']);
}

//Affichage de la liste des reponses asociées au question choisie
$reponses=array();
 $reponse=$connexion->prepare("SELECT contenu_reponse FROM reponse where num_question=?");

$reponse->execute(array($question_cible));
 

 while($donnes=$reponse->fetch())
 {
    echo $donnes['contenu_reponse'];
    array_push($reponses,$donnes['contenu_reponse']);
}
shuffle($reponses);
 print_r($reponses);
$reponse->closeCursor();
 //Controle de la reponse du jouer et calcul du score
 //and in_array(shuffle($reponses),$_POST['reponse'])
 //header("Location:Interface_Jeux.php");
?>

 

 