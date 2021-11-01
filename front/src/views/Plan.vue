<template>
  
    <v-app id="inspire">
      <v-container fluid class="pa-0">
        <v-parallax src="" height="600" class="gradientBkg" jumbotro>
          <v-layout row align-center justify-center>
            <v-flex xs10 sm8 md6>
              <v-layout row wrap justify-center>
                <v-flex xs10 text-xs-center>
                
                  <h1 class="display-2"><strong></strong></h1>
                </v-flex>
                <v-flex xs10 text-xs-center class="mt-2">
                 <h1 class="display-2"><strong>Plan du site</strong></h1>
                  <v-flex xs8 text-xs-center>
                    <img
                      src="../assets/plandusite.svg"
                      style="max-width: 900px"
                    />
                  </v-flex>
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
        </v-parallax>
      </v-container>

      <v-container class="contentplan">
        <v-layout row wrap justify-space-between text-xs-center class="mt-5">
          <v-flex xs10 sm3 text-xs-center>
            <img
              src="../assets/recette.svg"
              class="elevation-1"
              style="max-width: 50px"
            />
            <p class="title mt-4">RECETTES</p>
            <p>Grâce à ce menu, vous aurez accès</p>
            <p>aux différentes recettes du site que vous</p>
            <p>pourrez trier par pays ou ingrédients.</p>
          </v-flex>
          <v-flex xs10 sm3 text-xs-center>
            <img
              src="../assets/ingredient.png"
              class="elevation-1"
              style="max-width: 50px"
            />
            <p class="title mt-4">INGREDIENTS</p>
            <p>Découvrez et proposez des ingrédients pour</p>
            <p>agrémenter nos recettes.</p>
          </v-flex>
          <v-flex xs10 sm3 text-xs-center>
            <img
              src="../assets/fichier.png"
              class="elevation-1"
              style="max-width: 50px"
            />
            <p class="title mt-4">CONTRIBUTIONS</p>
            <p>Proposez vos trouvailles, vos améliorations,</p>
            <p>cela sera pour nous un delice de</p>
            <p>vous lire.</p>
          </v-flex>
          <v-flex xs10 sm3 text-xs-center>
            <img
              src="../assets/danger.png"
              class="elevation-1"
              style="max-width: 50px"
            />
            <p class="title mt-4">+18ans</p>
            <p>Cette partie du site vous propose des</p>
            <p>recettes peu communes, à la</p>
            <p>préparation délicate et précise.</p>
          </v-flex>
        </v-layout>
      </v-container>
    </v-app>
 
</template>

<script>
</script>
<style>
.fa {
  font-size: 20px !important;
   background: #e3cd8b;
}
.gradientBkg {
  background: #e3cd8b;
}
.contentplan{
   background: #e3cd8b;
}
</style>