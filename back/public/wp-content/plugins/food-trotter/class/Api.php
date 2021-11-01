<?php

namespace FoodTrotter;

use WP_Error;
use WP_REST_Request;
use WP_User;

// STEP API ; la classe api va centraliser tous les traitement accessibles depuis le système d'API wordpress

class API
{

    /**
     * L'url racine de notre backend wordpress
     *
     * @var string
     */
    protected $baseURI;

    protected $namespace = 'foodtrotter/v1';

    public function __construct()
    {
        // calcul "automatique" du base uri du site
        $this->baseURI = dirname($_SERVER['SCRIPT_NAME']);
        // STEP API initialisation de l'api, enregisrement des "endpoints" (routes) de notre plugin

        $this->allowEndpoints();

        add_action(
            'rest_api_init',    // event
            [$this, 'initialize']   // callback
        );



    }

    public function initialize()
    {

        // STEP API configuration des routes
        // DOC API WP https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

        register_rest_route(
            // identifiant de notre api (namespace api , route pour accéder à l'api)
            $this->namespace,

            // url à matcher une fois que nous sommes dans notre api (voir argument au dessus)
            // endpoint (ici endpoint /user/signup)
            '/signup',
            [
                // WARNING API ne pas oublier le "s" pour la configuration des méthodes HTTP acceptées par la route
                // méthode HTTP (http verb) du endpoint
                'methods' => 'POST',

                // méthode à appeler lorsque le endpoint est validé
                'callback' => [$this, 'userSignup'],

                // https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/#permissions-callback
                // Notre endpoint est public
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            $this->namespace,
            '/upload-image',
            [
                'methods' => 'POST',
                'callback' => [$this, 'uploadImage'],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            $this->namespace,
            '/ingredient-submit',
            [
                'methods' => 'POST',
                'callback' => [$this, 'ingredientSubmit'],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            $this->namespace,
            '/recipe-create',
            [
                'methods' => 'POST',
                'callback' => [$this, 'recipeCreate'],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            $this->namespace,
            '/about',
            [
                'methods' => 'GET',
                'callback' => [$this, 'about'],
                'permission_callback' => '__return_true',
            ]
        );
    }



    // CORRECTION ATELIER
    public function recipeCreate() {

        $data = $this->getDataFromPostJSON();



        // DOC WP create post : https://developer.wordpress.org/reference/functions/wp_insert_post/
        $result = wp_insert_post([
            'post_type' => 'recipe',

            // TIPS ne pas mettre l'id de l'auteur manuellement car les données viennent du front, pour des raisons de sécurité, il ne faut pas se fier aux données qui viennent du front
            // 'post_author' => $data['userId'] 💩,
            'post_title' => $data['title'],
            'post_content' => $data['content'],
            'post_status' => 'publish'

            // TIPS ajout des termes associés au post
            /*
            tax_input' => [
                'recipe-type' => [$data['type']]
            ]
            */
        ]);

        // so recette bien créée; $result vaut l'id de la recette
        if(is_int($result)) {

            $ingredients = $data['ingredients'];
            wp_set_post_terms(
                $result,
                $ingredients,
                'recipe_ingredient'
            );
            /*
            // DOC ajout terms à un post : https://developer.wordpress.org/reference/functions/wp_set_post_terms/




            wp_set_post_terms(
                $result,
                [$data['type']],
                'recipe-type'
            );

            $data['id'] = $result;
            */

            update_field('preparation_time', $data['preparationTime'], $result);

            update_field('baking_time', $data['cookingTime'], $result);


            update_field('coordinates', $data['recipeCoordinate'], $result);

            return [
                'success' => true,
                'recipe' => $data
            ];
        }
        else {
            return [
                'success' => false,
            ];
        }
    }





    public function about()
    {
        return [
            // BONUS Version : semver (semantic versionning) https://semver.org/
            /*
                1er nombre : version majeure
                2nd nombre : version mineure
                3th nombre: version patch
            */
            'version' => '1.0.0',
            'name' => 'oCooking Ulysse',
            'change-log' => [
                '2021-09-03' => 'Création de l\'api ocooking',
            ]
        ];
    }


    // STEP API $request est un object construit par wordpress qui nous permet de récupérer (entres-autres) les données envoyées
    public function userSignup(WP_REST_Request $requestEvent)
    {
        // récupération des données envoyées par l'utilisateur
        $login = $requestEvent->get_param('username');
        $email = $requestEvent->get_param('email');
        $password = $requestEvent->get_param('password');


        $createResult = $this->createUser($login, $password, $email);

        // si $createResult est un objet de type WP_Error; il y a eu une erreur
        // l'api retourne la réponse en échec  avec la liste des erreurs
        if($createResult instanceof WP_Error) {
            return [
                'success' => false,
                'error' => $createResult,
            ];
        }
        else {
            // sinon l'api renvoie la réponse en succes avec les informations de l'utilisateur
            return [
                'success' => true,
                'user' => $createResult,
            ];
        }
    }

    // ========================================================================================
    // Méthodes de création d'un utilisateur ; pour faire du code plus propre il faudrait tout isoler dans une classe
    // ========================================================================================

    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @return WP_User|WP_Error
     */
    public function createUser($login, $password, $email)
    {

        // s'il n'y a pas d'erreur, $signupError vaut false ; sinon $signupError est un objet WP_Error
        $signupError = $this->getSignupDataError($login, $password, $email);
        if ($signupError) {
            // il y a eu un erreur, nous retournons l'erreur
            return $signupError;
        }

        // DOC wp_create_user https://developer.wordpress.org/reference/functions/wp_create_user/
        $userCreationResult = wp_create_user(
            $login,
            $password,
            $email
        );

        // $userCreationResult est un nombre, la création de l'utilisateur a fonctionné
        if(is_int($userCreationResult)) {

            // affectation des bons rôles à l'utilisateur
            $userId = $userCreationResult;
            $user = new WP_User($userId);
            $user->remove_role('subscriber');
            $user->add_role('contributor');

            // nous retournons l'utilisateur qui vient d'être créé
            return $user;
        }
        else {
            // il y a eu une erreur
            $wpError = $userCreationResult;
            return $wpError;
        }
    }


    // méthode de vérification des données d'inscription d'un nouvel utilisateur
    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @return bool|WP_Error
     */
    public function getSignupDataError($login, $password, $email)
    {

        // Controle des données envoyées par l'utilisateur
        $errors = [];

        if(mb_strlen($login) === 0) {
            $errors[] = 'empty login';
        }

        // est ce que le mot de passe est vide ; il faudrait un meilleur contrôle concernant la robustesse du mot de passe
        if(mb_strlen($password) === 0) {
            $errors[] = 'empty password';
        }

        if(mb_strlen($email) === 0) {
            $errors[] = 'empty email';
        }
        // ====================================================

        // si le tableau errors n'est pas vide, nous renvoyons une réponse d'échec
        if(!empty($errors)) {
            $wpError = new WP_Error();
            foreach($errors as $index => $message) {
                $wpError->add($index, $message);
            }
            return $wpError;
        }
        else {
            return false;
        }
    }


    public function ingredientSubmit(WP_REST_Request $requestEvent)
    {
        $description = $requestEvent->get_param('content');
        $title = $requestEvent->get_param('title');
        $imageId = $requestEvent->get_param('imageId');

        $termData = wp_insert_term($title, 'recipe_ingredient', [
            'description' => $description
        ]);


        if(is_array($termData)) {
            $termId = $termData['term_id'];
            update_field('picture_ingredient', $imageId, 'recipe_ingredient_' . $termId);
        }

        return $termData;

    }

    public function uploadImage()
    {
        $imageFileIndex = 'image';

        // récupération des informations concernant l'image uploadée
        $imageData = $_FILES[$imageFileIndex];

        // récupération du chemin fichier dans lequel est stocké l'image qui vient d'être uploadée
        $imageSource = $imageData['tmp_name'];

        // récupération es informations du dossier dans lequel wp stocke les fichiers uploadés
        $destination = wp_upload_dir();

        // dossier worpdress dans lequel nous allons stocker l'image
        $imageDestinationFoler = $destination['path'];

        // DOC nettoyage d'un nom de fichier avec wp https://developer.wordpress.org/reference/functions/sanitize_file_name/
        $imageName =  sanitize_file_name(
            md5(uniqid()) . '-' . // génération d'une partie aléatoire pour ne pas écraser de fichier existant
            $imageData['name']);
        $imageDestination = $imageDestinationFoler . '/' . $imageName;

        // on déplace le fichier uploadé dans le dossier de stokage de wp
        $success = move_uploaded_file($imageSource, $imageDestination);

        // si le déplacement du fichier à bien fonctionné
        if($success) {
            // récupération des informations dont wordpress a besoin pour identifier le type de fichier uploadé
            $imageType =  wp_check_filetype( $imageDestination, null);

            // préparation des informations nécessaires pour créer le media
            $attachment = array(
                'post_mime_type' => $imageType['type'],
                'post_title' => $imageName,
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // on enregistre l'image dans wordpress
            $attachmentId = wp_insert_attachment( $attachment, $imageDestination );

            if(is_int($attachmentId)) {
                // youpi merci wordpress...
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                // DOC on génère les metadatas pour le média https://developer.wordpress.org/reference/functions/wp_generate_attachment_metadata/
                $metadata = wp_generate_attachment_metadata( $attachmentId, $imageDestination );

                // on met à jour les metadata du media
                wp_update_attachment_metadata( $attachmentId, $metadata );

                return [
                    'status' => 'success',
                    'image' => [
                        'url' => $destination['url'] . '/' . $imageName,
                        'id' => $attachmentId
                    ]
                ];
            }
            else {
                return [
                    'status' => 'failed'
                ];
            }
        }

        return [
            'status' => 'failed'
        ];
    }


    // cette fonction nous permet de récupécupérer des données qui ont été envoyées en POST, mais dans le format json
    protected function getDataFromPostJSON()
    {
        // TIPS JSON/POST lorsque des données ont été envoyées sous forme de JSON (Content-type: json), pour récupérer la chaine de caractères "json", il faut faire de la façon suivante

        // récupération du json envoyé
        $json = file_get_contents('php://input');

        // transformation du json en tableau (le second argument true, indique à php qu enous souhaitons un tableau)
        $data = json_decode($json, true);

        // nous retournons le tabeau
        return $data;
    }


    public function allowEndpoints()
    {
        // il faut autoriser la route pour s'inscrire !
        add_filter('jwt_auth_whitelist', function ($endpoints) {

            return [
                '/wp-json/foodtrotter/v1/signup',
            ];
        });
    }


}
