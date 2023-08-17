import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
import Objects from '../components/Objects.vue'
import Detail from '../components/Detail.vue'
import Departments from '../components/Departments.vue'
import Africa from '../components/Africa.vue'
import Asia from '../components/Asia.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/objects',
      name: 'objects',
      component: Objects
    },
    {
      path: '/departments',
      name: 'departments',
      component: Departments
    },
    {
      path: '/detail/:objectId',
      name: 'detail',
      component: Detail
    },
    {
      path: '/africa',
      name: 'africa',
      component: Africa
    },
    {
      path: '/asia',
      name: 'asia',
      component: Asia
    },
  ]
})

export default router
