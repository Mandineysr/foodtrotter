<template>
    <section>
        <h1 class="mt-8 mb-8">Mon carnet de recettes d'aventurier</h1>
        <!-- à chaque tour de boucle, nous créons un composant RecipeThymbnail sur lequel nous renseignons la propriété "recipe" avec la recette courante //-->
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
import RecipeThumbnail from './RecipeThumbnail.vue';
import userService from "../services/userService.js";

export default {

    components: {
        RecipeThumbnail
    },

    created() {
        const authorId = userService.getCurrentUserId();
        recipeService.getRecipesByAuthor(authorId).then((recipes) => {
            this.recipes = recipes;
        });
    },

    data: function() {
        return {
            authorId:'',
            currentUser: [],
            recipes: [
            ]
        }
    },
}

</script>

<style scoped>


</style>