<template>
    <v-card>
        <div v-html="comment.content.rendered"></div>
        <aside class="author">Posté par {{comment.author_name}}</aside>
    </v-card>

</template>


<script>

export default{

    props: {
        comment: Object
    }
}

</script>

<style scoped lang="scss">
.author {
  font-style: italic;  
}

</style>