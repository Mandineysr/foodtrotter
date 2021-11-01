<template>
    <section>
        <h1 class="mt-8 mb-8">Mes notes de voyage</h1>
        <!-- à chaque tour de boucle, nous créons un composant RecipeThymbnail sur lequel nous renseignons la propriété "recipe" avec la recette courante //-->
        <v-row>
        <CommentsThumbnail
            v-for="currentComment in comments"
            :key="currentComment.id"
            :comments="currentComment"
        />
          </v-row>
    </section>
</template>
<script>

//import recipeService from '../services/recipeService.js';
import userService from "../services/userService.js";
import commentsService from "../services/commentsService.js";
import CommentsThumbnail from "./CommentsThumbnail.vue"

export default {

    components: {
        CommentsThumbnail
    
    },

    created() {
        const authorId = userService.getCurrentUserId();
        commentsService.getCommentsByAuthor(authorId).then((comments) => {
            this.comments = comments;
            
        });
        
    },

    

    data: function() {
        return {
            authorId:'',
            currentUser: [],
            comments: [

            ],
            
        }
    },
}


</script>


<style scoped>

</style>