<h1>Rechercher un Professionnel</h1>

<div class="form-container">
    <form method="POST" action="index.php?page=7">
        <div class="form-group">
            <label for="search_letters">Saisissez les 2 premières lettres du nom :</label>
            <input 
                type="text" 
                id="search_letters" 
                name="search_letters" 
                maxlength="2" 
                minlength="2" 
                pattern="[A-Za-z]{2}" 
                placeholder="Ex: Ho" 
                required
            >
        </div>
        <button type="submit" name="rechercher">Rechercher</button>
    </form>
</div>

<?php
if (isset($_POST['rechercher']) && isset($_POST['search_letters'])) {
    $lettres = trim(htmlspecialchars($_POST['search_letters']));
    
    if (strlen($lettres) == 2) {
        // Recherche des professionnels
        $lesProfessionnels = $c_User->searchClientProByLetters($lettres);
        
        if ($lesProfessionnels && count($lesProfessionnels) > 0) {
            require_once("vue/vue_recherche_professionnels.php");
        } else {
            echo "<p class='message-info'>Aucun professionnel trouvé avec les lettres '$lettres'</p>";
        }
    } else {
        echo "<p class='message-error'>Veuillez saisir exactement 2 lettres</p>";
    }
}
?>
