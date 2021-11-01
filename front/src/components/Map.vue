<template>
    <div>
        <h1>La Map interactive</h1>
            <div>
                <vl-map
                    data-projection="EPSG:4326"
                    style="height: 500px">
                    <vl-view
                        :zoom.sync="zoom"
                        :min-zoom="2" :center.sync="center"
                        :rotation.sync="rotation"
                    >
                    </vl-view>
                    <vl-layer-tile>
                        <vl-source-xyz url="https://stamen-tiles.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.jpg"></vl-source-xyz>
                    </vl-layer-tile>
                <div
                    v-for="(recipe, index) in recipes"
                    :key="index"
                >
                <vl-feature v-if="recipe.acf.coordinates">
                    <vl-geom-point 
                        :coordinates="recipe.acf.coordinates" 
                        @mouseover="showLabel">
                    </vl-geom-point>
                        <vl-overlay :ref="'overlay' + index" :id="'point-trigger' + index" :position="recipe.acf.coordinates">
                            <template>
                                <div class="point-trigger-element">
                                    <v-icon class="flag">mdi-flag</v-icon>
                                    <div class="overlay-container">
                                        <div class="overlay-content">
                                            <router-link :to="{
                                                name: 'recipe',
                                                params: {
                                                    id: recipe.id
                                                }
                                            }">
                                            {{recipe.title.rendered}}
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </vl-overlay>
                </vl-feature>
                </div>
                </vl-map>
            </div>
    </div>
</template>

<script>

import recipeService from '../services/recipeService.js';

export default {

// on veut récupérer les coordonnées gps rentrées en post type et le titre de la recette

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

  data: () => ({
      zoom: 0.5,
      center: [0, 0],
      rotation: 0,
      recipes: [],

      points: [
        {
          coordinates: [],
          name: ""
        },

      ],

      drawType: "Point",
      event: {
        name: null,
        description: null,
        location: {
          title: null,
          zoom: 5,
          coordinates: null
        }
      },
  }),

  methods: {
    showLabel(event) {
      console.log(event);
    }
  }
};

</script>

<style lang="scss" scoped>

@import "@/styles/variables.scss";

// marqueur
.point-trigger-element {
  background-color: #5D7052;
  margin-top: 0rem;
  padding: 0;
  border: solid 2px #fff;
  width: 16px;
  height: 16px;
  margin-top: -8px;
  margin-left: -8px;
  border-radius: 50%;
  position: absolute;
  cursor: pointer;
  z-index: auto;
}
// en passant sur le marqueur
.point-trigger-element:hover {
  background-color: #0ff;
}
//  en passant sur le drapeau qui est sur le marqueur
.point-trigger-element:hover .flag{
  transform: rotate(-5deg) scale(1.3);
  color: #FD7E2E;
}
// élément drapeau
.point-trigger-element .flag {
  transition: all 0.3s;
  margin-top: -32px;
  font-size: 2rem;
  color: blue;
  z-index: auto;
}

.point-trigger-element .overlay-container {
  position: absolute;
  width: 200px;
  text-align: center;
  margin-left: calc(-100px + 8px);
  margin-top: -10px;
  z-index: 3;
}

.point-trigger-element:hover .overlay-content {
  display: inline-block;
}
// bulle avec les noms de recettes cliquables
.overlay-content {
  display: none;
  background-color: #fff;
  padding: 2px 4px; 
  border: solid 1px #aaa;
  box-shadow: 3px 3px 3px #000;
  border-radius: 4px;
  z-index: 4;
}

</style>
