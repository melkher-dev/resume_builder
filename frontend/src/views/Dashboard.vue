<template>
    <div>
        <main-layout />
        <div class="flex justify-center mt-2 mx-5">
            <div class="card w-2/3 bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="card-actions justify-center">
                        <h1>
                            <strong>
                                Resume Builder
                            </strong>
                        </h1>
                    </div>
                    <div class="mx-1">
                        <label class="label">
                            <span class="label-text">Enter your full name</span>
                        </label>
                        <input v-model="form.full_name" type="text" class="input input-bordered input-primary w-full" />
                    </div>
                    <div class="mx-1">
                        <label class="label">
                            <span class="label-text">Enter your full email</span>
                        </label>
                        <input v-model="form.email" type="email" class="input input-bordered input-primary w-full" />
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="mx-1">
                            <label class="label">
                                <span class="label-text">Current position</span>
                            </label>
                            <input v-model="form.current_position" type="text"
                                class="input input-bordered input-primary w-full max-w-xs" />
                        </div>
                        <div class="mx-1">
                            <label class="label">
                                <span class="label-text">For how long?(years)</span>
                            </label>
                            <input v-model="form.experience" type="text"
                                class="input input-bordered input-primary w-full max-w-xs" />
                        </div>
                        <div class="mx-1">
                            <label class="label">
                                <span class="label-text">Technologies used</span>
                            </label>
                            <input v-model="form.technologies" type="text"
                                class="input input-bordered input-primary w-full max-w-xs" />
                        </div>
                    </div>
                    <div class="mx-1">
                        <label class="label">
                            <span class="label-text">Upload your image</span>
                        </label>
                        <input v-on:change="handleFileUpload" type="file"
                            class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
                        <!-- <button @click="getFilePath" class="btn btn-primary btn-outline btn-sm mx-2">Add file</button> -->
                    </div>
                    <div>
                        <h1><strong>Companies you worked at</strong></h1>
                    </div>

                    <div>
                        <div v-for="(company, index) in form.companies" :key="index" class="grid grid-cols-5">
                            <div class="col-span-2 mx-2">
                                <label class="label">
                                    <span class="label-text">Company name</span>
                                </label>
                                <input v-model="company.company_name" type="text"
                                    class="input input-bordered input-primary w-full max-w-lg" />
                            </div>
                            <div class="col-span-2 mx-2">
                                <label class="label">
                                    <span class="label-text">Position held</span>
                                </label>
                                <input v-model="company.position_held" type="text"
                                    class="input input-bordered input-primary w-full max-w-lg" />
                            </div>
                            <div class="col-span-1">
                                <div class="grid mx-2 mt-7">
                                    <label class="label">
                                        <span class="label-text"></span>
                                    </label>
                                    <div>
                                        <button v-if="index !== form.companies.length - 1" @click="removeCompany(index)"
                                            class="btn btn-error btn-sm w-full">Delete</button>
                                    </div>

                                    <div class="">
                                        <div v-if="form.companies.length - 1 === index && form.companies.length <= 3">
                                            <button @click="addCompany" class="btn btn-success btn-sm w-full">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-actions justify-center mt-3">
                        <button @click="sendResume" class="btn btn-primary btn-sm w-full">Load</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import MainLayout from "./layouts/MainLayout.vue"
import { reactive, ref } from 'vue'
import axios from 'axios'
import { useRouter } from "vue-router"

const router = useRouter()

let image = ref('');
let resume_id = ref('');

const form = reactive({
    full_name: '',
    email: '',
    current_position: '',
    experience: '',
    technologies: '',
    image_path: '',
    companies: [{
        company_name: '',
        position_held: ''
    }],
})

const handleFileUpload = async (event: any) => {
    const file = event.target.files[0]
    image.value = file

    const formData = new FormData()
    formData.append('image', image.value)

    const response = await axios.post('/api/upload', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })

    form.image_path = response.data
}

//send resume and get response data
const sendResume = async () => {
    const response = await axios.post('/api/resume', form)
    resume_id.value = response.data
    router.push(`/resume/${resume_id.value}`)
}

const addCompany = () => {
    form.companies.push({
        company_name: '',
        position_held: ''
    })
}

const removeCompany = (index: number) => {
    form.companies.splice(index, 1)
}

</script>