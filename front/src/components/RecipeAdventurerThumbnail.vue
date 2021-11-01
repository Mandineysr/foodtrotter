<template>
    <v-col xs="12" sm="6" md="6" lg="4" xl="3">
        <article v-if="recipe" class="thumbnail">
            <v-card
                class="mx-auto"
                elevation="2"
                outlined
            >
                <v-img
                    v-if="recipe._embedded['wp:featuredmedia']"
                    :src="recipe._embedded['wp:featuredmedia'][0].source_url"
                    height="200px"
                >
                </v-img>
                <v-card-title>
                    {{recipe.title.rendered}}
                </v-card-title>
                    <div class="excerpt" v-html="recipe.excerpt.rendered"></div>
                        <v-card-actions>
                            <router-link :to="{
                                name: 'recipe',
                                params: {
                                    id: recipe.id
                                }
                            }">
                            <v-btn
                                color="orange lighten-2"
                                text
                            >
                                Lire la suite
                            </v-btn>
                            </router-link>
                        </v-card-actions>
                </v-card>
        </article>    
    </v-col>
</template>

<script>

//import RecipeFigure from '../components/RecipeFigure.vue';

export default {
    props:{
        recipeTypeAdventurer: {
            type: Object,
        },
    },

    components: {
        //RecipeFigure
    }
}
</script>
