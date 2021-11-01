<template>
    <v-col xs="12" sm="6" md="6" lg="4" xl="3">
        <article v-if="ingredient">
            <v-card class="mx-3" elevation="1" outlined>
                <v-img
                    v-if="ingredient.acf.picture_ingredient"
                    :src="ingredient.acf.picture_ingredient.sizes.large"
                    height="250px"
                >
                </v-img>
                    <v-card-title>
                        {{ingredient.name}}
                    </v-card-title>
                        <v-card-actions>
                            <p class="description-ing">Voir la description</p>
                                <v-btn
                                    large
                                    class="mx-3 mb-1"
                                    icon
                                    @click="show = !show"
                                >
                                    <v-icon large>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                                </v-btn>
                        </v-card-actions>
                    <v-expand-transition>
                        <div v-show="show">
                            <v-divider></v-divider>
                                <v-card-text>
                                    {{ingredient.description}}
                                </v-card-text>
                        </div>
                    </v-expand-transition>
            </v-card>
        </article>
    </v-col>
</template>

<script>

export default {
    props: {
        ingredient: {
            type: Object,
        },
    },

    data: () => ({
      show: false,
    }),
}
</script>

<style lang="scss">


</style>