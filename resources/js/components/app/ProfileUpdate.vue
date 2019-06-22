<template>
  <div class="container">
        <h1>Update Profile</h1>
        <form @submit.prevent="handleOnSubmit">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input @kinput="errors.clear('phone')" class="form-control" type="text" name="phone" id="phone" v-model="phone">
                <span v-if="errors.has('phone')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('phone') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input @input="errors.clear('address')" class="form-control" type="text" name="address" id="address" v-model="address">
                <span v-if="errors.has('address')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('address') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input @input="errors.clear('city')" class="form-control" type="text" name="city" id="city" v-model="city">
                <span v-if="errors.has('city')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('city') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label for="zip">Zip</label>
                <input @input="errors.clear('zip')" class="form-control" type="text" name="zip" id="zip" v-model="zip">
                <span v-if="errors.has('zip')" class="invalid-feedback d-block" role="alert">
                    <strong>{{ errors.get('zip') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <button class="button button-update">Update</button>
            </div>
        </form>
  </div>
</template>

<script>
    import Errors from '../../Errors.js';
    export default {
        data() {
            return {
                id: this.$store.user.getters.getUser()[0].id,
                phone: this.$store.user.getters.getUser()[0].phone,
                address: this.$store.user.getters.getUser()[0].address,
                city: this.$store.user.getters.getUser()[0].city,
                zip: this.$store.user.getters.getUser()[0].zip,
                errors: new Errors()
            }
        },
        methods: {
            handleOnSubmit() {
                let formData = new FormData();
                formData.append('_method', 'patch')
                formData.append('id', this.id)
                formData.append('phone', this.phone)
                formData.append('address', this.address)
                formData.append('city', this.city)
                formData.append('zip', this.zip)

                axios.post(`/api/profile/`, formData)
                    .then(res => {
                        this.$store.user.mutations.userUpdate(res.data)
                        this.$router.push('/profile')
                    })
                    .catch(err => {
                        this.errors.record(err.response.data.errors)
                    })
            }
        }
    }
</script>


