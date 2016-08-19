<?php
include("head.php");
include("header.php");
if ($_SESSION[id]) {
$query = $pdo->prepare('SELECT COUNT(*) AS total FROM photos');
$query->execute();
$data_total = $query->fetch();
$total = $data_total['total'];

$messagesParPage = 9;
$nbPages = ceil($total / $messagesParPage);

if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);
 
     if($pageActuelle>$nbPages) // Si la valeur de $pageActuelle est plus grande que $nombreDePages...
     {
          $pageActuelle=$nbPages;
     }
}
else // Sinon
{
     $pageActuelle=1; // La page actuelle est la n°1    
}
$premiereEntree=($pageActuelle-1)*$messagesParPage;

$query = $pdo->prepare('SELECT * FROM photos ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');
$query->execute();
$photos = $query->fetchAll();

echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nbPages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }	
     else //Sinon...
     {
          echo ' <a href="galery.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</p>';

?>
<html>
   <body>
      <div class="content">
         <?php
            foreach ($photos as $data)
            {
               $img_src = $data[src];
               $id = $data[id];?>
            <a href="photo.php/?id=<?php echo $id ?>">
               <img class="photo" src="<?php echo $img_src?>">
            </a>
         <?php }
         ?>
      </div>
   </body>
</html>
<?php
include("footer.php"); }
else
   header('location: /index.php');
?>