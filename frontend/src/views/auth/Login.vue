<template>
    <div class="flex justify-center m-5">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <input v-model="form.email" type="text" placeholder="Type here"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <input v-model="form.password" type="password" placeholder="Type here"
                    class="input input-bordered input-primary w-full max-w-xs" />
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text">Remember me</span>
                        <input v-model="form.remember" type="checkbox" class="checkbox checkbox-primary" />
                    </label>
                </div>
                <button @click="login" class="btn btn-outline btn-primary btn-sm">Login</button>
            </div>
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
    password: '',
    remember: false
})

const getToken = async () => {
    await axios.get('/sanctum/csrf-cookie')
}

const login = async () => {
    await getToken()
    const response = await axios.post('http://localhost/login', form);
    localStorage.setItem('token', response.data.token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

    await router.push('/dashboard');
}

</script>