
<template>

    <div class="d-flex flex-line justify-center align-stretch">
        <div class="mt-10 mb-10 d-none d-lg-block">
       
       <v-hover
       v-slot="{ hover }"
       open-delay="200"
       >
        <v-card
        :elevation="hover ? 16 : 2"
        :class="{ 'on-hover': hover}"
        class="mx-auto"
         max-height= "800"
        max-width= "500"
        >
        <v-img
        max-height= "800"
        max-width= "400"
       src= "../assets/images/signin.jpg"
        ></v-img>
        </v-card>
       </v-hover>

        </div>

         <div class="ml-5">
             <div class="error"> {{emailError}}</div>
             <div class="error"> {{passwordError}}</div>
            <v-form 
            ref="form"
            v-model="valid"
            lazy-validation
            >


            <v-text-field
                v-model="username"
                label="Pseudo"
                required
                ></v-text-field>   

            <v-text-field
                v-model="email"
                label="Email"
                required
                ></v-text-field>   

             <v-text-field
                v-model="password"
                label="Mot de Passe"
                required
                ></v-text-field>

            <v-text-field
                v-model="passwordConfirmation"
                label="Confirmation du Mot de Passe"
                required
                ></v-text-field>

            <v-btn
            :disabled="!valid"
            color= light-green darken-4
            class="mr-4"
            @click="signup"
            >
            Rejoindre l'aventure
            </v-btn>
            </v-form>
        </div>
       



    </div>
</template>



<script>

import userService from "../services/userService.js";

export default {
 methods: {
 signup: function(event) {

            event.preventDefault();
            const email = this.email;
            const regexp = /^(.+?)@(.+?)\.(.+?)$/;
            const isEmail = email.match(regexp);

            if(email.length === 0 ) {
                this.emailError = "Vous n'avez pas saisi d'email";
            }
            else if(!isEmail) {
                this.emailError = "Un email c'est comme une recette, il y faut tous les ingrédients";
            }
            else {
                this.emailError = "";
            }

            if(this.passwordConfirmation !== this.password) {
                this.passwordError = 'Vous avez saisi deux mots de passe différents'
            }
            else {
                this.passwordError = '';
            }

            // si pas d'erreurs, envoie des données à l'api ocooking
            if(!this.emailError && !this.passwordError) {
                this.sendData();
            }
        },


        sendData: function() {
            console.log('Sending data to server');
            userService.signup(
                this.username,
                this.email,
                this.password
            ).then(result => {
                console.log('%c' + "Resultat de l'inscription", 'color: #0bf; font-size: 1rem; background-color:#fff');
                console.log(result);
                this.$router.push({
                name: 'login'
                        });
            });
        },
    },

    data: function() {
        return {
            username:'',
            email: '',
            password: '',
            emailError: null,
            passwordError: null,
            passwordConfirmation: null
        }
    },   
}
</script>

<style lang="scss">

</style>