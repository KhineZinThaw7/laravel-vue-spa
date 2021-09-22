<template>
    <div class="container mt-5">
        <div class="card p-5">
            <div class="row">
                <div class="col-md-4">
                    <img :src="product.image" alt="Product image" width="300" height="250">
                </div>
                <div class="col-md-8">
                    <h1>{{ product.title }}</h1>
                    <div class="text-bold mb-2">$ {{ product.price }}</div>
                    <div>{{ product.description }}</div>
                    <div>
                        <router-link :to="{ name: 'product'}" class="btn btn-outline-secondary btn-sm mt-3">
                            Go Back
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ProductDetail",
    data() {
        return {
            product: []
        };
    },
    methods: {
        getProduct() {
            axios
                .get(
                    `/api/products/${this.$route.params.id}`
                )
                .then(response => {
                    this.product = response.data;
                });
        }
    },
    created() {
        this.getProduct();
    }
};
</script>
