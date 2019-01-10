#!/bin/bash -e

# Je nettoie l'affichage du terminal
clear

# Variables de style
text_normal='\033[0m'
text_bold='\033[1m'
text_light='\033[0;34m'
text_green='\033[0;32m'

# Fonctions de présentation
function line {
    echo " "
}

# Pour ajouter le [ok] vert
function okmsg {
    echo -e "${text_green}${text_bold} [OK]${text_normal}"
    line
}

# Message
function bot {
  line
  echo -e "${text_light}${text_bold}$1${text_normal}$2${text_bold}$3${text_normal}"
}

echo -e "${text_bold}================================================================="
line
echo "               - oKanban VirtualHosts Installer -"
line
echo -e "=================================================================${text_normal}"
line

# Je demande où est situé le dossier de okanban (partie front)
bot "Chemin local du dossier contenant la partie front de okanban [/var/www/html/] ???"
read -e okanban_front

# Au cas où, on supprime "/var/www/html/" du chemin fourni
okanban_front=${okanban_front#/var/www/html/}
okanban_front="/var/www/html/${okanban_front}"

# Je demande où est situé le dossier de api.okanban (partie back)
bot "Chemin local du dossier contenant la partie back (api) de okanban [/var/www/html/] ???"
read -e okanban_api
line

# Au cas où, on supprime "/var/www/html/" du chemin fourni
okanban_api=${okanban_api#/var/www/html/}
okanban_api="/var/www/html/${okanban_api}"

# J'arrete apache proprement
printf "Arret d'apache"
service apache2 graceful-stop >> /dev/null
okmsg

# J'écrit un nouveau fichier de configuration pour apache.
# Le fichier de configuration viens décrire un VirtualHost.
# Je viens stocker le fichier dans les dossiers d'apache.
printf "Ecriture du fichier de configuration"
echo "<VirtualHost *:80>
    ServerAdmin webmaster@okanban.local
    DocumentRoot \"${okanban_front}\"
    ServerName okanban.local
    ServerAlias www.okanban.local
</VirtualHost>

<VirtualHost *:80>
    ServerAdmin webmaster@okanban.local
    DocumentRoot \"${okanban_api}\"
    ServerName api.okanban.local

    <Directory ${okanban_api}>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/okanban.local.conf
okmsg

# J'active le nouveau virtualhost
printf "Activation du fichier de configuration"
a2ensite okanban.local >> /dev/null
okmsg

# Pour finir je relance apache
printf "Démarrage d'apache"
service apache2 start >> /dev/null
okmsg