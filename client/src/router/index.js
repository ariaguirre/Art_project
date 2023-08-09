import { createRouter, createWebHistory } from 'vue-router'
import Objects from '../components/Objects.vue'
import Detail from '../components/Detail.vue'
import Departments from '../components/Departments.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
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
      path: '/detail',
      name: 'detail',
      component: Detail
    },
  ]
})

export default router
