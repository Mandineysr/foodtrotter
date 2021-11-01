<template>
  <h1 class="mt-5 text-align-center">
    Tu es bien connecté !
  </h1>


</template>

<script>
  // import RecipesListByAuthor from '../../components/RecipesListByAuthor';
  // import CommentListByAuthor from '../../components/CommentListByAuthor';
  import userService from '../../services/userService'


  export default {
    components: {
      // RecipesListByAuthor,
      // CommentListByAuthor

    },

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
      isDisplayBackgroundImage: true,
      isDisplayRecipes: false,
      isDisplayComments: false,
      isDisplayUserModification: false,

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
      myrecipies: function () {
        this.isDisplayRecipes = !this.isDisplayRecipes;
        this.isDisplayComments = false;
        this.isDisplayUserModification = false;
        this.isDisplayBackgroundImage = false;
      },
      mycomments: function () {
        this.isDisplayComments = !this.isDisplayComments;
        this.isDisplayRecipes = false;
        this.isDisplayUserModification = false;
        this.isDisplayBackgroundImage = false;
      },
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
          name: 'login'
        });
      },

      disconnect: function (event) {
        event.preventDefault();
        userService.deleteCurrentUserData();
        this.currentUser = false;
        this.$router.push({
          name: 'home'
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

<style lang="scss">


</style>