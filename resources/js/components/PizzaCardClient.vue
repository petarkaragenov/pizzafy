<template>
    <div class="pizza-card col-sm-4 ml-2 mr-2">
        <div class="pizza-image">
            <img :src="imageURL">
        </div>
        <div class="pizza-body">
            <div class="content">
                <h3>{{ name }}</h3>
                <p>{{ description }}</p>
                <div class="pizza-price">
                    <span>Price:</span>
                    <span>${{ price }}</span>
                </div>
            </div>

            <div class="controls">
                <div class="add-to-cart">
                    <button :disabled="quantity < 1" v-if="this.$store.user.state.data" class="button button-order" @click="addToCart">Add To Cart</button>
                    <a v-if="!this.$store.user.state.data" href="/login" class="button button-order">Order Now</a>
                    <div class="quantity-group">
                        Quantity: <input type="number" min="0" class="quantity-input" v-model="quantity">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['id', 'imageURL', 'name', 'description', 'price', 'sku'],
    data() {
        return {
            quantity: 0
        }
    },
    methods: {
        addToCart() {
            let item = {};
            item.id = this.id;
            item.name = this.name;
            item.imageURL = this.imageURL;
            item.price = this.price;
            item.sku = this.sku;
            item.quantity = this.quantity;
            item.total = parseFloat(this.quantity)*parseFloat(this.price)
            
            this.$store.items.mutations.storeItem(item);
        }
    }
}
</script>

<style lang="scss" scoped>
    .pizza-card {
        display: flex;
        flex-direction: column;
        margin-top: 12px;
        padding: 12px;
        background: white;
        box-shadow: 1px 1px 3px 1px rgba(0,0,0,0.2);
        flex-basis: calc(33% - 18px);
        margin-right: 0 !important;
        margin-left: 0 !important;

        .pizza-image {
            margin-bottom: 6px;

            img {
                width: 100%;
            }
        }

        .pizza-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

             h3 {
                 text-align: center;
                font-size: 18px;
             }

             p {
                 font-size: 12px;
                 color: #666;
             }

             .pizza-price {
                 font-size: 20px;
                 display: flex;
                 justify-content: space-between;
                 color: #db5604;
             }
        }

        .add-to-cart {
            padding: 8px 0 0;
            display: flex;
            align-items: center;

            .button {
                flex: 1;
            }

            .quantity-group {
                .quantity-input {
                    padding: 8px;
                    width: 60px;
                    margin-left: 4px;
                }

                margin-left: 10px;
            }
        }
    }
</style>

