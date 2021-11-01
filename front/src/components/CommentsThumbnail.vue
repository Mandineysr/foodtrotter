<template>
    
    <v-col xs="12" sm="6" md="6" lg="4" xl="3">
    <article v-if="comments" class="thumbnail">

        <v-card
            class="mx-auto"
            elevation="2"
            outlined
        >

            <v-card-title>
               <!-- {{recipe.title.rendered}} -->
            </v-card-title>

            <div class="excerpt" v-html="comments.content.rendered"></div>

             <v-card-actions>

                <router-link :to=" comments.link ">
                    <v-btn
                        color="orange lighten-2"
                        text
                    >
                        Voir la recette
                    </v-btn>
                </router-link>
            </v-card-actions> 
        </v-card>
    </article>    
</v-col>





</template>


<script>



export default {
  props:{
        comments: {
            type: Object,
        },
        
    },  
}
</script>


<style scoped lang="scss">


</style>