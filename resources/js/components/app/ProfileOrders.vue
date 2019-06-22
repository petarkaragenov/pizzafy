<template>
  <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.amount }}</td>
                    <td>{{ order.status }}</td>
                    <td>{{ order.created_at }}</td>
                </tr>
            </tbody>
        </table>
       
  </div>
</template>

<script>
    export default {
        data() {
            return {
                orders: null
            }
        },
        mounted() {
            axios.get(`/api/orders/user/${this.$store.user.getters.getUser()[0].id}`)
                .then(res => {
                    console.log(res.data)
                    this.orders = res.data
                });
        },
    }
</script>

<style lang="scss" scoped>
    .table {
        background: white;
    }
</style>

