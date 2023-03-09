<template>
    <div class="card w-96 bg-base-100 shadow-xl m-5">
        <div class="card-body">
            <input v-model="form.name" type="text" placeholder="Type here"
                class="input input-bordered input-primary w-full max-w-xs" />
            <input v-model="form.email" type="email" placeholder="Type here"
                class="input input-bordered input-primary w-full max-w-xs" />
            <input v-model="form.password" type="password" placeholder="Type here"
                class="input input-bordered input-primary w-full max-w-xs" />
            <input v-model="form.password_confirmation" type="password" placeholder="Type here"
                class="input input-bordered input-primary w-full max-w-xs" />
            <button @click="register" class="btn btn-outline btn-primary btn-sm">Register</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const getToken = async () => {
    await axios.get('http://localhost/sanctum/csrf-cookie')
}

const register = async () => {
    await getToken()
    await axios.post('http://localhost/register', form);

    await router.push('/login');
}

</script>