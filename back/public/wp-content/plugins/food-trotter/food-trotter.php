<?php
/*
Plugin Name: "Food-trotter"
*/



use FoodTrotter\Plugin;

//================================================================

 // WARNING PLUGIN ne pas oublier de charger l'autoloader !
// pour générer l'autoloader, dans le terminal lancer la commande (dans le dossier du plugin):
// composer install

require __DIR__ . '/static-vendor/autoload.php';
//================================================================


// BONUS nous utilisons le serviceContainer pour retirer les dépendances entre la classe Plugin et les autres classes (c'est juste à titre pédagogique)
// instanciation du plugin
$plugin = new Plugin();


// DOC WP PLUGININ activation "hook" : https://developer.wordpress.org/reference/functions/register_activation_hook/
// au moment de l'activation du plugin, nous demandons au plugin de lancer les traitements dont il a besoin
register_activation_hook(
    // premier argument, le chemin vers le fichier de déclaration du plugin
    __FILE__,
    // appel de la méthode activate sur l'objet $plugin
    // En js la syntaxe serait plugin.activate
    [$plugin, 'activate']
 );


 register_deactivation_hook(
    __FILE__,
    [$plugin, 'deactivate']
 );

