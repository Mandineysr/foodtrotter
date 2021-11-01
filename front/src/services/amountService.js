import axios from 'axios';
import configuration from './_configuration.js';

const amountService = {

  // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
  baseURI: configuration.backendBaseURI,


    // ========================================================
    getAmounts: function (id) {
        return axios.get(amountService.baseURI + 'wp-json/foodtrotter/v1/amount-by-recipe?recipeId='+ id)
        .then(amountService.handleGetAmountResponse);
    },

    handleGetAmountResponse: function(response) {
        return response.data
    },
};

export default amountService;

