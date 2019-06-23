<template>
    <div class="pizza-app">
        <transition name="fade">
            <router-view :user="user" :items="items"></router-view>
        </transition>
    </div>
</template>

<style lang="scss" scoped>
    .fade-enter-active {
        transition: all 0.5s ease-out;
    }
    .fade-enter, .slide-fade-leave-to {
        opacity: 0;
    }

    .pizza-app {
        min-height: 100vh;
    }
</style>

<script>
export default {
    components: {
       
    },
    props: ['user'],
    data() {
        return {
            items: this.$store.items.getters.getItems()
        }
    },
    created() {
        if (this.user) {
            this.$store.user.mutations.userUpdate(this.user)
        }
    },
    mounted() {
        this.$store.csrf.mutations
            .storeCsrfToken(document.querySelector('meta[name="csrf-token"]').getAttribute('value'))
    }
}
</script>
