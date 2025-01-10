# Carburant Express

Bienvenue sur **Carburant Express** ! Ce projet a été créé pour vous aider à trouver les stations-service les plus proches et les prix des carburants disponibles. Vous pouvez rechercher des stations par ville et type de carburant, et visualiser les résultats sur une carte interactive.

## Choix de la plateforme

J'ai choisi de développer ce projet avec **Laravel** et **Tailwind CSS**  et j'utilise **phpMyAdmin** pour plusieurs raisons :

- **Laravel** : Un framework PHP flexible qui facilite le développement rapide d'applications web. Il offre une structure claire et des outils puissants pour gérer les bases de données, les routes, les contrôleurs, et l'authentification est déjà réalisé
- **Tailwind CSS** : Une bibliothèque de styles CSS utilitaire qui permet de créer des interfaces utilisateur modernes et réactives rapidement.
- **phpMyAdmin** : Ma base de donnée est solicitée uniquement pour l'authentification le reste des informations est en dur dans le code (ex: le carburant) car il y avait 
peu de données et que c'était plus simple. 
J'utilise également l'api suivante : https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records
Voici la documentation : https://help.opendatasoft.com/apis/ods-explore-v2/#section/Opendatasoft-Query-Language-(ODSQL)/Group-by-clause

## Installation

Pour installer et lancer ce projet, suivez les étapes ci-dessous :

### Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [PHP](https://www.php.net/downloads) (version 7.3 ou supérieure)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/) et [npm](https://www.npmjs.com/get-npm)

### Étapes d'installation

1. Clonez le dépôt du projet :

   git bash :
   git clone https://github.com/Sayithh/carburant-express.git
   cd carburant-express
