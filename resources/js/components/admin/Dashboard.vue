<template>
  <div class="row justify-content-center">
      <div class="col-md-10">
          <div class="container">
              <PizzaHolder>
                  <template v-slot:header>
                    <h3 class="pizza-heading">Display All Pizzas</h3>
                  </template>
                  <template v-slot:card>
                    <PizzaCardAdmin 
                        v-for="pizza in pizzas" 
                        :key="pizza.id"
                        :id="pizza.id"
                        :name="pizza.name" 
                        :description="pizza.description" 
                        :price="pizza.price"
                        :imageURL="`/storage/${pizza.image}`"
                        @delete="deletePizza(pizza.id)"
                    >
                    </PizzaCardAdmin>
                  </template>
              </PizzaHolder>
          </div>
      </div>
  </div>
</template>

<script>
    import PizzaCardAdmin from '../PizzaCardAdmin.vue';
    import PizzaHolder from '../PizzaHolder.vue';

    export default {
        components: {
            PizzaHolder, PizzaCardAdmin
        },
        data() {
            return {
                pizzas: null
            }
        },
        mounted() {
            axios.get('/api/pizzas')
                .then(res => this.pizzas = res.data)
        },
        methods: {
            deletePizza(id) {
                axios.post(`/api/pizzas/${id}`, { '_method': 'delete' })
                    .then(res => {
                        this.pizzas = this.pizzas.filter(pizza => {
                            return pizza.id !== id
                        })
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
