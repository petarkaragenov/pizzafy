<template>
  <div class="container">
        <div v-show="!isActive" class="loading-modal">
            <img src="/storage/loading.gif" alt="Loading">
        </div>
        <h1>Create New Pizza</h1>
        <form @submit.prevent="handleOnSubmit">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" v-model="name">
                <span v-if="errors.has('name')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('name') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input class="form-control" type="text" name="description" id="description" v-model="description">
                <span v-if="errors.has('description')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('description') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input class="form-control" type="text" name="price" id="price" v-model="price">
                <span v-if="errors.has('price')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('price') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control-file" type="file" name="image" ref="file" id="image" @change="handleFileUpload()">
                <span v-if="errors.has('image')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('image') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" @click="isActive=false">Create</button>
            </div>
        </form>
  </div>
</template>

<script>
    import Errors from '../../Errors.js';
    export default {
        data() {
            return {
                name: '',
                description: '',
                price: '',
                file: '',
                errors: new Errors(),
                isActive: true
            }
        },
        methods: {
            handleFileUpload() {
                this.file = this.$refs.file.files[0]
            },
            handleOnSubmit() {
                let formData = new FormData();
                formData.append('name', this.name)
                formData.append('description', this.description)
                formData.append('price', this.price)
                formData.append('image', this.file)

                axios.post('/api/pizzas/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => this.$router.push('/admin'))
                    .catch(err => {
                        this.errors.record(err.response.data.errors)
                    })
            }
        }
    }
</script>


