<?php

namespace FoodTrotter;

class Plugin
{

    public function __construct()
    {
        add_action(
            'init', // event "initialisation de wp
            [$this, 'createRecipeCPT']
        );

        add_action(
            'init', // event "initialisation de wp
            [$this, 'createCustomTaxonomies']
        );

        add_action(
            'init', // event "initialisation de wp
            [$this, 'initializeACF']
        );
        $this->api = new Api();

    }


    public function initializeACF()
    {
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(array(
                'key' => 'group_617fdb3574ede',
                'title' => 'Ingredients custom fields',
                'fields' => array(
                    array(
                        'key' => 'field_617fdb70d2005',
                        'label' => 'Ingredient picture',
                        'name' => 'picture_ingredient',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'taxonomy',
                            'operator' => '==',
                            'value' => 'recipe_ingredient',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
            
            acf_add_local_field_group(array(
                'key' => 'group_617ff87f6a5e3',
                'title' => 'Recipes custom fields',
                'fields' => array(
                    array(
                        'key' => 'field_617ff89409f30',
                        'label' => 'Preparation time',
                        'name' => 'preparation_time',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_617ff8b809f31',
                        'label' => 'Baking time',
                        'name' => 'baking_time',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_617ff8d809f32',
                        'label' => 'Coordinates',
                        'name' => 'coordinates',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'recipe',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
        }
    }


    public function createRecipeCPT()
    {
        // DOC create custom post type https://developer.wordpress.org/reference/functions/register_post_type/
        register_post_type(
            'recipe', // identifiant du custom post type
            [
                'label' => 'Recettes',

                // WARNING CPT, pour que le CPT soit éditable avec Gutemberg, il faut activer l'api sur le cpt
                'show_in_rest' => true,

                // les "articles" de type "recipe" sont administrable depuis le backoffice de wordpress
                'public' => true,

                // Le type "Recipe" n'a pas "d'enfants"
                'hierarchical' => false,

                // icone qui s'affiche dans l'interface d'administration de wordpress
                'menu_icon' => 'dashicons-carrot',


                // les fonctionnalités activées sur notre type de contenu custom
                // NOTICE PLUGIN, fonctionnalités activable pour un cpt :  ‘title’, ‘editor’, ‘comments’, ‘revisions’, ‘trackbacks’, ‘author’, ‘excerpt’, ‘page-attributes’, ‘thumbnail’, ‘custom-fields’, and ‘post-formats’.
                'supports' => [
                    'title',
                    'thumbnail',
                    'editor',   // le bloc edition de contenu
                    'excerpt',
                    'author',
                ],

                // 'custom-fields',

                // IMPORTANT WP ACL création de droits spécifique au cpt "recipe"
                // ACL : Access Control List
                'capability_type' => 'recipe',
                'map_meta_cap' => true,
            ]
        );

        // STEP WP PLUGIN rafraichissement du cache des règle de routing de wp
        // WARNING WP PLUGIN attention faire un flush des routes de cette manière est mauvais pour les perfomances (si l'on a beaucoup d'articles)
        // Wp enregistre les routes en bdd, il faut rafraichir les routes
        flush_rewrite_rules();
    }

    public function createCustomTaxonomies()
    {

        register_taxonomy(
            'recipe_ingredient',
            ['recipe'],
            [
                'label' => 'Ingredients',
                'public' => true,
                'show_in_rest' => true,
                'hierarchical' => false,
            ]
        );


        //! a voir si cette taxonomy est gardée ou si on utilise une api externet (cf start me)
        register_taxonomy(
            'recipe_country',
            ['recipe'],
            [
                'label' => 'Pays',
                'public'=> true,
                'show_in_rest' => true,
                'hierarchical' => true,
            ]
        );

        register_taxonomy(
            'recipe_type',
            ['recipe'],
            [
                'label' => 'Types',
                'public'=> true,
                'show_in_rest' => true,
                'hierarchical' => true,
            ]
        );
    }

    public function createIngredients()
    {
        $ingredients = [
            'Marmelade',
            'Tomates',
            'Café',
            'Aubergines',
            'Pates',
            'Carrotes',
            'Poivrons',
            'Potirons',
            'Salsifis',
            'Radis',
            'Fraises',
            'Cerises',
            'Bananes',
            'Citrons',
        ];
        $this->createTerms('recipe_ingredient', $ingredients);
    }

    public function createCountries()
    {
        $countries = [
            'France',
            'Angleterre',
            'Etats-Unis',
            'Allemagne',
            'Espagne',
            'Inde',
            'Italie',
            'Chine',
            'Brézil',
        ];
        $this->createTerms('recipe_country', $countries);
    }

    public function createRecipeTypes()
    {
        $types = [
            'Entrée',
            'Plat',
            'Dessert',
            'Aventurier',
        ];
        $this->createTerms('recipe_type', $types);
    }



    public function createTerms($taxonomyName, array $terms)
    {

        foreach($terms as $term) {
            // DOC wp_insert_term https://developer.wordpress.org/reference/functions/wp_insert_term/
            wp_insert_term($term, $taxonomyName);
        }
    }



    public function activate()
    {

        $this->createRecipeCPT();
        $this->createCustomTaxonomies();

        $this->createIngredients();
        $this->createCountries();
        $this->createRecipeTypes();
    }


    public function deactivate()
    {

    }
}


