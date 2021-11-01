<template>
    <div class="d-flex flex-column">
        <nav id="login" class="align-center mr-5 mt-16">
            <v-chip v-if="!currentUser" class="ma-2" color="white" text-color="white" regular :elevation="hover ? 24 : 6">
                <router-link :to="{name: 'login'}">Se connecter</router-link>
            </v-chip>
            <v-chip v-if="!currentUser" class="ma-2" color="white" text-color="white" regular elevation="5">
                <router-link :to="{name: 'signup'}">S'inscrire</router-link>
            </v-chip>
        </nav>
    </div>
</template>


<script>
    export default {
        props: [
            'currentUser'
        ]

    }
</script>