<template>
  <div class="container">
        <p class="danger-message">Are you sure you want to delete your profile?</p>
        <form action="/user/delete" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" :value="this.$store.csrf.getters.getCsrfToken()">
            <input type="hidden" name="id" :value="id">
            <div class="form-group">
                <button class="button button-delete">Delete</button>
            </div>
        </form>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                id: this.$store.user.getters.getUser()[0].id,
            }
        }
    }
</script>

<style lang="scss" scoped>
    .danger-message {
        font-size: 22px;
    }
</style>

