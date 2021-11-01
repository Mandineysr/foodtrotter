<template>
    <div class="d-flex flex-line justify-center align-stretch">
        <div class="mb-3 ">
            <div>
                <h1>Proposition d'un nouvel ingrédient</h1>
            </div>
                 <div class="ml-5">
                    <v-form 
                        ref="form"
                        lazy-validation
                    >
                        <v-text-field
                            v-model="title"
                            label="Nom de l'ingrédient"
                            required
                        >
                        </v-text-field>
                        <v-file-input
                            v-model="image"
                            accept="image/*"
                            label="Charger l'image"
                            @change="uploadImage"
                        >
                        </v-file-input>
                        <v-card-text>
                            <img v-if="uploadedImage" :src="uploadedImage" />
                        </v-card-text>
                        <v-textarea
                            v-model="content"
                            outlined
                            auto-grow
                            name="input-7-4"
                            label="Description de l'ingrédient"
                            hint="Son utilisation, son histoire, le pays d'origine, bref tout ce qui rend l'ingrédient original et intéressant"
                        >
                        </v-textarea>
                        <v-btn
                            color= light-green darken-4
                            class="mr-4"
                            @click="sendNewIngredient"
                        >
                            Proposer l'ingrédient
                        </v-btn>
                    </v-form>
                </div>
           </div>
    </div>
</template>


<script>

import newIngredientService from '../services/newIngredientService.js';

export default {
    props: {
        newIngredientService: {
            type: Object,
        },
    },

    data () {
        return {
        title: '',
        ingredientName: '',
        image: null,
        description: '',
        uploadedImage: null,
        imageId: null,
        content: '',
        }
    },

  methods: {
    sendNewIngredient: function(event) {
      event.preventDefault();

      newIngredientService.postNewIngredient(
          this.title,
          this.content,
          this.imageId,

      ).then(response => {
          console.log(response);
      });
    },

    uploadImage() {
        if(this.image) {
            newIngredientService.uploadImage(this.image)
            .then(data => {
                if(data.status == 'success') {
                    this.uploadedImage = data.image.url;
                    this.imageId = data.image.id;
                }
            });
        }
      else {
          this.uploadedImage = null;
          this.imageId = null;
      }
    },
  }
}


</script>

<style lang="scss">

</style>