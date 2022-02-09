<?php
session_start();
//error_reporting(0);
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Joueur</title>
</head>
<body>
    <head></head>
  <nav >

  </nav> 
  <section >
      <div>FORMULAIRE DE SAISIE DES INFROMATIONS DU JOUEUR</div>
      <div>
          <form action="Interface_Jeux.php" method="POST">
              <label for="nom" id="nom" class="control-label">Nom :</label>
              <input type="text" name="nom" placeholder="Votre nom svp"><br><br>
             <br>
              <label for="prenom" id="prenom" class="control-label">Prenom :</label>
              <input type="text" name="prenom" placeholder="Votre prenom svp"><br><br>

              <input type="submit" value="VALIDER">
                <!--button name="submit">VALIDER</button-->
                

          </form>
          <?php   
              $errors=[];
                if(empty($_POST['nom']))
                {
                 $errors['nom'] ="Le nom n'est pas renseigné ou valeure inatendue";
                 echo "Le nom n'est pas renseigné !";
                }  
             if(empty($_POST['prenom']))
            {
             $errors['prenom'] ="Le prenom n'est pas renseigné ou est mal saisi";
             echo "Veuillez renseigné le prenom svp!";
            }?>
      </div>
  </section> 

  <?php
  require_once("connexion_bd.php");
  print_r($errors);
  
  if(empty($errors))
  {
      $_SESSION['nom']=$_POST['nom'];
      $_SESSION['prenom']=$_POST['prenom'];
      $request=$connexion->prepare("INSERT INTO joueur(nom_joueur,prenom_joueur) values(?,?)");
      $request->execute(array($_POST['nom'],$_POST['prenom']));
      //header("Location:Interface_Jeux.php");
      $request->closeCursor();
  }
  

  ?>
</body>
</html>