<template> 
  <div>

    <p class="presentation">
      Hello jeune Aventurier ! Bienvenue sur notre site Food Trotter !<br>
      Ici tu pourras chercher, poster des recettes aussi exubérante soit elle !<br>
      Pour accéder au contenu de l'Aventurier du goût et poster une recette,<br>
      tu pourras t'inscrire et rejoindre notre fantastique communauté qui s'étend au niveau mondiale (et ouais je sais la classe ^^).<br>
      Nous te souhaitons une très bonne visite sur notre visite !
    </p>

    <!--================================================//-->
    <nav class="mx-8">
      <SelectRecipeTerms taxonomy="recipe_ingredient" label="Par ingrédients"/>
      <SelectRecipeTerms taxonomy="recipe_type" label="Par types de plat"/>
      <SelectRecipeTerms taxonomy="recipe_country" label="Par Pays"/>
    </nav>

      <!--====================== MAP ==========================//-->  
          <Map />
        
      </div>
</template>

<script>

import recipeService from '../services/recipeService.js';
import SelectRecipeTerms from "../components/SelectRecipeTerms";
import Map from '../components/Map.vue';


export default {
  components: {
    SelectRecipeTerms,
    Map
  },
  created() {
      recipeService.getRecipes().then((recipes) => {
          this.recipes = recipes;

          for(let recipe of this.recipes) {
              if(recipe.acf.coordinates) {
                  recipe.acf.coordinates = recipe.acf.coordinates.replace(/ /, '').split(',');
                  recipe.acf.coordinates[0] = Number(recipe.acf.coordinates[0]);
                  recipe.acf.coordinates[1] = Number(recipe.acf.coordinates[1]);

                  console.table(recipe.acf.coordinates);
                }
          }
      });
  },

  methods: {
    showLabel(event) {
      console.log(event);
    }
  }
}

</script>

<style lang="scss" scoped>

@import "@/styles/variables.scss";


.presentation {
  text-align: center;
  padding-top: 1rem;
  font-size: 1.5rem;
  font-weight: 400;
}

h1 {
  text-align: center;
  font-weight: 600;
  font-size: 2.5rem;
  margin-bottom: 2rem;
}

nav {
  display: flex;
  justify-content: center;
  padding: 40px;
}

</style>
