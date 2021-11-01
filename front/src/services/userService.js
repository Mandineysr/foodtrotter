import axios from 'axios';
import configuration from './_configuration.js';

const userService = {

  userDataKey: 'userData',

  // baseURI: 'http://ec2-54-208-240-29.compute-1.amazonaws.com/projet-food-trotter-back/public',
  baseURI: configuration.backendBaseURI,


  // =================================================================
  getToken: function(username, password) {

    // axios POST request

    // sending to API
    return axios.post(
      userService.baseURI + '/wp-json/jwt-auth/v1/token',
      {
        username: username,
        password: password
      }

    ).then(response => {

      //if correct
      if(response.data.code === 'jwt_auth_valid_credential') {

        const stringData = JSON.stringify(response.data.data);

        window.sessionStorage.setItem(userService.userDataKey, stringData);

        return response.data.data;
      }
      else {
        return false;
      }
    });
  },

  
  signup: function(username, email, password) {
    return axios.post(
      userService.baseURI + '/wp-json/foodtrotter/v1/signup',
      {
        username: username,
        email: email,
        password: password
        
      }
    ).then(response => {
      return response.data;
    });
  },

  getCurrentUserData: function() {
    // datas from sessionstorage
    const json = window.sessionStorage.getItem(userService.userDataKey);

    // if connected there are datas
    if(json) {
      let currentUserData = JSON.parse(json);
      return currentUserData;
    }
    else {
    
      return false
    }
  },

  getCurrentUserId: function() {
    // datas from sessionstorage
    const json = window.sessionStorage.getItem(userService.userDataKey);

    // if connected there are datas
    if(json) {
      let currentUserData = JSON.parse(json);
      let currentUserId= currentUserData.id;
      return currentUserId;
    }
    else {
    
      return false
    }
  },

  getCurrentUserName: function() {
    // datas from sessionstorage
    const json = window.sessionStorage.getItem(userService.userDataKey);

    // if connected there are datas
    if(json) {
      let currentUserData = JSON.parse(json);
      let currentUserName= currentUserData.displayName;
      return currentUserName;
    }
    else {
    
      return false
    }
  },


  deleteCurrentUserData: function() {
   // deconnection if needed later
    window.sessionStorage.removeItem(userService.userDataKey);
    
  },

  updateCurrentUserInformations: function(newEmail,newPassword) {


    const currentUserData = userService.getCurrentUserData();
    // check: data existence
    if(currentUserData) {
      const userId = currentUserData.id;
      const token = currentUserData.token;

      // axios authentifies request
      return axios.post(
        userService.baseURI + '/wp-json/wp/v2/users/' + userId,
        {
          email: newEmail,
          password: newPassword
        },
        // give token to WP
        {
          headers: {
            Authorization: 'Bearer ' + token
          }
        }
      );
    }
  },

};

export default userService;


