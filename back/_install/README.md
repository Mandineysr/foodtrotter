# Installation automatisée de Wordpress

## Se placer dans le dossier _install

## Créer une copie du fichier _configuration.sample.sh et la renommer en _configuration.sh

## Modifier les informations contenue dans _configuration.sh
<strong style="color: red">WORDPRES_URL : BIEN FAIRE ATTENTION A L'URL !</strong>
Exemple :  
```
#!/bin/bash
echo "🛠️Loading configuration";

MYSQL_USER="explorateur"
MYSQL_PASSWORD="Ereul9Aeng"
MYSQL_HOST="localhost"
WORDPRESS_BDD="quigon_ocooking"
WORDPRESS_TABLE_PREFIX="wp_"
WORDPRESS_FOLDER="wp"
WORDPRES_URL="http://localhost/spe/wp-ocooking-backend/public"

WORDPRES_SITE_NAME="GQ ocooking"
WORDPRES_ADMIN_NAME="admin"
WORDPRES_ADMIN_PASSWORD="admin"
WORDPRES_ADMIN_EMAIL="admin@mail.com"
```

## Dans le dossier _install lancer la commande

```
bash ./install.sh ../public
```

