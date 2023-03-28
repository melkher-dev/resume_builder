<template>
    <div class="flex justify-center m-5">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <input v-model="form.email" type="text" placeholder="Email"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <input v-model="form.password" type="password" placeholder="Password"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text">Remember me</span>
                        <input v-model="form.remember" type="checkbox" class="checkbox checkbox-primary" />
                    </label>
                </div>
                <div class="form-control">
                    <router-link to="/register" class="btn btn-ghost btn-outline btn-sm nav-link">Register</router-link>
                </div>
                <div class="form-control" v-if="!isDisabled">
                    <button @click="handleLogin(form)" class="btn btn-outline btn-primary btn-sm">Login</button>
                </div>
                <div class="form-control" v-else>
                    <button class="btn btn-outline btn-primary btn-sm" disabled>Login</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { RouterLink } from 'vue-router';
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()

let isDisabled = ref(false);

const form = ref({
    email: '',
    password: '',
    remember: false
})

const handleLogin = (form) => {
    isDisabled.value = true
    authStore.login(form)
}
</script>