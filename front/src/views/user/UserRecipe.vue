<template>

  <div class="mt-5">
    <div>
      <RecipesListByAuthor />
    </div>
  </div>

</template>

<script>
import RecipesListByAuthor from '../../components/RecipesListByAuthor';

export default {
    components: {
      RecipesListByAuthor,
    },
  }
</script>
