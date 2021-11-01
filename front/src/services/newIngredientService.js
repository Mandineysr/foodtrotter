import axios from 'axios';
import userService from "./userService.js";
import configuration from './_configuration.js';

const newIngredientService = {

    // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
    baseURI: configuration.backendBaseURI,


    postNewIngredient: function (title, content, imageId) {
        const currentUserData = userService.getCurrentUserData();
        if (currentUserData) {

            const userId = currentUserData.id;
            const token = currentUserData.token;

            return axios.post(

                userService.baseURI + '/wp-json/foodtrotter/v1/ingredient-submit',
                {
                    userId: userId,
                    title: title,
                    content: content,
                    imageId: imageId,
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

export default newIngredientService;
