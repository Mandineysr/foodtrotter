<template>
  <v-card
    :loading="loading"
    class="mx-auto my-auto"
    max-width="800"
    color= "#fd7e2e">

    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>

       <v-card-title class="d-flex justify-center"> 
        BatMan grillée
        <v-rating
          :value="2.5"
          color="amber"
          dense
          half-increments
          readonly
          size="15"
          class="d-flex justify-center">
        </v-rating>
        </v-card-title>

    <v-img
     class="d-flex justify-center mx-auto my-auto"
      height="250"
      width="450"
      src="../assets/images/chauve-souris-grillee.jpg">
    </v-img>

    <v-card-text>
      <v-row
        align="center"
        class="d-flex justify-center" >
        
        <div class="black--text ml-4">
          2.5 (13)
        </div>
      </v-row>

      <div class="d-flex justify-center my-4 subtitle-1">
       Description de la recette
      </div>

    <v-btn text color="#e3cd8b">
        Temps :
    </v-btn>

    <ul>
        <p>Préparation : 30 minutes</p>
        <p>Cuisson : 45 minutes</p>
    </ul>

    <v-btn text color="#e3cd8b">
        Ingrédients :
    </v-btn>
    
    <ul>
        <p>1 BatMan</p>
        <p>oignons</p>
        <p>500g de patate</p>
        <p>Sauce tomate</p>
    </ul>
    
    <v-btn text color="#e3cd8b">
        Préparation :
    </v-btn>

        <ul>
            <p>Lorem ipsum dolor sit amet consectetur.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum fugiat dolorem, optio ducimus sunt, accusantium, tempora omnis commodi quam iste in et dolor pariatur.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia facilis quibusdam fugit accusantium sapiente quo quis rem perferendis itaque sint, nihil fugiat soluta nisi consectetur tempore quas provident maxime veritatis debitis et?</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab delectus optio ipsa amet quos, reprehenderit soluta sint?</p>
        </ul>
    </v-card-text>

    <v-divider class="mx-4"></v-divider>

    <v-card-text>
      <v-chip-group
        v-model="selection"
        active-class="deep-purple accent-4 white--text"
        column
      >
      </v-chip-group>
    </v-card-text>


  <v-container fluid>
    <v-row class="d-flex justify-center">
      <v-col
        cols="12"
        md="6">
        <v-textarea
          solo
          name="input-7-4"
          label="Commentaires"
        ></v-textarea>
      </v-col>
    </v-row>
  </v-container>

    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        @click="reserve">
        Bon appétit
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped lang="scss">

</style>