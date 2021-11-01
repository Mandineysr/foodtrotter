<template>
    <v-col xs="12" sm="6" md="6" lg="4" xl="3">
        <article v-if="recipe" class="thumbnail">
            <v-card
                class="mx-5"
                elevation="2"
                outlined
            >
                <v-img
                    v-if="recipe._embedded['wp:featuredmedia']"
                    :src="recipe._embedded['wp:featuredmedia'][0].source_url"
                    height="200px"
                >
                </v-img>
                    <v-card-title>{{recipe.title.rendered}}</v-card-title>

                        <div class="excerpt px-6 pt-3" v-html="recipe.excerpt.rendered"></div>
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
                                    large
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

//import RecipeFigure from './RecipeFigure.vue';

export default {
    props:{
        recipe: {
            type: Object,
        },
    },

    components: {
        //RecipeFigure
    }
}
</script>

<style lang="scss">

a.more-link {
    display: none;
}

</style>
