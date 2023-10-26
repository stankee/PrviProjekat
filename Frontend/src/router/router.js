import { createRouter, createWebHistory } from 'vue-router';
import UserList from '../components/UserList.vue';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';


const routes = [
  {
    path: '/',
    name: 'Home',
    component: UserList,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;
