<template>
    <main>
        <h1>Liste des ingrédients</h1>
            <v-row class="mx-12">
                    <IngredientThumbnail 
                        v-for="currentIngredient in ingredients"
                        :key="currentIngredient.id"
                        :ingredient="currentIngredient"
                    />
            </v-row>
    </main>
</template>

<script>

import IngredientThumbnail from '../components/IngredientThumbnail.vue';
import ingredientService from '../services/ingredientService.js';

export default {
  components: { 
      IngredientThumbnail
  },

  created() {
      ingredientService.getIngredients().then((ingredients) => {
          this.ingredients = ingredients;
      });
  },

  data: function() {
      return {
          ingredients: [
              
          ]
      }
  },
    
}
</script>

<style lang="scss">

h1 {
    text-align: center;
    margin: 2rem;
}

h1{
    font-weight: bolder;
    font-size: 4rem;
    padding-left: 5rem;
    margin-bottom: 1rem;
}


</style>