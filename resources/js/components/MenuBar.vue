<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <a class="navbar-brand" href="#">Shop</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <router-link class="nav-link" :to="{ name: 'home' }">Home </router-link>
        </li>
        <li class="nav-item active">
          <router-link class="nav-link" :to="{ name: 'product' }">Product </router-link>
        </li>
        <li class="nav-item active">
          <router-link class="nav-link" :to="{ name: 'about' }">About </router-link>
        </li>
        <li class="nav-item active">
          <router-link class="nav-link" :to="{ name: 'login' }" v-if="!auth">Login </router-link>
        </li>
        <li class="nav-item active">
          <router-link class="nav-link" :to="{ name: 'register' }" v-if="!auth">Register </router-link>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown" v-if="auth">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <router-link class="dropdown-item" :to="{ name: 'products.index' }" v-if="auth">Products </router-link>
            <div class="dropdown-divider"></div>
            <router-link class="dropdown-item" :to="{ name: 'profile' }" v-if="auth">Profile </router-link>
            <div class="dropdown-divider"></div>
            <form @submit.prevent="logout">
              <button class="dropdown-item btn btn-secondary" type="submit" v-if="auth">Logout</button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import axios from 'axios';

export default {
  name: 'MenuBar',
  data() {
    return {
      message: "Hello Menu Bar",
      auth: false,
      name: '',
    };
  },
  methods: {
    view() {
        axios.get('/api/users')
        .then(response => {
          this.name = response.data.name;
          this.auth = true;
        })
    },
    logout() {
      axios.post('/api/logout')
      .then(() => {
        this.$router.push('/');
        this.auth = false;
        localStorage.clear();
      })
    },
  },
  created() {
    this.view();
  }
};
</script>
