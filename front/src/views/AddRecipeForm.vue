<template>
  <div class="d-flex flex-line justify-center">
    <div class="mb-3">
      <div>
        <h1>Ajouter une recette</h1>
      </div>
      <div class="ml-5">
        <v-form @submit="sendRecipe" ref="form" v-model="valid" lazy-validation>
          <v-text-field class="font-weight-black" v-model="title" label="Titre de la recette" required>
          </v-text-field>
          <v-slider
          color="light-green"
            class="align-center mt-7 font-weight-black"
            v-model="preparationTime"
            label="Temps de préparation"
            min="5"
            max="120"
            hide-details
            thumb-label="always"
          >
          </v-slider>
          <v-slider
          color="light-green"
            class="align-center mt-10 font-weight-black"
            v-model="cookingTime"
            label="Temps de cuisson"
            min="1"
            max="120"
            hide-details
            thumb-label="always"
          >
          </v-slider>



          <div>
            <v-text-field
              label="Coordonnées du pays d'origine de la recette"
              v-model="recipeCoordinates"
            ></v-text-field>
          </div>





          <!-- Nombre de portions
                    <v-slider
                        class="align-center mt-5"
                        v-model="portions"
                        label="Nombre de portions"
                        max="8"
                        min="1"
                        hide-details
                        thumb-label="always"
                    >
                    </v-slider>
                ================== //-->
          <h2 class="centrer mt-51" >Liste des ingrédients</h2>


          <v-autocomplete
            :items="ingredients"
            v-model="selectedIngredients"
            chips
            clearable
            deletable-chips
            multiple
            small-chips
            item-text="name"
            item-value="id"
          ></v-autocomplete>



          <!--
          <v-textarea
          class="font-weight-black mt-5"
            v-model="content"
            outlined
            auto-grow
            name="input-7-4"
            label="Veuillez saisir un ingrédient avec sa quantité par ligne"
          >
          </v-textarea>
          //-->
          <h2 class="centrer">Etapes de la recette</h2>
          <v-textarea
          class="font-weight-black mt-5"
            v-model="content"
            outlined
            auto-grow
            name="input-7-4"
            label="Veuillez saisir une étape par ligne"
          >
          </v-textarea>
          <v-row justify="center">
          <v-btn
            :disabled="!valid"
            color="light-green"
            darken-4
            class="mr-4 valider"
            @click="sendRecipe"
          >
            Ajouter
          </v-btn>
          </v-row>
        </v-form>
      </div>
    </div>
  </div>
</template>

<script>
import newRecipeService from "../services/newRecipeService.js";

import recipeService from "../services/recipeService.js";

// import SelectInTaxonomy from '../components/SelectInTaxonomy.vue';

export default {
  components: {
    // SelectInTaxonomy
  },

  props: {
    newRecipeService: {
      type: Object,
    },
  },

  data: () => {
    return {
      title: "",
      content: "",

      preparationTime: 5,
      cookingTime: 1,
      recipeCoordinates: '',

      ingredients: [
        'Carottes',
        'Tomates',
      ],

      selectedIngredients: [],

      // portions: 1,

      valid: true,
      select: null,

      slider: "",
      slider_count: "",
      TPH: "",
      TPM: "",
      TCH: "",
      TCM: "",
      // ingredients: "",

      plat: "",
      pays: "",
      picture: "",
      type: 0,
    };
  },

  created() {
    console.log("Init");
    recipeService.getTermsByTaxonomy('recipe_ingredient').then(ingredients => {
      this.ingredients = ingredients;
    })
  },

  methods: {
    sendRecipe(event) {
      event.preventDefault();
      console.log("send recipe");

      newRecipeService
        .postRecipe(
          this.title,
          this.content,
          this.selectedIngredients,
          this.preparationTime,
          this.cookingTime,
          this.recipeCoordinates
        )
        .then((response) => {
          console.log(response);

          /*
        this.$router.push({
          name: "recipe",
          params: {
            id: response.recipe.id,
          },
        });
        */
        });
    },

    validate() {
      this.$refs.form.validate();
    },

    setTypes: function (recipeTypes) {
      console.log(recipeTypes);
      this.type = recipeTypes;
    },

    sendNewRecipe: function (event) {
      event.preventDefault();

      newRecipeService
        .postRecipe(
          this.title,
          this.slider,
          this.slider_count,
          this.TPH,
          this.TPM,
          this.TCH,
          this.plat,
          this.pays,
          this.picture
        )
        .then((response) => {
          console.log(response);
          this.$router.push({
            name: "recipe",
            params: {
              id: response.recipe.id,
            },
          });
        });
    },
  },

  uploadImage() {
    if (this.image) {
      newRecipeService.uploadImage(this.image).then((data) => {
        if (data.status == "success") {
          this.uploadedImage = data.image.url;
          this.imageId = data.image.id;
        }
      });
    } else {
      this.uploadedImage = null;
      this.imageId = null;
    }
  },
};
</script>


<style scoped lang="scss">
textarea {
  width: 100%;
  height: 100px;
}

.centrer{
  text-align: center;
}

v-text-field, v-textarea {
  font-size: 7px;
}

</style>