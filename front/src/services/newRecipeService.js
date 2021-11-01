console.log('%c' + 'Recipe service loaded', 'color: #0bf; font-size: 1rem; background-color:#fff');

import axios from 'axios';
import userService from './userService.js';
import configuration from './_configuration.js';

const newRecipeService = {

  // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
  baseURI: configuration.backendBaseURI,

  // =================================================================

    postRecipe: function(title, content, ingredients, preparationTime, cookingTime, recipeCoordinate) {
        const currentUserData = userService.getCurrentUserData();
        if(currentUserData) {

          const userId = currentUserData.id;

          // WARNING à modifier
          const token = currentUserData.token;

          return axios.post(

            // WARNING à modifier
            newRecipeService.baseURI + '/wp-json/foodtrotter/v1/recipe-create',
            {
              userId: userId,
              title: title,
              content: content,
              ingredients: ingredients,
              preparationTime: preparationTime,
              cookingTime: cookingTime,
              recipeCoordinate: recipeCoordinate
              // portions: portions
            },
            {
              headers: {
                Authorization: 'Bearer ' + token
              }
            }
          ).then(response => {
            return response.data;
          });
        }
        else {
          return false;
        }
      },

      uploadImage(image) {
        // For is a javascript object that simulate the building of sending data as if they where from an form

        let formData = new FormData();
        formData.append('image', image);
        const currentUserData = userService.getCurrentUserData();
        const token = currentUserData.token;
        const configuration = {
            headers: {
                'Content-Type': 'multipart/form-data',
                'Authorization': 'Bearer ' + token
            }
        };
        // sending picture to API
        return axios.post(
            userService.baseURI + '/wp-json/foodtrotter/v1/upload-image',
            formData,
            configuration
        ).then(response => {
            return response.data;
        });
    }
};

export default newRecipeService;