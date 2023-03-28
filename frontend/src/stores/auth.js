import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
    }),
    getters: {
        user: (state) => state.authUser,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie')
        },
        async getUser() {
            await this.getToken()
            const { data } = await axios.get('/api/user')
            this.authUser = data
        },
        async login(data) {
            await this.getToken()
            const response = await axios.post('/login', data);
            localStorage.setItem('token', response.data.token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
            this.router.push('/dashboard')
        },
        async register(data) {
            await this.getToken()
            await axios.post('/register', data);
            await this.router.push('/login');
        },
        async logout() {
            await axios.post('/logout');
            this.router.push('/login');
        }
    },
})