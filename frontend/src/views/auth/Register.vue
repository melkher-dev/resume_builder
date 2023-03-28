<template>
    <div class="flex justify-center m-5">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <input v-model="form.name" type="text" placeholder="Name"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <input v-model="form.email" type="email" placeholder="Email"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <input v-model="form.password" type="password" placeholder="Password"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <input v-model="form.password_confirmation" type="password" placeholder="Password Confirmation"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <div class="form-control" v-if="!isDisabled">
                    <button @click="handleRegister(form)" class="btn btn-outline btn-primary btn-sm">Register</button>
                </div>
                <div v-else class="form-control">
                    <button class="btn btn-outline btn-primary btn-sm" disabled>Register</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()

let isDisabled = ref(false);

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const handleRegister = (form) => {
    isDisabled.value = true
    authStore.register(form)
}
</script>