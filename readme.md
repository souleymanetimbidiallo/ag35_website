# Site Web de l'Association Guinéenne d'Ille et Vilaine (AG35)

Bienvenue sur le projet de site web de l'Association Guinéenne d'Ille et Vilaine (AG35). 

Ce site vise à promouvoir les activités, les événements et la culture de la communauté guinéenne en Ille-et-Vilaine, en France.

## Présentation

L'AG35 est une association basée en Ille-et-Vilaine, regroupant la communauté guinéenne locale. Ce site web a pour objectif de fournir des informations importantes sur l'association, ses membres, ses initiatives et les événements à venir.

## Fonctionnalités

- **Accueil :** Présentation de l'association, les derniers évènements, les temoignages et liens rapides vers les sections importantes.
- **À Propos :** Informations détaillées sur l'AG35, sa mission et valeurs, son histoire, sa gouvernance et ses partenaires
- **Événements :** Calendrier des événements à venir et passées, avec des détails sur chaque événement.
- **Actualités :** Les dernières nouvelles et mises à jour de l'association.
- **Donation :** Lien pour les dons en ligne ou par virement bancaire.
- **Adhésion :** Lien  vers la page de cotisation de l'association.
- **Contact :** Coordonnées et formulaire de contact pour faciliter la communication avec l'association.

## Comment Contribuer

Si vous souhaitez contribuer au développement du site web de l'AG35, vous pouvez suivre ces étapes :

1. **Fork :** Forkez le projet vers votre propre compte GitHub.
2. **Clone :** Clonez le projet depuis votre compte vers votre machine locale.
3. **Branche :** Créez une nouvelle branche pour vos modifications (`git checkout -b feat/nom-de-la-fonctionnalite`).
4. **Commit :** Effectuez vos modifications, puis committez-les (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`).
5. **Push :** Pushez les modifications vers votre fork (`git push origin feat/nom-de-la-fonctionnalite`).
6. **Pull Request :** Ouvrez une Pull Request depuis votre fork vers le dépôt principal.

## Développement Local

Si vous souhaitez exécuter le site en local, suivez ces étapes :

1. Assurez-vous d'avoir [PHP](https://www.php.net/) installé sur votre machine.
2. Installez [Composer](https://getcomposer.org/) pour gérer les dépendances PHP.
3. Clonez ce repository.
4. Installez les dépendances avec la commande `composer install`.
5. Copiez le fichier `.env.example` en `.env` et configurez votre base de données et d'autres paramètres.
6. Générez la clé d'application avec la commande `php artisan key:generate`.
7. Exécutez les migrations avec la commande `php artisan migrate`.
8. Lancez le serveur Laravel avec `php artisan serve`.
9. Accédez au site web à l'adresse `http://localhost:8000` dans votre navigateur.

## Technologies Utilisées

- Symfony pour le développement backend en PHP.
- Bootstrap pour le design et la mise en page.
- PHP pour la logique serveur.
- MySQL ou tout autre SGBD compatible avec Laravel pour la base de données.

## Licence

Ce projet est sous licence [MIT](LICENSE).

---

Merci de contribuer au développement du site web de l'AG35 !
