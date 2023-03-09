<template>
    <div class="card w-96 bg-base-100 shadow-xl m-5">
        <div class="card-body">
            <input v-model="form.email" type="text" placeholder="Type here"
                class="input input-bordered input-primary w-full max-w-xs" />
            <input v-model="form.password" type="password" placeholder="Type here"
                class="input input-bordered input-primary w-full max-w-xs" />
            <button @click="login" class="btn btn-outline btn-primary btn-sm">Login</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router';

const router = useRouter();

const form = reactive({
    email: '',
    password: ''
})

const login = async () => {
    const response = await axios.post('/login', form);
    localStorage.setItem('token', response.data.token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

    await router.push('/dashboard');
}

</script>