// console.log('%c' + 'ingredient service loaded', 'color: #0bf; font-size: 1rem; background-color:#fff');

// importation de la bibliothèque axios
// import of axios library
import axios from 'axios';
import configuration from './_configuration.js';

const ingredientService = {

    // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
    baseURI: configuration.backendBaseURI,


    // ========================================================
    getIngredients: function () {
        return axios.get(ingredientService.baseURI + '/wp-json/wp/v2/recipe_ingredient?per_page=100')
        .then(ingredientService.handleGetIngredientsResponse);
    },

    handleGetIngredientsResponse: function(response) {
        return response.data
    },

    getRecipesByIngredient: function(id) {
        return axios.get(ingredientService.baseURI + '/wp-json/wp/v2/recipe?_embed=1&recipe_ingredient=' + id)
        .then(ingredientService.handleGetRecipesResponse);
    },
    
    handleGetRecipesResponse: function(response) {
        return response.data;
    },
};

export default ingredientService;