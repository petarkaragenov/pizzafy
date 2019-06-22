<template>
    <div class="pizza-store-container">
        <div class="container success-container">
            <div class="jumbotron" v-if="messages">
                <h1 class="display-4">Thank you for Your Purchase!</h1>
                <p class="lead">{{ messages[0].first }}</p>
                <hr class="my-4">
                <p>{{ messages[0].second }}</p>
                <p class="lead">
                    <router-link to="/" class="button button-order" role="button" @click="emptyMessagesArray">
                        <i class="fas fa-home"></i>
                        Home
                    </router-link>
                </p>
            </div>
        </div>
        <Footer />
    </div>
</template>

<script>
import Footer from './Footer.vue';
export default {
    components: {
        Footer
    },
    data() {
        return {
            messages: null,
        }
    },
    methods: {
        emptyMessagesArray() {
            this.$store.messages.mutations.emptyMessagesArray();
            this.messages = null;
        }
    },
    mounted() {
        this.messages = this.$store.messages.getters.getMessages();
    }
}
</script>

<style lang="scss" scoped>
    .success-container {
        margin-top: 20px;
        flex: 1;
    }
    .pizza-store-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
</style>
