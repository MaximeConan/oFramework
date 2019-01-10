# Documentation de l'API

| Endpoint | Méthode HTTP | Donnée(s) | Description |
|--|--|--|--|
| `/` | GET | - | Liste toutes les routes de l'API |
| `/lists` | GET | - | Récupération des données de toutes les listes |
| `/lists` | POST | listName | ? |
| `/lists/[id]` | GET | - | Récupération des données de la liste dont l'id est fourni |
| `/lists/[id]` | PATCH | listName, pageOrder | Modification d'une liste |
| `/lists/[id]` | DELETE | - | Suppression d'une liste  |
| `/lists/[id]/cards` | POST | cardName | Ajout d'un post-it |
| `/lists/[id]/cards` | GET | - | Récupération de tous les post-it de la liste dont l'id est fourni |
| `/cards/[id]` | PATCH | cardName, listId, listOrder | Modification des données du post-it dont l'id est fourni |
| `/cards/[id]` | DELETE | - | Suppression du post-it dont l'id est fourni |
| `/labels` | GET | - | Récupération des données de tous les labels |
| `/labels` | POST | labelName | ? |
| `/labels/[id]` | GET | - | Récupération des informations d'un label |
| `/labels/[id]` | PATCH | labelName | Modification d'un label |
| `/labels/[id]` | DELETE | - | Suppression d'un label |
| `/cards/[id]/labels` | GET | - | Récupération des labels affectés au post-it dont l'id est fourni |
| `/cards/[id]/labels` | POST | listId | Affectation d'un label au post-it dont l'id est fourni |
| `/cards/[id]/labels/[id]` | DELETE | ? | Désaffectation du label dont l'id est fourni au post-it dont l'id est fourni |
