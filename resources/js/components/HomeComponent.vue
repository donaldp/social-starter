<template>
  <div class="col-md-6 mx-auto">

    <sequential-entrance animation="bounceIn">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="form-group">
            <label class="sr-only" for="message">post</label>

            <textarea
              :class="errors.message.length > 0 ? 'form-control is-invalid' : 'form-control'"
              id="message"
              v-model="message"
              rows="3"
              placeholder="Share something..."
            ></textarea>
            <error-messages :error="errors.message"></error-messages>
          </div>

          <div class="btn-toolbar justify-content-between">
            <div class="btn-group">
              <button @click="addPost" class="btn btn-primary">post</button>
            </div>
          </div>
        </div>
      </div>
    </sequential-entrance>

    <sequential-entrance fromRight>
      <div v-for="(post, index) in posts" :key="index">

        <message-card :post="post"></message-card>

      </div>
    </sequential-entrance>

  </div>
</template>

<script>
  import { loadProgressBar } from 'axios-progress-bar';
  import 'axios-progress-bar/dist/nprogress.css';

  import 'animate.css';

  import MessageCard from './MessageCard';
  import ErrorMessages from './ErrorMessages';

  /**
   * Load progress bar
   */
  loadProgressBar();

  export default {
    components: {
      MessageCard,
      ErrorMessages
    },
    mounted() {
      console.log('Component mounted.');
      this.getPosts();
    },
    data() {
      return {
        posts: [],
        message: '',
        errors: {
          message: []
        },
        fetch: true
      }
    },
    methods: {
      /**
       * Get posts
       */
      getPosts() {
        let self = this;

        axios
          .get('/post/all')
          .then((response) => {
            self.posts = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      },
      /**
       * Add a new post
       */
      addPost() {
        let self = this;

        axios
          .post('/post/add', {
            message: this.message
          })
          .then((response) => {
            self.posts = [response.data.post].concat(self.posts);

            self.errors = { message: [] };

            self.message = '';
          })
          .catch(error => {
            self.errors = error.response.data.errors;
          });
      },
      /**
       * Auto load new artists whenever the scroll reaches the end of the page.
       *
       * @param Event e
       */
      handleScroll: function (e) {
        if (
          this.fetch &&
          (e.target.scrollingElement.scrollTop + e.target.scrollingElement.clientHeight == e.target.scrollingElement.scrollHeight)
        ) {
          this.getOlderPosts(this.posts.slice(-1)[0].id);
        }
      },
      /**
       * Get older posts (a bit buggy)
       *
       * @param {number} id
       */
      getOlderPosts(id) {
        let self = this;

        axios
          .get('/post/fetch?id=' + id)
          .then((response) => {
            if (response.data.length == 0) {
              return self.fetch = false;
            }

            self.posts = self.posts.concat(response.data);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    created() {
      window.addEventListener('scroll', this.handleScroll);
    },
    destroyed() {
      window.removeEventListener('scroll', this.handleScroll);
    }
  }

</script>
