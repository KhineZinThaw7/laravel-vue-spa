<template>
    <div class="container my-5">
        <h3>Product List</h3>
        <div class="row justify-content-end mb-3 mr-2">
            <button class="btn btn-primary" @click="create">
                Create
            </button>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                       {{ doEdit ? 'Edit' : 'Create'}}            
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="doEdit ? update() : store()">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input v-model="product.title" type="text"  class="
                                form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input v-model="product.price" type="text" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Image</label>
                                <div v-if="!product.image">
                                    <input type="file" @change="onFileChange" class="form-control-file">
                                </div>
                                <div v-else>
                                    <input type="hidden" v-model="product.image">
                                    <img v-if="!doEdit" :src="previewImg"  width="100" height="100">
                                    <img v-else :src="product.image" alt="" width="100" height="100">
                                    <button @click="removeImage" class="btn btn-secondary">Remove image</button>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea v-model="product.description" class="form-control" id=""></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ doEdit ? 'Update' : 'Create'}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <td>{{product.id }}</td>
                            <td>{{product.title}}</td>
                            <td>{{product.price}}</td>
                            <td>
                                <img :src="product.image" alt="Product Img" width="100" height="100">
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" @click="edit(product)">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" @click="destroy(product.id)">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name : 'ProductComponent',
    data() {
        return {
            doEdit : false,
            products : [],
            previewImg : '',
            product : {
                id : '',
                title : '',
                price : '',
                image : '',
                description : '',
            }

        }
    },
    methods : {
        view(){
            axios.get('/api/products')
            .then(response =>{
                this.products = response.data;
            });
        },
        create(){
            this.doEdit = false;
            this.product.id = '';
            this.product.title = '';
            this.product.price = '';  
            this.product.image = '';  
            this.product.description = ''; 
        },
        store(){
            const data = new FormData();
            data.append('image', this.product.image);
            data.append('title', this.product.title);
            data.append('price', this.product.price);
            data.append('description', this.product.description);
            axios.post('/api/products', data)
            .then(response => {
                this.view();
                this.product.id = '';
                this.product.title = '';
                this.product.price = '';
                this.product.image = '';
                this.product.description = ''; 
            }) 
        },
        edit(product){
            this.doEdit = true;
            this.product.id = product.id;
            this.product.title = product.title;
            this.product.price = product.price;
            this.product.image = product.image;
            this.product.description = product.description; 
        },
        update(){
            axios.put('/api/products/'+this.product.id , this.product)
            .then( response => {
                this.view();
                this.product.id = '';
                this.product.title = '';
                this.product.price = '';
                this.product.image = '';
                this.product.description = ''; 
                this.doEdit = false; 
            })
        },
        destroy(id){
            if(!confirm('Are you sure to delete?')){
                return;
            }
            axios.delete('/api/products/'+id)
            .then(response => {
                this.view();
            })
        },
        onFileChange(e) {
            this.product.image = e.target.files[0];
            this.createImage(this.product.image);
        },
        createImage(file) {
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
             vm.previewImg = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.previewImg = '';
            this.product.image = '';
        }
    },
    created() {
        this.view();
    }
}
</script>