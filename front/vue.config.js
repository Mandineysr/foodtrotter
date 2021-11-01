module.exports = {
  // WARNING configuration pour la production !
  // publicPath: '/foodtrotter/front',
  publicPath: '/',
  // Pour configurer l'env pour le dev remplacer la ligne du dessus par
  // publicPath: '/',
  transpileDependencies: [
    'vuetify'
  ],
}

// WARNING .htacess production a ajouter dans le dossier dist
/*
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /projet-food-trotter-front/front/dist
RewriteRule ^/projet-food-trotter-front/front/dist/index\.html$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /projet-food-trotter-front/front/dist/index.html [L]
</IfModule>
*/
