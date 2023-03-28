import { createApp } from 'vue'
import {createPinia} from 'pinia'
import App from './App.vue'
import router from './router'

import './assets/main.css'
import './axios'

// axios.defaults.withCredentials = true
// axios.defaults.baseURL = 'http://localhost:8000'

const app = createApp(App)

const pinia = createPinia()

app.use(pinia)
app.use(router)

app.mount('#app')
