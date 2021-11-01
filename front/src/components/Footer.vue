<template>
    <footer>
         <div align="center" justify="space-around" id="boutons-footer" class="mt-16">
            <router-link :to="{name: 'Mention'}">
                <v-btn large class="mx-3" outlined id="btns-footer">
                    Mentions Légales
                </v-btn>
            </router-link>
            <router-link :to="{name: 'ContactForm'}">
                <v-btn large class="mx-3" outlined id="btns-footer">
                    Contacts
                </v-btn>
            </router-link>
            <router-link :to="{name: 'Plan'}">
                <v-btn large class="mx-3" outlined id="btns-footer">
                    Plan Du Dite
                </v-btn>
            </router-link>
            <router-link :to="{name: 'Team'}">
                <v-btn large class="mx-3" outlined id="btns-footer">
                    Notre Equipe
                </v-btn>
            </router-link>
        </div>
            <div align="center" class="my-8">
                <p>Copyright © 2021 Food Trotter - Tous droits réservés</p>
            </div>
    </footer>
</template>

<style lang="scss">

#btns-footer {
    color: #F25860;
    font-family: 'Lovelo';
    text-shadow: 2px 2px 2px red;
    font-weight: 700;
    color: white;
}

a { 
    text-decoration: none; 
}

</style>
