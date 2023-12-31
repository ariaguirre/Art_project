import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
import Objects from '../components/Objects.vue'
import Africa from '../components/Africa.vue'
import Asia from '../components/Asia.vue'
import Egypt from '../components/Egypt.vue'
import Greek from '../components/Greek.vue'
import Islamic from '../components/Islamic.vue'
import Categories from '../components/Categories.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/europe',
      name: 'europe',
      component: Objects
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
    {
      path: '/egypt',
      name: 'egypt',
      component: Egypt
    },
    {
      path: '/greek',
      name: 'greek',
      component: Greek
    },
    {
      path: '/islamic',
      name: 'islamic',
      component: Islamic
    },
    {
      path: '/categories',
      name: 'categories',
      component: Categories
    },
  ]
})

export default router
