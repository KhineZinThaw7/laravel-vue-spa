<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="images/user.png" alt="Profile Image" width="100" height="100">
                        <h1>{{ name }}</h1>
                        <p>{{ email }}</p>
                        <p>12345678</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn-outline-success btn-sm float-right">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Profile',
    data() {
        return {
            name: '',
            email: '',
        }
    },
    methods: {
        view() {
            axios.get('/api/users')
            .then(response => {
                this.name = response.data.name;
                this.email = response.data.email;
            })
        }
    },
    created() {
        this.view()
    }
}
</script>
