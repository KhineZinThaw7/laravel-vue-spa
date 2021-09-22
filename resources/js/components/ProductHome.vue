<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4" v-for="product in products" :key="product.id">
                <div class="card">
                    <div class="card-body text-center">
                        <img :src="product.image" alt="Product image" class="product-img">
                        <h5 class="mt-4">{{ product.title }}</h5>
                        <p class="my-4 text-muted">$ {{ product.price }} </p>
                        <router-link :to="{ name: 'product.show', params: { id: product.id } }" class="btn btn-primary btn-block">Detail</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from  'axios'

export default {
    name: 'ProductHome',
    data() {
       return {
           products: []
       } 
    },
    created() {
        axios.get('/api/products')
        .then(response => {
            this.products = response.data
        })
    }
}
</script>

<style>
    .product-img {
        height: 150px;
    }
</style>
