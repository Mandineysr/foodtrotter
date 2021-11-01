<template>
    <div class="my-4">
        <v-row justify="center">
            <form @submit="sendComment">
                <h3>Lâches un com' :</h3>
                    <fieldset>
                        <textarea v-model="comment"></textarea>
                    </fieldset>
                        <v-btn class="ma-8">
                            Commenter
                        </v-btn>
            </form>
        </v-row>
    </div>
</template>

<script>
import commentsService from '../services/commentsService.js';

export default ({

    data: function() {
        return  {
            comment: ''
        }
    },

    props: {
        recipeId: Number,
    },

    methods: {
        sendComment: function(event) {

            // interdiction du comportement par défaut
            event.preventDefault();

            // envoie du commentaire en utlisant le service commentService
            commentsService.postComment(
                this.recipeId,
                this.comment
            ).then(comment => {
                // IMPORTANT $emit : envoie d'un événement
                // DOC $emit https://vuejs.org/v2/guide/components-custom-events.html
                // nous envoyons un événement que nous nommons "commentPosted". Cet événement "stocke" le nouveau commentaire
                this.$emit('commentPosted', comment);
            });
        }
    }
})
</script>


<style scoped lang="scss">

fieldset {
    width: 400px;
    height: 100px;
}
</style>
