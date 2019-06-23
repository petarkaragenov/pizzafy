<template>
    <div class="cart-container">
        <div v-show="!pay" class="loading-modal">
            <img src="/storage/loading.gif" alt="Loading">
        </div>
        <Header />
            <div class="container cart-items">
                <table class="table" v-if="items">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Single Price</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id">
                            <td><img :src="item.imageURL" :alt="item.name" width="100"></td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.price }}</td>
                            <td>${{ item.total }}</td>
                            <td><i @click="removeFromCart(items.indexOf(item))" class="close fas fa-times-circle fa-2x"></i></td>
                        </tr>
                    </tbody>
                </table>
                <div class="total-price">
                    <span>Total Price:</span>
                    <span>${{ totalPrice }}</span>
                </div>
                <vue-stripe-checkout
                    ref="checkoutRef"
                    :name="this.$store.user.getters.getUser()[0].name"
                    :email="this.$store.user.getters.getUser()[0].email"
                    :currency="currency"
                    :amount="totalPrice*100"
                    :allow-remember-me="true"
                    @done="done"
                    @open="open"
                    @close="close"
                ></vue-stripe-checkout>
                <div class="controls">
                    <router-link to="/" class="button button-order">
                        <i class="fa fa-angle-left"></i>
                        Back
                    </router-link>
                    <button :disabled="!pay" :class="{ disabled: !pay }" class="button button-success" @click="checkout">
                        <span v-if="pay">
                            Proceed to Payment
                            <i class="fa fa-angle-right"></i>
                        </span>
                        <span v-if="!pay">Loading... 
                            <img src="/storage/loading.gif" width="16" alt="Loading">
                        </span>
                    </button>
                </div>
            </div>
        <Footer />
    </div>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';
export default {
    components: {
        Header, Footer
    },
    props: ['items'],
    data() {
        return {
            totalPrice: 0,
            currency: 'USD',
            pay: true,
            progress: 0
        }
    },
    computed: {
        orderItems() {
            return this.items.map(item => {
                return { parent: item.sku, quantity: item.quantity, type: 'sku' }
            });
        }
    },
    methods: {
        removeFromCart(id) {
            this.$store.items.mutations.removeItem(id);
            if (this.items.length === 0) {
                this.$router.push('/');
            }
        },
        async checkout () {
            const { token, args } = await this.$refs.checkoutRef.open();
            this.pay = false
        },
        done ({token, args}) {
            const formData = new FormData();
            formData.append('items', JSON.stringify(this.items));
            formData.append('orderItems', JSON.stringify(this.orderItems));
            formData.append('token', JSON.stringify(token));
            formData.append('user', JSON.stringify(this.$store.user.getters.getUser()[0]));
            formData.append('totalPrice', this.totalPrice);
            axios({
                method: 'post',
                url: '/api/charge',
                data: formData
            })
                .then(res => {
                    this.$router.push('/success');
                    this.$store.messages.mutations.storeMessages(res.data);
                    this.$store.items.mutations.flushItemsArray();
                    this.pay = true;
                })
                .catch(err => console.log(err));
        },
        open () {

        },
        close () {

        }
    },
    mounted() {
        this.totalPrice = this.items.reduce((a,b) => a + b.total, 0).toFixed(2);
        if (this.items.length === 0) {
            this.$router.push('/');
        }
    }
}
</script>

<style lang="scss" scoped>
    .disabled {
        background: #d1d1d1 !important;
        cursor: not-allowed;
    }

    .cart-container {
        min-height: 100vh;   
        display: flex;
        flex-direction: column;
    }

    .cart-items {
        flex: 1;
    }

    .table {
        background: white;
    }

    .table tr:nth-child(even) {
        background: darken(#fff, 10%);
    }

    .total-price {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        border-top: 6px solid #343A40;

        span {
            font-size: 22px;
            font-weight: 900;
            color: #343A40;
        }
    }

    .close {
        color: lighten(#000, 10%);
        cursor: pointer;

        &:hover {
            color: #ff5b5b;
        }
    }

    .controls {
        display: flex;
        justify-content: space-between;

        .button {
            width: 220px;
        }
    }
</style>

