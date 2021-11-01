<template>
    <v-app>
      <div class="bg-image">
          <Header :currentUser="currentUser" @disconnect="disconnect"></Header>
          <router-view :key="$route.fullPath" :currentUser="currentUser" @userConnected="connected"/>
          <Footer></Footer>
      </div>
    </v-app>

</template>
 

<script>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import userService from './services/userService.js';

export default {
  name: 'App',

  components: {
    Header,
    Footer,
  },

	data: () => ({
    isMobile: false,
    currentUser: null
  }),

  created() {
    this.currentUser = userService.getCurrentUserData();
  },

  beforeDestroy () {
    if (typeof window === 'undefined') return
    window.removeEventListener('resize', this.onResize, { passive: true })
  },
  mounted () {
    this.onResize()
    window.addEventListener('resize', this.onResize, { passive: true })
  },
  methods: {
    onResize () {
      this.isMobile = window.innerWidth < 600
    },

    connected(userData) {
      console.log('connected');
      console.log(userData);
      this.currentUser = userData;
    },

    disconnect() {
      this.currentUser = false;
    }
  },
}
</script>

<style lang="scss">

.bg-image {
    background-image: url(./assets/images/food-2879265_1920.jpg);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    height: 100%;
}

body {
    margin: auto;
}

</style>

