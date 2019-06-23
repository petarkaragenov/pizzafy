<template>
  <div class="row justify-content-center">
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders" :key="order.id">
                        <td>{{ order.id }}</td>
                        <td>{{ order.user_id }}</td>
                        <td>{{ order.amount }}</td>
                        <td>{{ order.status }}</td>
                        <td>{{ order.created_at }}</td>
                        <td><router-link :to="`/admin/orders/${order.id}`" class="button button--link d-flex">View</router-link></td>
                        <td><button @click="deleteOrder(order.id)" class="button button--link">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
            axios.get(`/api/orders`)
                .then(res => {
                    this.orders = res.data
                })
        },
        methods: {
            deleteOrder(id) {
                axios.post(`/api/orders/${id}`, { '_method': 'delete' })
                .then(res => {
                    this.orders = res.data
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .table {
        background: white;
    }

    .button--link {
        color: #343A40;
        transition: 0.2s;

        &:hover {
            color: lighten(#343A40, 10%) !important;
        }
    }
</style>
