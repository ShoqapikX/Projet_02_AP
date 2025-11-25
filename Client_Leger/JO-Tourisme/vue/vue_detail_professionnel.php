<div class="profil-container">
    <h2>Informations complètes du professionnel</h2>
    
    <table class="table-detail-profil">
        <tr>
            <th>Nom</th>
            <td><?= htmlspecialchars($professionnel['nom']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($professionnel['email']) ?></td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td><?= htmlspecialchars($professionnel['tel']) ?></td>
        </tr>
        <tr>
            <th>Rôle</th>
            <td><?= htmlspecialchars($professionnel['role']) ?></td>
        </tr>
        <tr>
            <th>Numéro Siret</th>
            <td><?= htmlspecialchars($professionnel['num_Siret']) ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?= htmlspecialchars($professionnel['adresse']) ?></td>
        </tr>
    </table>
    
    <div class="navigation-buttons">
        <a href="index.php?page=7" class="btn-retour">Retour à la recherche</a>
    </div>
</div>
