<template>
    <section>
            <h1>{{title}}</h1>
                <h2 class="tri">Trier par :</h2>
            <nav class="mx-8 mb-8">
                <SelectRecipeTerms taxonomy="recipe_ingredient" label="Par ingrédients"/>
                <SelectRecipeTerms taxonomy="recipe_type" label="Par types de plat"/>
                <SelectRecipeTerms taxonomy="recipe_country" label="Par Pays"/>
            </nav>
                <v-row>
                    <RecipeThumbnail
                        v-for="currentRecipe in recipes"
                        :key="currentRecipe.id"
                        :recipe="currentRecipe"
                    />
                </v-row>
        </section>
</template>

<script>

import recipeService from '../services/recipeService.js';
import RecipeThumbnail from '../components/RecipeThumbnail.vue';
import userService from "../services/userService.js";
import SelectRecipeTerms from "../components/SelectRecipeTerms";


export default {

    components: {
      RecipeThumbnail,
      SelectRecipeTerms
    },

    created() {
        if(this.searchType == 'byCurrentUser'){
            this.searchByCurrentUser();
        }
        else if(this.searchType == 'byText') {
            this.searchText = this.$route.params.search;
            this.searchByText();
        }
        else {
            this.searchByTerm();
        }
    },

    props: [
        'title',
        'taxonomy',
        'id',
        'excludedTermId',
        'excludedTaxomony',
        'searchType',
        'searchText'
    ],
  
    data: function() {
        return {
             recipes: [

             ]
        }
    },

    methods: {
        // ==============================================================================
        // type de recherche
        // ==============================================================================
        searchByTerm() {
            if(this.$route.params.taxonomy) {
                this.taxonomy = this.$route.params.taxonomy;
                this.id = this.$route.params.id;
            }
            recipeService.getRecipesByTerm(
                this.taxonomy,
                this.id
            ).then((recipes) => {
                this.recipes = this.filterRecipesByTerm(recipes);
            });
        },

        searchByCurrentUser() {
            const authorId = userService.getCurrentUserId();
            recipeService.getRecipesByAuthor(authorId).then((recipes) => {
                this.recipes = this.filterRecipesByTerm(recipes);
            });
        },

        searchByText() {
            recipeService.getRecipesByTerm(
                this.taxonomy,
                this.id
            ).then((recipes) => {
                recipes = this.filterRecipesByTerm(recipes);
                recipes = this.filterRecipesByText(recipes, this.searchText);

                this.recipes = recipes;
            });
        },

        // ==============================================================================
        // filtres
        // ==============================================================================

        filterRecipesByText(recipes, text) {
            let validRecipes = [];
            for(let recipe of recipes) {

                let regexp = new RegExp(text, 'i');
                if(recipe.title.rendered.match(regexp)) {
                    validRecipes.push(recipe);
                }
            }
            return validRecipes;
        },

        filterRecipesByTerm(recipes) {
            let validRecipes = [];
            for(let recipe of recipes) {
                // si un "term" d'une taxonomy doit être exclu, alors il faut vérfier dans l'objet "recipe" que l'id du term n'est pas présent dans la propriété stockant la liste des "terms" pour une taxonomie 
                if(this.excludedTaxomony) {
                    if(!recipe[this.excludedTaxomony].includes(this.excludedTermId)) {
                        // la recette ne fait pas partie de liste d'exclusion, nous l'ajoutons à la liste
                        validRecipes.push(recipe);
                    }
                }
                else {
                    // si aucun term exclu, on ajoute la recette à la liste
                    validRecipes.push(recipe);
                }
            }
            return validRecipes;
        }
    }
}

</script>

<style lang="scss">

nav {
  display: flex;
  justify-content: center;
  padding: 40px;
}

.tri {
    text-align: center;
}
</style>
