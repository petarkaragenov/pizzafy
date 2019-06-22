<template>
    <div class="pizza-store-container">
        <Header />
        <div class="container pizza-store">
            <PizzaHolder>
                <template v-slot:header>
                    <div class="pizza-holder-header">
                        <form @submit.prevent="searchPizzas">
                            <div class="input-group search-field">
                                <input v-model="searchQuery" type="text" name="search" class="form-control" placeholder="search...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="filters">
                            <form class="inline-form" @submit.prevent="getAllPizzas">
                                <button class="button button--link">All</button>
                            </form>
                            <form class="inline-form" @submit.prevent="orderByFilter('price')">
                                <button class="button button--link">
                                    Price
                                    <i class="fa" :class="{ 'fa-angle-down': order === 'desc', 'fa-angle-up': order === 'asc'}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </template>
                <template v-slot:card>
                    <PizzaCardClient 
                        v-for="pizza in pizzas" 
                        :key="pizza.id"
                        :id="pizza.id"
                        :sku="pizza.sku"
                        :name="pizza.name" 
                        :description="pizza.description" 
                        :price="pizza.price"
                        :imageURL="`/storage/${pizza.image}`"
                        @addToCart="addToCart"
                    >
                    </PizzaCardClient>
                    <div class="no-results" v-if="pizzas.length === 0">
                        <h3>No Pizzas to show</h3>
                    </div>
                </template>
            </PizzaHolder>
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';
import PizzaHolder from '../PizzaHolder.vue';
import PizzaCardClient from '../PizzaCardClient.vue';
export default {
    components: {
        Header, Footer, PizzaHolder, PizzaCardClient
    },
    data() {
        return {
            pizzas: [],
            order: 'desc',
            searchQuery: '',
            noPizzasMessage: 'No results found'
        }
    },
    methods: {
        addToCart(item) {
            this.$emit('addToCart', item)
        },
        getAllPizzas() {
            axios.get('/api/pizzas')
            .then(res => {
                this.pizzas = res.data
                this.pizzas.map(pizza => pizza.quantity = 0)
            })
            .catch(err => console.log(err))
        },
        orderByFilter(filter) {
            axios.get(`/api/pizzas/sort`, { params: { sortBy: filter, order: this.order }})
                .then(res => {
                    this.displayNoPizzasMessages = false
                    this.pizzas = res.data
                    this.order === 'asc' ? this.order = 'desc' : this.order = 'asc'
                })
                .catch(err => console.log(err));
        },
        searchPizzas() {
            axios.get(`/api/pizzas/search`, { params: { query: this.searchQuery }})
                .then(res => {
                    if (res.data.length === 0) {
                        this.pizzas = []
                    } else {
                        this.pizzas = res.data
                        this.searchQuery = ''
                    }
                })
                .catch(err => console.log(err))
        }
    },
    mounted() {
        this.getAllPizzas()
    }
}
</script>

<style lang="scss" scoped>
    .pizza-store-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .pizza-store {
        flex: 1;

        .pizza-holder-header {
            padding: 12px 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            form {
                .search-field {
                    input {
                        line-height: 1.5;
                        background: lighten(#000, 10%);
                        color: white;
                        border-radius: 0 !important;

                        &:hover {
                            outline: 1px solid black;
                        }
                    }

                    button {
                        border-radius: 0 !important;
                    }
                }
            }

            .filters {
                display: flex;
            }
        }
    }
</style>
