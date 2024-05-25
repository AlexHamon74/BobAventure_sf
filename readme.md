# BOB-AVENTURE - RAID 4x4 ET DECOUVERTES
Cette association a pour but de réunir des adhérents passionnés de 4x4 et de promouvoir ensemble notre loisir sur les pistes et nos chemins d’Europe ou d’Afrique.

Ce site destiné à une association a été coder avec Symfony pour le back et Twig pour le front avec Bootstrap et EasyAdmin pour l'interface admin.
Il sagit d'un site vitrine ainsi qu'une interface admin dans lequel l'admin du site pourra ajouter des nouveaux articles.
Une partie Enregistrement et connexion sont présentes afin d'ajouter plus tard une fonctionnalités de reservations d'évènements pour les users.


## Les pages du site et leurs fonctionnalités 💻

### Page d'Accueil
<!-- ![alt text](profil.PNG) -->
La seule partie dynamique de la page d'accueil sont les 3 dernières actualités publiés avec un lien qui ammene à l'article en question détaillé.
Cela est fonctionnel grâce à ce code :
```$articles = $articleRepository->findBy([], ['publishedAt' => 'DESC'], 3);```
<!-- ![alt text](profil.PNG) -->

### Page actus
<!-- ![alt text](profil.PNG) -->
Cette page contient toutes les articles crées par l'admin avec un lien qui ammene à l'article en question détaillé.

### Page Contact ✉️
<!-- ![alt text](profil.PNG) -->
Le formulaire de contact est fonctionnel et chaque champ est sécurisé.
Le message sera consultable dans l'interface admin.

### Pages concernant les Users
Le formulaire de connexion est fonctionnel et sécurisé. Il y a un lien pour se créer un compte.
Le formulaire de création de compte est fonctionnel et sécurisé. Les mot de passe sont hashé.
> [!WARNING]
> Dans cette version le reset de mot de passe en cas d'oubli a été codé "à l'ancienne" avec une question secrète.
> Le reset de mot de passe est donc fonctionnel avec cette fonctionnalité de question secrète mais pas du tout sécurisé.
> Dans la version finale, c'est à dire mise en ligne le reset de mot de passe sera fait avec l'aide du ```php bin/console make:reset-password``` de symfony.

Enfin depuis la navbar quand le user est connecté, il a accès à un formulaire pour modifier ses informations.
Ce formulaire est fonctionnel et sécurisé.


## L'interface admin avec easyadmin !
L'interface admin est accessible seulement par l'admin et donc sécurisé.
Elle est accessible depuis la navbar quand l'admin est connecté.

Il est possible de voir tous les users, de les supprimer et de modifier leurs rôles.

On peux créer des nouvelles catégories.

On peux lire les messages venant du formulaire de contact.

Enfin les articles peuvent aussi être créés et on peux uploader l'image principale.
L'objectif est aussi de pouvoir uploads plusieurs images secondaires mais pour le moment cela ne fonctionne pas.
> [!NOTE]
> Les images sont ignorés sur github afin que le projet soit moins lourd : ```/public/uploads/images/*```

En cas de suppression d'article l'image relié à celui ci sera automatiquement supprimé grâce à un EventSubscriber : DeleteImageSubscriber


## Difficultés rencontrées 🔨
Le vrai difficulté pour moi a vraiment été l'uploads de plusieurs images.
Après plusieurs jours a essayés et testés plusieurs choses je n'ai vraiment pas eu de succès.
Ma procaine étape sera d'essayés de la faire avec le bundle [VichUploader](https://docs.framasoft.org/fr/grav/).

## Perpectives d'évolutions 🔜
Afin de rendre le site terminée à 100% :
* Finaliser le frontend qui est terminé à 80%.
* Ajouter une fonctionnalité pour créer des évènements par l'admin qui seront reservables par les users.

## Conclusion
Faire ce projet en environ deux mois de symfony a été très enrichissant. 
Symfony est relativement simple à prendre en main et très agréable à utilisé.