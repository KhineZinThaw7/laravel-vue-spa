<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mt-2 mb-3">Login</h3>
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn-primary btn-block">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div>
                            <small><span class="text-muted mr-2">Don't have an account?</span></small><router-link :to="{ name: 'register'}">Register</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            user: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        login() {
            axios.post('/api/login', this.user)
            .then(() => {
                this.$router.push('/profile');
            })
            localStorage.setItem('auth', JSON.stringify(this.user));
        },
       
    }
}
</script>
