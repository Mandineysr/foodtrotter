<template>
  <v-container class="pa-4 text-center">
    <v-row class="fill-height" align="center" justify="center">
      <template v-for="(item, i) in items">
        <v-col :key="i" cols="12" md="4">
              <v-img :src="item.img" height="225px">
                <v-card-title class="title #CCFF00--text">
                  <v-row class="flex-column" justify="space-around">
                    <p class="mt-4 subheading text-left yellow--text">
                      {{ item.title }}
                    </p>
                    <p class="ma-0 body-1 font-weight-bold font-italic text-left yellow--text">
                      {{ item.text }}
                    </p>
                    <div class="align-self-center">
                      <v-btn
                        v-for="(icon, index) in icons"
                        :key="index"
                        :class="{ 'show-btns': hover }"
                        :color="transparent"
                        icon
                      >
                        <v-icon
                          :class="{ 'show-btns': hover }"
                          :color="transparent"
                        >
                          {{ icon }}
                        </v-icon>
                      </v-btn>
                    </div>
                  </v-row>
                </v-card-title>
              </v-img>
        </v-col>
      </template>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    items: [
      {
        title: "Vanessa",
        text: `Référente Tech Git`,
        img:
          "https://ca.slack-edge.com/T01EAURCR9B-U01FPK2QRQ9-b44d7342a395-512",
      },
      {
        title: "Amandine",
        text: "Lead Developer",
        img:
          "https://ca.slack-edge.com/T01EAURCR9B-U01F4AECCTY-d5f734bfffb0-512",
      },
      {
        title: "Frédéric",
        text: "Référent Techno",
        img: "https://zupimages.net/up/21/18/5c4j.png",
      },
      {
        title: "Arnaud",
        text: "Product Owner",
        img:
          "https://ca.slack-edge.com/T01EAURCR9B-U01J06FGMUJ-23016cbf17f0-512",
      },
      {
        title: "Gaël",
        text: "Scrum Master",
        img:
          "https://ca.slack-edge.com/T01EAURCR9B-U01G10SC6C8-ae6d2e90c9e8-512",
      },
    ],
  }),
};
</script>

<style lang="scss">


</style>