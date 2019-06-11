<<template>
  <div class="invalid-feedback" role="alert">
    <span v-for="message in error">
      <strong>{{ message }}</strong>
    </span>
  </div>
</template>

<script>
  export default {
    props: [
      'error'
    ]
  }
</script>
