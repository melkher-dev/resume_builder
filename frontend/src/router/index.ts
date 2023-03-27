import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'
import Dashboard from '@/views/Dashboard.vue'
import Resume from '@/views/Resume.vue'
import ResumeBuilder from '@/views/ResumeBuilder.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component:Login
    },
    {
      path: '/register',
      name: 'register',
      component:Register
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component:Dashboard
    },
    {
      path: '/resume-builder',
      name: 'resume-builder',
      component:ResumeBuilder
    },
    {
      path: '/resume/:id',
      name: 'resume',
      component:Resume
    },
  ]
})

export default router
