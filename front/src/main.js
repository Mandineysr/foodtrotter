
// import de la bibliothèque dont nous avons besoin
import Vue from 'vue'

// main.js transfère à App.vue qui est notre application
import App from './App.vue'



//  ne pas oublier d'installer npm install vue-router dans front !!!
import VueRouter from 'vue-router'
Vue.use(VueRouter);

// ==============================
import VueLayers from 'vuelayers'
import 'vuelayers/lib/style.css' // needs css-loader
Vue.use(VueLayers)
Vue.use(VueLayers, {
    dataProjection: 'EPSG:4326',
})
// ==============================


let baseURI = '/';


if(document.location.toString().match(/localhost/)) {
  // si pas sur serveur de dev, mais en local,  configuration du base uri dans le dossier dist
  if(!document.location.toString().match(/localhost:/)) {
    baseURI = '/foodtrotter/projet-food-trotter-front/front/dist/';
  }
}
else {
  baseURI = '/projet-food-trotter-front/front/dist/'
}


// configuration of router
const router = new VueRouter({
  //router qui gère l'historique
  mode: 'history',
  // racine du site front
  base: baseURI,

  // configuration of routes
  routes: [
    // every route is an object
    
    {
      name: 'home', // name of the route
      path: '/', // matching url
      component: Home // show this component when the route is checked
    },

    {
      name: 'ingredients-list', // name of the route
      path: '/ingredients-list', // matching url
      component: IngredientsList // show this component when the route is checked
    },

    {
      name: 'newingredient', // name of the route
      path: '/newingredient', // matching url
      component: NewIngredient // show this component when the route is checked
    },

    {
      name: 'recipe',
      path: '/recipe/:id',
      component: Recipe
    },

    {
      name: 'recipeadventurer',
      path: '/recipeadventurer',
      component: RecipeAdventurer
    },

    {
      name: 'ingredients-list', // name of the route
      path: '/ingredients-list', // matching url
      component: IngredientsList // show this component when the route is checked
    },

    //===============================================================
    // pages de liste de recettes
    //===============================================================
    {
      name: 'recipeslist',
      path: '/recipeslist',
      component: RecipeList,
      props: {
        excludedTaxomony: 'recipe_type',
        excludedTermId: 46,
        title: 'Liste des recettes'
      }
    },

    {
      name: 'recipelistadventurer',
      path: '/recipelistadventurer',
      component: RecipeList,
      props: {
        taxonomy: 'recipe_type',
        id: 46,
        title: 'Recettes pour les courageux'
      }
    },

    {
      name: 'recipesByTerm',
      path: '/recipesByTerm/:taxonomy/:id',
      component: RecipeList,
      props: {
        excludedTaxomony: 'recipe_type',
        excludedTermId: 46,
        title: 'Liste des recettes'
      }
    },


    {
      name: 'userRecipe', // name of the route
      path: '/user/recipe', // matching url
      component: RecipeList,
      props: {
        searchType: 'byCurrentUser',
        title: 'Mes recettes'
      }
    },

    {
      name: 'searchRecipe', // name of the route
      path: '/search-recipe/:search', // matching url
      component: RecipeList,
      props: {
        searchType: 'byText',
        excludedTaxomony: 'recipe_type',
        excludedTermId: 46,
        title: 'Chercher des recettes'
      }
    },

    //===============================================================

    {
      name: 'Page404', // name of the route
      path: '*', // matching url
      component: Page404 // show this component when the route is checked
    },

    {
      name: 'Mention', // name of the route
      path: '/mention', // matching url
      component: Mention // show this component when the route is checked
    },

    {
      name: 'Team', // name of the route
      path: '/team', // matching url
      component: Team // show this component when the route is checked
    },

    {
      name: 'Plan', // name of the route
      path: '/plan', // matching url
      component: Plan // show this component when the route is checked
    },

    {
      name: 'ContactForm', // name of the route
      path: '/contactform', // matching url
      component: ContactForm // show this component when the route is checked
    },


    //=======================================================================

    {
      name: 'userHome', // name of the route
      path: '/user/home', // matching url
      component: UserHome // show this component when the route is checked
    },


    {
      name: 'userComment', // name of the route
      path: '/user/comment', // matching url
      component: UserComment // show this component when the route is checked
    },

    {
      name: 'userUpdate', // name of the route
      path: '/user/update', // matching url
      component: UserUpdate // show this component when the route is checked
    },
    //=======================================================================

    {
      name: 'login', // name of the route
      path: '/login', // matching url
      component: Login // show this component when the route is checked
    },

    {
      name: 'signup', // name of the route
      path: '/signup', // matching url
      component: SignUp // show this component when the route is checked
    },

    {
      name: 'recipe-create',
      path: '/recipe-create',
      component: AddRecipeForm
    },
  ]

});

// components used by the router
// NOT FORGET to import views's components, if not show
import Home from './views/Home.vue';
import Recipe from './views/Recipe.vue';
// import RecipesList from './views/RecipesList.vue';
import RecipeAdventurer from './views/RecipeAdventurer.vue';
// import RecipeListAdventurer from './views/RecipeListAdventurer.vue';
import IngredientsList from './views/IngredientsList.vue';


import Page404 from './views/Page404.vue';
import Mention from './views/Mention.vue';
import Team from './views/Team.vue';
import Plan from './views/Plan.vue';
import ContactForm from './views/ContactForm.vue';
import AddRecipeForm from './views/AddRecipeForm.vue';
import RecipeList from './views/RecipeList.vue';


import UserHome from './views/user/UserHome.vue';
// import UserRecipe from './views/user/UserRecipe.vue';
import UserComment from './views/user/UserComment.vue';
import UserUpdate from './views/user/UserUpdate.vue';


// import UserUpdate from './views/UserRecipe.vue';


import Login from './views/Login.vue';
import SignUp from './views/SignUp.vue';
import NewIngredient from './views/NewIngredient.vue'

/* import AddRecipeForm from './views/AddRecipeForm.vue'; */

import vuetify from './plugins/vuetify';

// options of configuration
Vue.config.productionTip = false

// creation of the application
new Vue({
    // injection of the router in the application vue
    router,

    vuetify,
    render: h => h(App)
}).$mount('#app');
