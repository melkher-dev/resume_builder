<template>
    <div class="navbar w-full bg-base-100">
        <div class="navbar-start">
            <div class="dropdown">
            </div>
        </div>
        <div class="navbar-center hidden lg:flex">
        </div>
        <div class="navbar-end">
            <div class="grid grid-cols-3" v-if="authStore.user">
                <p class="mt-2">{{ authStore.user.name }}</p>
                <router-link to="/dashboard" class="btn btn-ghost btn-outline btn-sm nav-link m-2">Dashboard</router-link>
                <button @click="authStore.logout" class="btn btn-outline btn-ghost btn-sm m-2">Logout</button>
            </div>
            <div v-else>
                <router-link to="/login" class="btn btn-ghost btn-outline btn-sm nav-link m-2">Login</router-link>
                <router-link to="/register" class="btn btn-ghost btn-outline btn-sm nav-link m-2">Register</router-link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { RouterLink } from 'vue-router';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { onMounted } from 'vue';
import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();

const router = useRouter();

onMounted(async () => {
    await authStore.getUser();
});

</script>