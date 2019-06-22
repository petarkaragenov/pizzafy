<template>
    <div class="pizza-app">
        <transition name="slide-fade">
            <router-view :user="user" :items="items"></router-view>
        </transition>
    </div>
</template>

<style lang="scss" scoped>
    .slide-fade-enter-active {
        transition: all 0.4s ease-out;
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(100%);
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
