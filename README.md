# oFramework :heart_eyes:

L'architecture de notre code produit en saison 5 peut très bien être réutilisé dans d'autres projets...

Comment faire cela facilement ? :thinking:

:bulb: Le transformer en un framework !!!

Quelle bonne idée :heart_eyes: c'est parti :tada:

## Etapes

La structure des répertoires a peut-être un peu changé par rapport à la saison 5.  
Ce n'est pas grave, au contraire, cela correspond aux structures MVC les plus utilisées.  
Les fichiers `.gitkeep` ne servent qu'à versionner les dossiers dans lesquelles ils se trouvent (_Git_ ne versionne que les fichiers, pas les dossiers)

### #1 FrontController :gun:

- le seul répertoire accédé par le navigateur est le répertoire `public`
- et notre fichier _FrontController_ est `public/index.php`
- placer un fichier `.htaccess` dans `public` pour qu'il renvoit toutes les requêtes HTTP vers le fichier _FrontController_
- on ne veut pas que le répertoire `app` soit accessible aux internautes
  - créer un fichier `.htaccess` dans le dossier `app`
  - coller ce code dans le fichier créé : `Deny from all`

### #2 Composer & AltoRouter :musical_keyboard:

- initialiser _Composer_ dans ce projet
- installer _AltoRouter_ via _Composer_
- on peut en profiter pour installer _var-dumper_

### #3 .gitignore :see_no_evil:

- ce fichier permet de définir les fichiers que _Git_ doit ignorer
  - par exemple notre fichier de configuration spécifique à chaque machine et contenant des infos sensibles
  - ou bien le répertoire `vendor` généré et rempli par _Composer_

### #4 CoreModel :dancers:

- classe "mère" de chaque classe _Model_
- permet de regrouper méthodes et propriétés utiles pour tous les _Models_
- coder la classe dans `app/Models`

### #5 CoreController :older_woman:

- classe "mère" de chaque classe _Controller_
- permet de regrouper méthodes et propriétés utiles pour tous les _Controllers_
- coder la classe dans `app/Controllers`

### #6 DBData :floppy_disk:

- classe "mère" de chaque classe _Controller_
- permet de regrouper méthodes et propriétés utiles pour tous les _Controllers_
- coder la classe dans `app/Controllers`

### #7 Fichier de config :bow:

- créer le fichier
- placer les données nécessaires à la connexion à la base de données
- créer la version "dist"

### #8 Inclure les classes :loudspeaker:

- dans le _FrontController_
- inclure les classes utiles, dans le bon ordre :wink:
- ne pas oublier _Composer_ :wink:

### #9 Classe Application

- déclare les routes
- dispatch chaque requête HTTP vers la bonne méthode du bon controleur (méthode `run`)

### #10 404

- gérer correctement les 404
- créer et utiliser un _Controller_ `ErrorController`

### #11 Views

- créer les _views_ permettant d'afficher la page d'accueil et la page 404

### #12 :thinking:

- il reste des choses à faire ?
  - c'est possible en effet
  - on peut toujours améliorer notre code, et dans ce cas, notre framework
  - alors faisons-le :tada: