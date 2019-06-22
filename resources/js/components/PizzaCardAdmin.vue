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
                <div class="admin-buttons">
                    <router-link :to="`/admin/pizzas/${id}`" class="button button-update">Update</router-link>
                    <button @click="$emit('delete')" class="button button-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['imageURL', 'name', 'description', 'price', 'id'],
    data() {
        return {
            quantity: 0
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
        flex-basis: calc(33% - 10px);
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

        .admin-buttons {
            display: flex;

            button, a {
                width: 100%;
            }
        }
    }
</style>

