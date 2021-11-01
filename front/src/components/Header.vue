<template>
    <header>

            <UserLoggedNav  v-if="currentUser" :currentUser="currentUser" @disconnect="disconnect"/>
        <div v-else style="position: absolute; right: 1rem; top: 1rem">
            <UserNav :currentUser="currentUser"/>
        </div>
        <v-img
            class="mx-auto my-8"
            max-width="200"
            src="../assets/images/logo.png"
        >
        </v-img>
        <v-row class="mt-6 mb-6">
                <v-col id="boutons-header">
                    <nav class="d-flex flex-grow-1 justify-center">
                        <router-link :to="{name: 'home'}">
                            <v-btn color="" class="mx-3" outlined large id="btns-header">
                            Accueil
                            </v-btn>
                        </router-link>

                        <router-link :to="{name: 'recipeslist'}">
                            <v-btn color="" class="mx-3" outlined large id="btns-header">
                                Recettes
                            </v-btn>
                        </router-link>
                        <router-link :to="{name: 'ingredients-list'}">
                            <v-btn color="" class="mx-3" outlined large id="btns-header">
                                Ingrédients
                            </v-btn>
                        </router-link>

                    <span v-if="currentUser">
                        <v-btn color="red" class="mx-3" outlined large>
                            <v-icon id="plus" class="pr-3">mdi-earth-plus</v-icon>
                                <router-link :to="{name: 'recipelistadventurer'}" id="btns-header">
                                    Aventurier
                                </router-link>
                        </v-btn>
                    </span>
                </nav>
            </v-col>
      </v-row>
     <!--
         Moteur de Recherche fonctionnel

      <v-row>
          <v-col>
              <form @submit="searchRecipes">
                <v-text-field
                    label="Chercher"
                    solo
                    v-model="search"
                ></v-text-field>
                <button>Chercher</button>
              </form>
            
          </v-col>
      </v-row>
-->
    </header>
</template>


<script>

import userService from '../services/userService.js';
import UserNav from './UserNav.vue';
import UserLoggedNav from './UserLoggedNav.vue';

  export default {
    components: {
        UserNav,
        UserLoggedNav
    },

    methods: {
        disconnect: function() {
            this.currentUser = false;
            this.$emit('disconnect');
        },
/*
Methods pour moteur de recherche

            searchRecipes(event) {
            event.preventDefault();

            this.$router.push({
                name: 'searchRecipe',
                params: {
                    search: this.search
                }
                
            });

        }
*/
    },

    created: function() {

        this.currentUser = userService.getCurrentUserData();
    },

    watch: {
        publicCurrentUser: function(publicCurrentUserBeforeChange, publicCurrentUserAfterChange) {

            console.log('%c' + "Component header updated", 'color: #fff; font-size: 1rem; background-color:#f00');
            console.log('Prop changed: ', publicCurrentUserBeforeChange, ' | was: ', publicCurrentUserAfterChange);

            this.currentUser = this.publicCurrentUser;
        }
    },

    props: [
        // current user est envoyé par App.vue
        'currentUser'
    ],
    /*
    data() {
        return {
            search: ''
        }
    }
*/
}


</script>


<style lang="scss">

.avatar {
    margin: 20px;
}

#plus {
    color: yellow;
}

#btns-header {
    color: #F25860;
    font-family: 'Lovelo';
    text-shadow: 2px 2px 2px red;
    font-weight: 700;
    color: white;
}

a {
    text-decoration: none; 
}

@font-face {
    font-family: Lovelo;
    src: url('../assets/Lovelo/WEB/Lovelo-LineBold.eot');
    src: url('../assets/Lovelo/WEB/Lovelo-LineBold.eot?#iefix') format('embedded-opentype'),
    url('../assets/Lovelo/WEB/Lovelo-LineBold.woff2') format('woff2'),
    url('../assets/Lovelo/WEB/Lovelo-LineBold.woff') format('woff'),
    url('../assets/Lovelo/TTF/Lovelo-LineBold.ttf') format('truetype');
}

</style>
