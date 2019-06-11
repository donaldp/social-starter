<template>
  <div class="card shadow-sm" style="margin: 15px 0">

    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
          <div class="mr-2">
            <img class="rounded-circle" width="45" :src="post.user.gravatar" alt="">
          </div>
          <div class="ml-2">
            <div class="h7 text-muted">{{ post.user.name }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="text-muted h7 mb-2">
        <vue-moments-ago prefix="" suffix="ago" :date="post.created_at"></vue-moments-ago>
      </div>

      <p class="card-text">
        {{ post.body }}
      </p>
    </div>

  </div>
</template>

<script>
  import VueMomentsAgo from 'vue-moments-ago';

  export default {
    props: [
      'post'
    ],
    components: {
      VueMomentsAgo
    }
  }

</script>
