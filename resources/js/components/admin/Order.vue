<template>
  <div class="row justify-content-center">
        <div class="container order-card">
            <div v-if="order" class="info-container">
                  <div class="order-header">
                    <h2>{{ order.id }}</h2>
                    <h2>${{ order.amount }}</h2>
                </div>
                <div class="order-status">
                    <p>
                        <span>Status:</span> 
                        {{ order.status }}
                        <button class="button button-change" @click="showUpdateStatusForm">
                            <i class="fas fa-pen"></i>
                            Change 
                        </button>
                    </p>
                    <form class="status-form form-inline" @submit.prevent="handleSubmit" v-if="showForm">
                        <label class="mb-2 justify-content-start" for="status">Update Status: </label>
                        <div class="mb-2 input-group">
                            <select class="form-control height-fix" id="status" v-model="newStatus">
                                <option value="Received">Received</option>
                                <option value="Accepted">Accepted</option>
                                <option value="On its way">On its way</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn button-order" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            <div class="info-container" v-if="items">
                <h4>Items</h4>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Pizza Name</th>
                            <th>Quantity</th>
                            <th>Single Price</th>
                            <th>Total Price</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.total }}</td>
                            <td>{{ item.created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="info-container" v-if="customer">
                <h4>Shipping Address</h4>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Recipient</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Zip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.address }}</td>
                            <td>{{ customer.city }}</td>
                            <td>{{ customer.zip }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                order: null,
                showForm: false,
                newStatus: '',
                items: null,
                customer: null
            }
        },
        mounted() {
            axios.get(`/api/orders/${this.$route.params.id}`)
                .then(res => {
                    this.order = res.data
                    this.newStatus = res.data.status
                })
                .catch(err => console.log(err))

            axios.get(`/api/orders/${this.$route.params.id}/items`)
                .then(res => this.items = res.data)
                .catch(err => console.log(err))  

            axios.get(`/api/orders/${this.$route.params.id}/customer`)
                .then(res => this.customer = res.data)
                .catch(err => console.log(err))
        },
        methods: {
            showUpdateStatusForm() {
                this.showForm = true
            },
            handleSubmit() {
                const formData = new FormData;
                formData.append('_method', 'patch')
                formData.append('status', this.newStatus)
                axios.post(`/api/orders/${this.$route.params.id}`, formData)
                    .then(res => {
                        this.order = res.data
                        this.showForm = false
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style lang="scss" scoped>
    .height-fix {
        height: 100%;
    }

    .order-card {
        background: white;
        border-radius: 6px;
        box-shadow: 1px 1px 4px 1px rgba(0,0,0,0.2);
        color: #343A40;

        .info-container {
            padding: 16px 40px;
            border-bottom: 2px solid lighten(#343A40, 10%);

            h4 {
                padding: 8px 0;
            }

            .order-header {
                display: flex;
                justify-content: space-between;
            }

            .order-status {
                margin-top: 10px;
                font-size: 18px;

                span {
                    color: lighten(#343A40, 30%);
                }

                .button {
                    margin-left: 16px;
                }

                .status-form {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    label {
                        flex: 1;
                    }

                    .input-group {
                        flex: 3;
                    }

                    .btn {
                        color: white;
                    }
                }
            }

            .table {
                background: white;
            }

            &:last-child {
                border: none;
            }
        }
    }


</style>
