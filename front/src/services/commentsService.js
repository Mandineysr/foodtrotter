
import axios from 'axios';
import userService from "./userService.js";
import configuration from './_configuration.js';

const commentsService = {

  // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
  baseURI: configuration.backendBaseURI,

  postComment: function(recipeId, comment) {

    // récupération de l'utilisateur courant
    const currentUserData = userService.getCurrentUserData();

    // si l'utilisateur est connecté, poursuite du traitement
    if(currentUserData) {

      const userId = currentUserData.id;
      const token = currentUserData.token;

      // WARNING ne pas oublier le return sinon il ne sera pas possible de "chainer" les then(...)
      return axios.post(
        // DOC api comment https://developer.wordpress.org/rest-api/reference/comments/
        userService.baseURI + '/wp-json/wp/v2/comments',
        {
          author: userId,
          post: recipeId,
          content: comment,

          // DOC https://developer.wordpress.org/reference/functions/wp_set_comment_status/#parameters
          status: 'approve'
        },
        // nous "présentons" à wp notre token (ticket d'entrée)
        {
          headers: {
            Authorization: 'Bearer ' + token
          }
        }
      ).then(response => {
        // récupération de la réponse renvoyée par le serveur
        // nous retournons les data renvoyées par le serveur pour les rendre disponibles dans le then suivant
        return response.data;
      });
    }
    else {
      // utilisateur non connecté, la méthode ne fait rien
      return false;
    }
  },
 

  getCommentsByAuthor: function(id) {
    
    const currentUserData = userService.getCurrentUserData();
    const token = currentUserData.token;

    return axios.get(commentsService.baseURI + '/wp-json/wp/v2/comments?author=' + id,
      {
        headers: {
          Authorization: 'Bearer ' + token
        }
      }    
    )

    .then(commentsService.handleGetCommentsResponse);
  },

  handleGetCommentsResponse: function(response) {
    return response.data;
  },

};

export default commentsService;
