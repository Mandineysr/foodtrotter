
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
        max-width= "150"
        >
        <v-img
        max-height= "800"
        max-width= "150"
       src= "../assets/images/login.jpg"
        ></v-img>
        </v-card>
       </v-hover>

        </div>

         <div class="ml-5">
        <div class="error"> {{emailError}}</div>
        <div class="error"> {{passwordError}}</div>
        <div class="error"> {{loginError}}</div>
            <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            >

            <v-text-field

                v-model="email"
                label="Email"
                required
                ></v-text-field>

             <v-text-field
                v-model="password"
                label="Mot de Passe"
                :value="myPass"
                :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
                :type="value ?  'text':'password'"
                @click:append="() => (value = !value)"
                required
                ></v-text-field>

            <v-btn
            :disabled="!valid"
            color= light-green darken-4
            class="mr-4"
            @click="login"
            >
            Se connecter
            </v-btn>
            </v-form>
        </div>




    </div>
</template>


<script>

import userService from "../services/userService.js";

export default {

  methods: {
        login: function(event) {

            event.preventDefault();

          // email first control
            const email = this.email;
            const password = this.password;
         // regexp: something at the chain start, need a @, another string, need a point
            const regexp = /^(.+?)@(.+?)\.(.+?)$/;
            const isEmail = email.match(regexp);

            if(email.length === 0 ) {
                this.emailError = "Veuillez saisir un email";
            }
            else if(!isEmail) {
                this.emailError = "Nos recettes sont originales mais pas autant que votre email";
            }
            else if(password.length ===0){
               this.passwordError = "Veuillez saisir un mot de passe";
            }
            else {
                this.emailError = "";
            }
            if(!this.emailError && !this.passwordError) {
               this.authentification(
                    this.email,
                    this.password
               );
            }
        },

        // authentification step
        authentification: function(email, password) {

            userService.getToken(email, password)
                .then(userData => {
                    console.log(userData);
                    if(userData) {
                        this.$emit('userConnected', userData);
                        this.$router.push({
                            // IMPORTANT when the private-home will be defined, need to rewrite the name here
                            name: 'userHome'
                        });
                    }
                    else {
                        this.loginError = "Vos identifiants sont incorrects";
                    }
                }
            );
        }
    },

    data: function() {
        return {
            email: '',
            password: '',
            emailError: null,
            passwordError: null,
            loginError: null,
        }
    },
}
</script>

<style lang="scss">

</style>