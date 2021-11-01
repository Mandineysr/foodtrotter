<template>
  <v-form v-model="valid">
    <h1>Bienvenue sur le Formulaire de Contact</h1>

    <v-img
      max-height="200"
      max-width="200"
      src=""
    ></v-img>
    <v-row>
      <v-col cols="12" md="4">
        <v-text-field
          v-model="name"
          :rules="nameRules"
          label="Votre Nom"
          required
        ></v-text-field>
      </v-col>
      <v-col cols="12" md="4">
        <v-text-field
          v-model="surname"
          :rules="surnameRules"
          label="Votre Prénom"
          required
        ></v-text-field>
      </v-col>
      <v-col cols="12" md="4">
        <v-text-field
          v-model="Email"
          :rules="emailRules"
          label="Votre Email"
          required
        ></v-text-field>
      </v-col>
      <v-col cols="12" md="">
        <v-textarea name="input-7-1" label="Votre demande"></v-textarea>
      </v-col>
    </v-row>

    <div id="app">
      <v-row justify="center">
        <v-dialog v-model="dialog" width="600px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn @click="addperson" dark v-bind="attrs" v-on="on">
              Envoyer votre commentaire
            </v-btn>
          </template>
          <v-card id="card">
            <v-card-title>
              <span class="headline">Merci pour votre commentaire,</span>
            </v-card-title>

            <v-card-text id="text">
              <p>{{ name }} {{ surname }}</p>
              Nous vous répondrons dans les meilleurs délais.
            </v-card-text>
            <v-card-actions>
              <v-btn href="/" text @click="dialog = false">
                Visiter le site
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </div>
    <br />
  </v-form>
</template>

<script>
export default {
  data: () => ({
    return: {
      person: [],
      dialog: false,
    },
    valid: false,
    firstname: "",
    nameRules: [
      (v) => !!v || "Un nom est requis",
      (v) => v.length <= 10 || "Voter nom doit etre de plus de 10 caractères.",
    ],
    lastname: "",
    surnameRules: [
      (v) => !!v || "Votre prénom est requis",
      (v) => v.length <= 10 || "Name must be less than 10 characters",
    ],
    email: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+/.test(v) || "E-mail must be valid",
    ],
  }),
  props: ["name", "surname"],
  methods: {
    addperson() {
      this.person.push({
        name: this.name,
        surname: this.surname,
      });
    },
    reset() {
      this.$refs.form.reset();
    },
  },
  mounted() {
    this.person.push({
      name: this.name,
      surname: this.surname,
    });
  },
};
</script>

<style scoped>
</style>


