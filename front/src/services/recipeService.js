// console.log('%c' + 'recipe service loaded', 'color: #0bf; font-size: 1rem; background-color:#fff');
import axios from 'axios';

import configuration from './_configuration.js';

const recipeService = {

  // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
  baseURI: configuration.backendBaseURI,


  getRecipes: function () {
    // return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe?_embed&per_page=100&recipe_type=2,3,4')
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe?_embed&per_page=100')
      .then(recipeService.handleGetRecipesResponse);
  },

  getRecipeIngredient: function () {
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe/?_embed=1')
      .then(recipeService.handleGetRecipesResponse);
  },
  handleGetRecipesResponse: function (response) {
    return response.data;
  },

  // =================================================================

  getTermsByTaxonomy: function (taxonomy) {
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/' + taxonomy)
      .then(response => {
        return response.data;
      });
  },

  getRecipesByTerm: function (taxonomy, id) {
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe?_embed=1&per_page=100&' + taxonomy + '=' + id)
      .then(response => {
        return response.data;
      });
  },

    // =================================================================

  getRecipeTypes: function (type) {
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe?_embed=1&recipe_type=' + type)
      .then(recipeService.handleGetRecipesResponse);
  },
  getRecipeById: function (id) {
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe/' + id + '?_embed=1')
      .then(response => {
        return response.data;
      })
  },

  // =================================================================

  getRecipesByAuthor: function (id) {
    return axios.get(recipeService.baseURI + '/wp-json/wp/v2/recipe?_embed=1&author=' + id)
      .then(recipeService.handleGetRecipesByAuthorResponse);
  },
  handleGetRecipesByAuthorResponse: function (response) {
    return response.data;
  },
// =================================================================

    getRecipeTypeAdventurer: function() {
      return axios.get(recipeService.baseURI + 'wp-json/wp/v2/recipe?_embed=1&recipe_type=46')
        .then(recipeService.handleGetRecipeTypeAdventurerResponse);
    },

    handleGetRecipeTypeAdventurerResponse: function(response) {
      return response.data;
    }
};

export default recipeService;
