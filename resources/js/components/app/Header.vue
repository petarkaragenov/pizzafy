<template>
    <header class="main-header flex-center position-ref full-height">
        <div class="main-header-nav">
            <div class="container">
                <router-link v-if="this.$store.user.state.data.length !== 0" to="/" class="main-header-nav-item">
                    <i class="fas fa-home fa-2x"></i>
                    <span>Home</span>
                </router-link>

                <router-link to="/profile/orders" v-if="this.$store.user.state.data.length !== 0" class="main-header-nav-item">
                    <i class="fas fa-user-circle fa-2x"></i>
                    <span>Profile</span>
                </router-link>
                <router-link to="/cart" v-if="this.$store.user.state.data.length !== 0" class="main-header-nav-item cart">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                    <span>Cart</span>
                    <span v-if="this.$store.user.state.data.length !== 0" class="cart-quantity">{{ itemsQuantity }}</span>
                </router-link>

                <a v-if="this.$store.user.state.data.length !== 0" href="/logout" @click.prevent="handleOnSubmit" class="main-header-nav-item">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
                    <span>Logout</span>
                </a>
                <form ref="logout" action="logout" method="POST" style="display: none;">
                    <input type="hidden" name="_token" :value="csrf">
                </form>
                <a v-if="this.$store.user.state.data.length  === 0" href="/login">Login</a>
                <a v-if="this.$store.user.state.data.length === 0" href="/register">Register</a>
            </div>
        </div>

        <div class="main-header-message">
            <div class="heading">
                <h1>Have a break - Have a Pizza</h1>
            </div>
            <div class="subheading">
                <h2>Hot Pizza delivery 24/7 right before your door step</h2>
            </div>
        </div>    
    </header>
</template>

<script>
export default {
    data() {
        return {
            csrf: this.$store.csrf.getters.getCsrfToken()
        }
    },
    computed: {
        itemsQuantity() {
            return this.$store.items.state.data.length
        }
    },
    methods: {
        handleOnSubmit() {
            this.$refs.logout.submit()
        }
    }
}
</script>


<style lang="scss" scoped>
    .main-header {
        background-image: url('/storage/pizza-header.jpg');
        background-size: cover;
        height: 400px;
        margin-bottom: 20px;
        filter: grayscale(25%);

        &::after {
            display: block;
            position: relative;
            background: radial-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.9));
            height: 400px;
            width: 100%;
            content: '';
        }

        .main-header-nav {
            position: absolute;
            width: 100%;
            z-index: 2;
            top: 0;
            left: 0;
            padding: 12px;
            color: white;

            .container {
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: flex-end;
            }

            a {
                margin: 0 8px;

                &:hover {
                    color: darken(#fff, 10%);
                }
            }

            .main-header-nav-item {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .cart {
                position: relative;

                .cart-quantity {
                    position: absolute;
                    top: -5px;
                    left: 80%;
                    background: #1cbf2c;
                    border-radius: 50%;
                    height: 16px;
                    width: 16px;
                    text-align: center;
                    line-height: 16px;
                    font-size: 14px;
                }
            }
        }

        .main-header-message {
            position: absolute;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            top: 60%;
            left: 0;
            text-transform: uppercase;
            z-index: 2;

            .heading h1 {
                font-family: 'Amatic SC', cursive !important;
                font-weight: 700;
                font-size: 72px;
                color: white;
            }

            .subheading h2 {
                font-size: 22px;
                color: white;
            }
        }
    }
</style>

