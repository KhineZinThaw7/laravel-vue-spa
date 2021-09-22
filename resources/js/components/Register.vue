<template>
   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mt-2 mb-3">Register</h3>
                        <form @submit.prevent="register">
                            <div class="form-group">
                                <input type="text" v-model="user.name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn-primary btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div>
                            <small><span class="text-muted mr-2">If you have an account?</span></small><router-link :to="{ name: 'login' }">Login</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Register',
    data() {
        return {
            users: [],
            user: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    methods: {
        register() {
            axios.post('/api/register', this.user)
            .then(() => {
                this.$router.push('/login');
            });
        }
    }
}
</script>

<style>

</style>