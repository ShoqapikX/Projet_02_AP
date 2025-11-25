# Guide de Test - Fonctionnalité Recherche de Professionnels

## Prérequis

1. **Base de données** : La base de données `jo_paris` doit être créée avec le script SQL
2. **Professionnel test** : Un professionnel "Housset" existe déjà dans la base
3. **Docker** : Le conteneur Docker doit être lancé

## Instructions de test

### 1. Démarrage de l'application

```bash
cd /Users/yacine/Documents/Projet_02_AP/Client_Leger/JO-Tourisme
docker-compose up -d
```

Accédez à : http://localhost:8000

### 2. Test de la fonctionnalité

#### Étape 1 : Accès au formulaire de recherche
- Cliquez sur **"Rechercher Client"** dans le menu de navigation
- Vous devriez voir un formulaire avec un champ de saisie

#### Étape 2 : Test avec le professionnel "Housset"
- Saisissez **"Ho"** dans le champ
- Cliquez sur **"Rechercher"**
- Résultat attendu :
  - Affichage d'un tableau avec le professionnel "Housset"
  - Les lettres **"Ho"** doivent être en **gras**
  - Informations affichées : Nom, Email, Téléphone, N° Siret

#### Étape 3 : Affichage du profil complet
- Cliquez sur **"Voir le profil complet"** pour Housset
- Résultat attendu :
  - Affichage de toutes les informations :
    - Nom : Housset
    - Email : h@gmail.com
    - Téléphone : 0875463251
    - Rôle : clientPro
    - N° Siret : 84351248751428
    - Adresse : 12 rue de Cléry Paris

#### Étape 4 : Test avec aucun résultat
- Retournez à la recherche (bouton "Retour à la recherche")
- Saisissez **"XY"** (lettres inexistantes)
- Cliquez sur **"Rechercher"**
- Résultat attendu :
  - Message : "Aucun professionnel trouvé avec les lettres 'XY'"

### 3. Tests de validation

#### Test 1 : Validation de longueur
- Essayez de saisir **1 lettre** → Le formulaire ne devrait pas se soumettre
- Essayez de saisir **3 lettres** → Le formulaire ne devrait pas accepter

#### Test 2 : Validation de caractères
- Essayez de saisir des **chiffres** → Le formulaire ne devrait pas accepter
- Essayez de saisir des **caractères spéciaux** → Le formulaire ne devrait pas accepter

### 4. Ajout de nouveaux professionnels pour tester

Pour tester avec plusieurs résultats, ajoutez des professionnels supplémentaires :

```sql
-- Se connecter à la base de données
USE jo_paris;

-- Ajouter un professionnel "Hotel Paris"
CALL insertClientPro('Hotel Paris', 'hotelparis@gmail.com', '123', '0612345678', 'clientPro', '12345678901234', '10 rue de Paris');

-- Ajouter un professionnel "Hotel Luxe"
CALL insertClientPro('Hotel Luxe', 'hotelluxe@gmail.com', '123', '0698765432', 'clientPro', '98765432109876', '20 avenue des Champs');

-- Maintenant, recherchez "Ho" et vous devriez voir 3 résultats triés alphabétiquement
```

### 5. Vérification du tri alphabétique

Après avoir ajouté les professionnels ci-dessus :
- Recherchez **"Ho"**
- Vérifiez que les résultats sont triés par ordre alphabétique :
  1. Hotel Luxe
  2. Hotel Paris
  3. Housset

### 6. Test de sécurité (Injection SQL)

#### Test d'injection SQL
- Saisissez **"'; DROP TABLE user; --"** 
- Le formulaire devrait bloquer (validation pattern)
- Même si cela passe, les requêtes préparées empêchent l'injection

### 7. Cas d'erreur à tester

#### ID utilisateur invalide
- Modifiez manuellement l'URL : `index.php?page=8&iduser=9999`
- Résultat attendu : Message "Professionnel non trouvé"

#### Aucun ID fourni
- Accédez directement à : `index.php?page=8`
- Résultat attendu : Message "Aucun professionnel sélectionné"

## Checklist de validation

- [ ] Le lien "Rechercher Client" apparaît dans le menu
- [ ] Le formulaire s'affiche correctement
- [ ] La validation HTML5 fonctionne (2 lettres uniquement)
- [ ] La recherche retourne les bons résultats
- [ ] Les 2 premières lettres sont en gras
- [ ] Les résultats sont triés par ordre alphabétique
- [ ] Le bouton "Voir le profil complet" fonctionne
- [ ] Toutes les informations du professionnel s'affichent
- [ ] Le bouton "Retour à la recherche" fonctionne
- [ ] Les messages d'erreur s'affichent correctement
- [ ] Le style CSS est appliqué correctement
- [ ] Aucune erreur PHP dans les logs

## Commandes utiles

### Vérifier les logs Docker
```bash
docker-compose logs -f app
```

### Redémarrer les conteneurs
```bash
docker-compose restart
```

### Accéder à MySQL
```bash
docker-compose exec db mysql -u jo_tourisme -pjo_tourisme_pass jo_tourisme_db
```

### Arrêter les conteneurs
```bash
docker-compose down
```

## Résolution de problèmes

### Problème : La page ne s'affiche pas
- Vérifiez que Docker est lancé
- Vérifiez les logs : `docker-compose logs app`

### Problème : Aucun résultat trouvé
- Vérifiez que le professionnel "Housset" existe dans la base
- Exécutez : `SELECT * FROM vueClientPro;` dans MySQL

### Problème : Erreur SQL
- Vérifiez que la vue `vueClientPro` existe
- Recréez la base avec le script `sql/jo_paris.sql`

---

**Status** : ✅ Prêt pour les tests
**Environnement** : Docker + PHP + MySQL
**Port** : http://localhost:8000
