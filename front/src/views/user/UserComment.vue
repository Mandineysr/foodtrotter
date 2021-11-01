<template>
  <div class="mt-5">
    <div>
      <CommentListByAuthor />
    </div>
  </div>
</template>

<script>

import CommentListByAuthor from '../../components/CommentListByAuthor';
//import userService from '../../services/userService'


  export default {
    components: {
      CommentListByAuthor
    },
  }
</script>
