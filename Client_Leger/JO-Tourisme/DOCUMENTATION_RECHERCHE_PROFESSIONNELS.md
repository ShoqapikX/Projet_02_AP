# Documentation - Fonctionnalité de Recherche de Professionnels

## Mission réalisée

Ajout d'une nouvelle option au menu permettant de rechercher un professionnel en saisissant les 2 premières lettres de son nom.

## Fichiers créés

### 1. Pages
- **pages/recherche_professionnel.php** : Page principale avec formulaire de recherche
- **pages/detail_professionnel.php** : Page affichant les détails complets d'un professionnel

### 2. Vues
- **vue/vue_recherche_professionnels.php** : Affichage de la liste des résultats avec les 2 lettres en gras
- **vue/vue_detail_professionnel.php** : Affichage détaillé d'un professionnel sélectionné

## Fichiers modifiés

### 1. Navigation
- **composants/navbar.php** : Ajout du lien "Rechercher Client" (page=7)

### 2. Contrôleur principal
- **index.php** : Ajout des cases 7 et 8 dans le switch pour gérer les nouvelles pages

### 3. Modèle
- **modele/modeleUser.class.php** : Ajout de 2 méthodes :
  - `searchClientProByLetters($lettres)` : Recherche les professionnels par les 2 premières lettres du nom
  - `getClientProById($iduser)` : Récupère un professionnel par son ID

### 4. Contrôleur
- **controleur/controleurUser.class.php** : Ajout de 2 méthodes correspondantes avec validation

### 5. Styles
- **styles.css** : Ajout de styles pour :
  - Formulaire de recherche
  - Tableau des résultats
  - Boutons d'action
  - Page de détails
  - Messages d'information/erreur

## Fonctionnement

### Étape 1 : Accès au formulaire
L'utilisateur clique sur "Rechercher Client" dans le menu → Redirection vers `index.php?page=7`

### Étape 2 : Saisie des lettres
- L'utilisateur saisit exactement 2 lettres (validation HTML5)
- Les lettres sont automatiquement mises en majuscules
- Validation : pattern="[A-Za-z]{2}", minlength="2", maxlength="2"

### Étape 3 : Affichage des résultats
- Recherche SQL avec `LIKE` : `WHERE nom LIKE 'Ho%'`
- Tri par ordre alphabétique croissant : `ORDER BY nom ASC`
- Les 2 premières lettres du nom sont affichées en **gras**
- Affichage dans un tableau avec : Nom, Email, Téléphone, N° Siret
- Bouton "Voir le profil complet" pour chaque résultat

### Étape 4 : Affichage du profil complet
- Clic sur "Voir le profil complet" → Redirection vers `index.php?page=8&iduser=X`
- Affichage de toutes les informations : Nom, Email, Téléphone, Rôle, N° Siret, Adresse
- Bouton "Retour à la recherche" pour revenir au formulaire

## Sécurité

### Validation des données
- Sanitization avec `htmlspecialchars()` et `trim()`
- Validation de la longueur des lettres (exactement 2 caractères)
- Validation de l'ID utilisateur (conversion en entier avec `intval()`)
- Requêtes préparées (PDO) pour éviter les injections SQL

### Gestion des erreurs
- Messages d'erreur si aucun professionnel trouvé
- Gestion des cas où l'ID est invalide
- Redirection vers la recherche en cas d'erreur

## Requête SQL utilisée

```sql
-- Recherche par les 2 premières lettres
SELECT * FROM vueClientPro 
WHERE nom LIKE 'Ho%' 
ORDER BY nom ASC;

-- Récupération par ID
SELECT * FROM vueClientPro 
WHERE iduser = 3;
```

## Architecture MVC respectée

✅ **Modèle** : Requêtes SQL dans `modeleUser.class.php`
✅ **Vue** : Affichage HTML dans `vue/vue_recherche_professionnels.php` et `vue/vue_detail_professionnel.php`
✅ **Contrôleur** : Logique métier et validation dans `controleurUser.class.php`
✅ **Pages** : Points d'entrée dans `pages/`

## Améliorations possibles

1. Pagination si beaucoup de résultats
2. Recherche insensible à la casse (déjà implémentée avec LIKE)
3. Recherche par autres critères (email, téléphone, SIRET)
4. Export des résultats en CSV/PDF
5. Statistiques sur les recherches effectuées

---

**Date de création** : 25 novembre 2025
**Développeur** : Expert SQL & PHP
**Status** : ✅ Terminé et testé
