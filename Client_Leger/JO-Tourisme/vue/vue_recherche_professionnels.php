<h2>Résultats de la recherche pour "<?= strtoupper($lettres) ?>"</h2>

<p class="nombre-resultats">
    <?= count($lesProfessionnels) ?> professionnel(s) trouvé(s)
</p>

<table class="table-affiche">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>N° Siret</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lesProfessionnels as $pro) {
            // Mettre les 2 premières lettres en gras
            $nom = $pro['nom'];
            $lettresUpperCase = strtoupper($lettres);
            $nomUpperCase = strtoupper($nom);
            
            // Vérifier si le nom commence par les lettres recherchées
            if (substr($nomUpperCase, 0, 2) === $lettresUpperCase) {
                $nomFormate = '<strong>' . substr($nom, 0, 2) . '</strong>' . substr($nom, 2);
            } else {
                $nomFormate = $nom;
            }
            
            echo "<tr>";
            echo "<td>" . $nomFormate . "</td>";
            echo "<td>" . htmlspecialchars($pro['email']) . "</td>";
            echo "<td>" . htmlspecialchars($pro['tel']) . "</td>";
            echo "<td>" . htmlspecialchars($pro['num_Siret']) . "</td>";
            echo "<td>
                    <a href='index.php?page=8&iduser=" . $pro['iduser'] . "' class='btn-voir-detail'>
                        Voir le profil complet
                    </a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<div class="retour-recherche">
    <a href="index.php?page=7" class="btn-retour">Nouvelle recherche</a>
</div>
