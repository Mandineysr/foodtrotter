<template>
    <div class="text-center">
      <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="#FD7E2E" dark v-bind="attrs" v-on="on" class="mx-6">
            {{label}}
            <i class="fas fa-chevron-down"></i>
          </v-btn>          
        </template>
        <v-list>
          <v-list-item v-for="(currentRecipeType, index) in recipeTypes" :key="index">
            <v-list-item-title @click="selectedType=currentRecipeType.id; recipesByTypes()">{{ currentRecipeType.name }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>
</template>


<script>

import recipeService from '../services/recipeService.js';
export default {

    props: [
        'taxonomy',
        'label',
    ],

    methods: {

        // lorsque le visiteur a choisi un type de plat, il est redirigé vers la page affichant la liste de plat pour le type qu'il a sélectionné
        recipesByTypes: function() {
            if(this.selectedType) {

                this.$router.push({
                    name: 'recipesByTerm',
                    params: {
                        taxonomy: this.taxonomy,
                        id: this.selectedType
                    }
                });
            }
        }
    },
    created() {
        // au moment de la création du composant, récupération depuis l'api de la liste des type de plat
        recipeService.getTermsByTaxonomy(this.taxonomy).then((recipeTypes) => {

            this.recipeTypes = recipeTypes;
        });
    },

    // data stocke les données "privées" du composant
    data: function() {
        return {
            // selected type de plat stocke la type choisi par le visiteur
            selectedType: null,
            // recipeTypes stocke la liste des types de plat exitants
            recipeTypes:[],
            
        }
    },
}
</script>
