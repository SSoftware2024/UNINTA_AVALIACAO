import { createRouter, createWebHistory, createWebHashHistory } from 'vue-router'
import Login from '@/pages/auth/Login.vue';
import Register from '@/pages/auth/Register.vue';


const routes = [
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/', //view inicial
    name: 'login',
    component: Login
  },


]

const router = createRouter({
  history: createWebHistory('/taskList/'),
  routes
})

export default router;
