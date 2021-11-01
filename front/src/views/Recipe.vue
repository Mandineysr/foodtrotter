<template>
    <div v-if="recipe" id="container" class="mx-16">
        <article>
            <RecipeFigure v-if="recipe._embedded['wp:featuredmedia']"
                :image="recipe._embedded['wp:featuredmedia'][0].source_url"
            />
            <div>
                <h1> {{recipe.title.rendered}}</h1>
            </div>
                <v-card
                    elevation="2"
                    outlined
                    class="pa-3"
                >
                <h3> Temps de préparation</h3>
                <div>
                    <span id="text" v-html="recipe.acf.preparation_time"></span> minutes
                </div>

                <h3>Temps de cuisson</h3>
                    <div>
                        <span id="text" v-html="recipe.acf.baking_time"></span> minutes
                    </div>
                </v-card>

                    <h2>Recette</h2>
                        <v-card
                            elevation="1"
                            class="pa-6"
                        >
                        <div v-html="recipe.content.rendered"></div>
                        </v-card> 
            <div>
                <!-- IMPORTANT router, génération d'un lien avec le router vuejs //-->
                <v-row justify="center">
                    <v-btn class="ma-8">
                        <router-link :to="{
                            name: 'home'
                        }">
                            Revenir sur la home
                        </router-link>
                    </v-btn>
                </v-row>
            </div>
        </article>

        <div class="comment-container">
            <div v-if="currentUser">
                    <CommentForm :recipeId="recipe.id" @commentPosted="addComment" />
            </div>
            <div v-if="comments">
                <h2>Commentaires</h2>
                    <RecipeComment v-for="comment in comments" :key="comment.id" :comment="comment"/>
            </div>
        </div>
    </div>
</template>


<script>

import amountService from '../services/amountService.js';
import recipeService from '../services/recipeService.js';
import userService from '../services/userService.js';
import RecipeFigure from '../components/RecipeFigure.vue';
import CommentForm from '../components/CommentForm.vue';
import RecipeComment from '../components/RecipeComment.vue';

export default {

    created: function() {
        // recipe ID
        const recipeId = this.$route.params.id;

        // data from ajax Request
        recipeService.getRecipeById(recipeId)
            .then(recipeData => {
                // recipie in component
                this.recipe = recipeData;
                // if comments
                if(recipeData._embedded.replies) {

                    this.comments = recipeData._embedded.replies[0];
                }
            });
                this.currentUser = userService.getCurrentUserData();
    //WARNING need to code the function to get the ingredient ID from a recipie
       const ingredientId = 35;

        amountService.getAmounts(ingredientId)
        .then(amountData =>{
           this.amount=amountData;
          
        })
    },

    components: {
        RecipeFigure,
        CommentForm,
        RecipeComment
    },

    data: function() {
        return {
            recipe: null,
            recipedata: null,
            recipeAmountData: null,
            currentUser: [ ],
            comments: null,
            amountData: [],
        }
    },

    methods: {
        addComment: function(comment) {
            if(!this.comments) {
                this.comments = [];
            }
            // last comment first in list
            this.comments.unshift(comment);
        }
    }
}

</script>

<style lang="scss" scoped>

h1 {
    font-weight: bolder;
    font-size: 4rem;
    padding-left: 5rem;
    margin-bottom: 1rem;
}

h2 {
  font-weight: bolder;
    font-size: 3rem;
    text-align: center; 
    margin-bottom: 1rem;
    margin-top: 1rem; 
}

#text {
    margin-bottom: 1rem;
}

#container {
    margin-top: 2rem;
}


</style>

