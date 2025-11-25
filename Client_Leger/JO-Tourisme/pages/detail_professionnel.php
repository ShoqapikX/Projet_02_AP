<h1>Profil du Professionnel</h1>

<?php
if (isset($_GET['iduser'])) {
    $iduser = intval($_GET['iduser']);
    
    // Récupérer les informations du professionnel par son ID
    $professionnel = $c_User->getClientProById($iduser);
    
    if ($professionnel && is_array($professionnel)) {
        require_once("vue/vue_detail_professionnel.php");
    } else {
        echo "<p class='message-error'>Professionnel non trouvé</p>";
        echo "<a href='index.php?page=7' class='btn-retour'>Retour à la recherche</a>";
    }
} else {
    echo "<p class='message-error'>Aucun professionnel sélectionné</p>";
    echo "<a href='index.php?page=7' class='btn-retour'>Retour à la recherche</a>";
}
?>
