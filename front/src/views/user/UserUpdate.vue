<template>
    <div class="mt-5">
        <div class="d-flex flex-line justify-center align-stretch">
            <div class="mt-8 mb-8">
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field 
                        v-model="newEmail" 
                        :rules="emailRules" 
                        label="E-mail actuel ou Nouvel E-mail"
                        placeholder="Nouvel Email" 
                        required
                    >
                    </v-text-field>
                    <v-text-field 
                        v-model="newPassword" 
                        :rules="passwordRules" 
                        label="Mot de passe"  
                        placeholder="Mot de passe"
                        required
                    >
                    </v-text-field>
                    <v-text-field 
                        v-model="passwordConfirmation" 
                        :rules="passConfirmationRules.concat(passwordConfirmationRules)"
                        label="Confirmation du mot de passe" 
                        placeholder="Confirmation du mot de passe" 
                        required
                    >
                    </v-text-field>
                    <v-btn 
                        :disabled="!valid" 
                        color="warning" 
                        class="mr-4" 
                        @click="updateData"
                    >
                        Validate
                    </v-btn>
                    <v-btn 
                        color="succes" 
                        class="mr-4" 
                        @click="reset"
                    >
                        Effacer les saisies
                    </v-btn>
                </v-form>
            </div>
        </div>
  </div>
</template>

<script>
  
import userService from '../../services/userService'

export default {

    created() {
      const userName = userService.getCurrentUserName();
      this.userName = userName;
    },

    computed: {
      passwordConfirmationRules() {
        return () => (this.newPassword === this.passwordConfirmation) || 'Vous avez saisi deux mots de passe différents'
      },
    },

    data: () => ({
      selectedItem: 0,
      valid: true,
      
      newEmail: '',
      emailRules: [
        v => !!v || 'Un email est requis',
        v => /.+@.+\..+/.test(v) || 'L\'email soit être valide',
      ],

      newPassword: '',
      passwordRules: [
        v => !!v || 'Un mot de passe est obligatoire',
      ],
      passwordConfirmation: '',
      passConfirmationRules: [
        v => !!v || 'Un mot de passe est obligatoire',
      ],

      checkbox: false,
    }),


    methods: {
      usermodification: function () {
        this.isDisplayUserModification = !this.isDisplayUserModification;
        this.isDisplayComments = false;
        this.isDisplayRecipes = false;
        this.isDisplayBackgroundImage = false;
      },

      updateData: function (event) {
        event.preventDefault();
        userService.updateCurrentUserInformations(this.newEmail, this.newPassword);


        this.$router.push({
          name: 'userHome'
        });

      },

      validate() {
        this.$refs.form.validate()
      },
      reset() {
        this.$refs.form.reset()
      },

    },
  }
</script>
