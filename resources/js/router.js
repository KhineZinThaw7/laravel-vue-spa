import Vue from 'vue'
import VueRouter from 'vue-router'
import MenuBar from './components/MenuBar.vue'
import Home from './components/Home.vue'
import About from './components/About.vue'
import Register from './components/Register.vue'
import Login from './components/Login.vue'
import ProductHome from './components/ProductHome.vue'
import ProductDetail from './components/ProductDetail.vue'
import Profile from './components/Profile.vue'
import ProductComponent from './components/Products/ProductComponent.vue'


Vue.use(VueRouter)

const routes = [
    { path: '/', name: 'home',  components: { default: Home, nav: MenuBar} },
    { path: '/about', name: 'about', components: { default: About, nav: MenuBar} },
    { path: '/register', name: 'register', components: { default: Register, nav: MenuBar} },
    { path: '/login', name: 'login',components: { default: Login, nav: MenuBar} },
    { path: '/product', name: 'product', components: { default: ProductHome, nav: MenuBar} },
    { path: '/product/:id', name: 'product.show', components: { default: ProductDetail, nav: MenuBar} },
    {
        path: '/profile', name: 'profile', components: { default: Profile, nav: MenuBar},
        beforeEnter: (to, from, next) => {
                let user = localStorage.getItem('auth');
                if(user) {
                    next()
                } else {
                    next('/login')
                }   
            
        }
    },

    { path: '/products', name: 'products.index', components: { default: ProductComponent, nav: MenuBar} },
]

const router = new VueRouter({
    mode: 'history',
    routes,
})

export default router;