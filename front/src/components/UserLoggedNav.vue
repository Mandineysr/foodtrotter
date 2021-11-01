<template>
    <div>
        <!-- menu ecran marge ou plus //-->
        <v-toolbar class="hidden-md-and-down">
            <v-tabs>
                <v-toolbar-title> 
                    <v-avatar size="60">
                        <v-img src="../assets/adventurer.png"></v-img>
                    </v-avatar>
                     Salut {{currentUser.displayName}}
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items >
                    <v-tab>
                        <router-link :to="{name: 'recipe-create'}">
                            Ajouter une recette
                        </router-link>
                    </v-tab>
                    <v-tab>
                        <router-link :to="{name: 'newingredient'}">
                            Ajouter un ingrédient
                        </router-link>
                    </v-tab>
                    <v-tab>
                        <router-link :to="{name: 'userRecipe'}">
                            Mes Recettes
                        </router-link>
                    </v-tab>
                    <v-tab>
                        <router-link :to="{name: 'userComment'}">
                            Mes Commentaires
                        </router-link>
                    </v-tab>
                    <v-tab>
                       <router-link :to="{name: 'userUpdate'}">
                            Modifier mes informations
                        </router-link>
                    </v-tab>
                    <v-tab @click="disconnect" id="disconnect">
                        Se déconnecter
                    </v-tab>
                </v-toolbar-items>
            </v-tabs>
        </v-toolbar>

        <!-- menu ecran moyen ou plus petit //-->
        <v-toolbar class="hidden-lg-and-up">
            <v-toolbar-title>
                <v-avatar size="60">
                    <v-img src="../assets/adventurer.png"></v-img>
                </v-avatar>
                Salut {{currentUser.displayName}}
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu bottom left>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn dark icon v-bind="attrs" v-on="on">
                        <v-icon color="red" large>
                        mdi-plus</v-icon>
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item>
                        <v-list-item-title>
                            <router-link :to="{name: 'newingredient'}">
                                Ajouter un ingrédient
                            </router-link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>
                            <router-link :to="{name: 'recipe-create'}">
                                Ajouter une recette
                            </router-link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>
                            <router-link :to="{name: 'userRecipe'}">
                                Mes recettes
                            </router-link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>
                            <router-link :to="{name: 'userComment'}">
                                Mes commentaires
                            </router-link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>
                            <router-link :to="{name: 'userUpdate'}">
                                Modifier mes informations
                            </router-link>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="disconnect">
                        <v-list-item-title id="disconnect">Se déconnecter</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-toolbar>
    </div>
</template>

<script>
import userService from '../services/userService.js';
export default {
    props: [
        'currentUser'
    ],
    methods: {
      disconnect: function (event) {
        event.preventDefault();
        this.$emit('disconnect');

        userService.deleteCurrentUserData();
        this.currentUser = false;
        this.$router.push({
          name: 'home'
        });
      },
    },
}


</script>

<style lang="scss">

.v-avatar{
    color:pink;
}

a { 
    text-decoration: none; 
}

#disconnect {
    color: red;
}

</style>