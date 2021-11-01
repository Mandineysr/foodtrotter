<template>
  <div class="d-flex flex-line justify-center align-stretch">
    <div class="mb-3">
      <div>
        <h1>Ajouter une recette</h1>
      </div>
      <div class="ml-5">
        <v-form @submit="sendRecipe" ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="title"
            label="Titre de la recette"
            required
          ></v-text-field>
          <v-slider
            v-model="slider"
            label="Nombre de portions"
            class="align-center"
            :max="max"
            :min="min"
            hide-details
          >
            <template v-slot:append>
              <v-text-field
                v-model="slider_count"
                class="mt 0 pt 100"
                hide-details
                single-line
                type="number"
                style="width: 60px"
              ></v-text-field>
            </template>
          </v-slider>
          <v-container fluid>
            <v-row align="center">
              <v-col cols="12" sm="6">
                <v-subheader v-text="'Temps de préparation'"></v-subheader>
              </v-col>

              <v-row cols="12" sm="6">
                <v-col cols="12" sm="6" md="3">
                  <v-text-field v-model="TPH" label="Heure"></v-text-field>
                </v-col>

                <v-col cols="12" sm="6" md="3">
                  <v-text-field v-model="TPM" label="Minute"></v-text-field>
                </v-col>
              </v-row>

              <v-col cols="12" sm="6">
                <v-subheader v-text="'Temps de cuisson'"></v-subheader>
              </v-col>

              <v-row cols="12" sm="6">
                <v-col cols="12" sm="6" md="3">
                  <v-text-field v-model="TCH" label="Heure"></v-text-field>
                </v-col>

                <v-col cols="12" sm="6" md="3">
                  <v-text-field v-model="TCM" label="Minute"></v-text-field>
                </v-col>
              </v-row>
            </v-row>
          </v-container>

          <!-- Récupérer la liste de tous les ingrédients  -->
          <v-row align="center">
            <v-col cols="12" sm="6">
              <v-subheader v-text="'Ingrédient particulier'"></v-subheader>
            </v-col>
            <v-col cols="12" sm="6">
              <!--<SelectRecipeType @change="setType" />-->
            </v-col>
          </v-row>

          <h1>Liste des ingrédients</h1>
          <v-textarea
            v-model="ingredients"
            outlined
            auto-grow
            name="input-7-4"
            label="Veuillez saisir un ingrédient par ligne"
          ></v-textarea>

          <h1>Etapes de la recette</h1>
          <v-textarea
            v-model="content"
            outlined
            auto-grow
            name="input-7-4"
            label="Veuillez saisir une étape par ligne"
          ></v-textarea>
          <p>
            Si votre recette nécessite une cuisson au four, veuillez indiquer la
            température de cuisson.
          </p>

          <v-container fluid>
            <v-row align="center">
              <v-col cols="12" sm="6">
                <v-subheader v-text="'Type de plat'"></v-subheader>
              </v-col>
              <v-col cols="12" sm="6">
                <!--<SelectRecipeType @change="recipeTypes" />-->
                <v-select
                  v-model="plat"
                  :items="plat"
                  :menu-props="{ maxHeight: '400' }"
                  label="Sélection"
                  chips
                  persistent-hint
                ></v-select>
              </v-col>

              <v-col cols="12" sm="6">
                <v-subheader v-text="'Pays d\'origine'"></v-subheader>
              </v-col>
              <v-col cols="12" sm="6">
                <v-select
                  v-model="pays"
                  :items="pays"
                  label="Sélection"
                  chips
                  persistent-hint
                ></v-select>
              </v-col>
            </v-row>
          </v-container>
          <v-file-input
            v-model="picture"
            accept="image/*"
            label="Charger l'image"
            @change="uploadImage"
          ></v-file-input>
          <v-btn
            :disabled="!valid"
            color="light-green"
            darken-4
            class="mr-4"
            @click="sendNewRecipe"
          >
            Ajouter
          </v-btn>
        </v-form>
      </div>
    </div>
  </div>
</template>

<script>
import newRecipeService from "../services/newRecipeService.js";
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
      valid: true,
      select: null,
      title: "",
      slider: "",
      slider_count: "",
      TPH: "",
      TPM: "",
      TCH: "",
      TCM: "",
      ingredients: "",
      content: "",
      plat: "",
      pays: "",
      picture: "",
      type: 0,
    };
  },

  methods: {
    validate() {
      this.$refs.form.validate();
    },

    setTypes: function (recipeTypes) {
      console.log(recipeTypes);
      this.type = recipeTypes;
    },

    sendNewRecipe: function (event) {
      event.preventDefault();
      
      newRecipeService.postRecipe(
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
</style>