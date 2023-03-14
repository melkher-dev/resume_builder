<template>
    <div>
        <main-layout />
        <div v-if="isLoading" class="flex justify-center">
            <h3>Loading...</h3>
        </div>

        <!-- <div v-else>
            <div class="flex justify-center mt-2 mx-5">
                <div class="card w-2/3 bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex justify-center">
                            <div class="w-24 rounded">
                                <img :src="imagePath" />
                            </div>
                        </div>
                        <div class="card-actions justify-center">
                            <h1 class="text-4xl font-bold">{{ resume.full_name }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Email: {{ resume.email }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Position: {{ resume.current_position }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Experience: {{ resume.experience }} years</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Technologies: {{ resume.technologies }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Job Description:</h1>
                            <p>{{ resume.job_description }}</p>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Job Responsibilities:</h1>
                            <p>{{ resume.job_responsibilities }}</p>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Job Achievements:</h1>
                            <p>{{ resume.job_achievements }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div v-else>
            <div class="flex justify-center mt-2 mx-5">
                <div class="card w-2/3 bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex justify-center">
                            <div class="w-24 rounded">
                                <img v-bind:src="imagePath" />
                            </div>
                        </div>
                        <div class="card-actions justify-center">
                            <h1 class="text-4xl font-bold">{{ resume.full_name }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Email: {{ resume.email }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Position: {{ resume.current_position }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Experience: {{ resume.experience }} years</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Technologies: {{ resume.technologies }}</h1>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Job Description:</h1>
                            <p>{{ resume.job_description }}</p>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Job Responsibilities:</h1>
                            <p>{{ resume.job_responsibilities }}</p>
                        </div>
                        <div class="mt-4">
                            <h1 class="text-lg font-semibold">Job Achievements:</h1>
                            <p>{{ resume.job_achievements }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import MainLayout from "./layouts/MainLayout.vue";
import axios from "axios";
import { onMounted, ref, computed } from "vue";
import { useRoute } from "vue-router";
// import type { Resume } from "../types/resume.interface";

const route = useRoute();




let resume = ref({});
let isLoading = ref(true);

const id = route.params.id;

onMounted(async () => {
    isLoading.value = true;
    const { data } = await axios.get(`/api/resume/show/${id}`);
    console.log('data :>> ', data);
    resume.value = data;
    isLoading.value = false;
});

const imagePath = computed(() => {
    return `/api/images/${resume.value.image_path}`
});
</script>