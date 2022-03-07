<template>
    <app-layout title="Editing a user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Editing a user
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form-section @submitted="editUser">
                <template #title>
                    Editing user information
                </template>

                <template #description>
                    Editing user information {{ users.name }}
                </template>

                <template #form>
                    <!-- Profile Photo -->
                    <div class="col-span-6 sm:col-span-4">
                        <span class="block font-medium text-base text-gray-700">Profile Picture</span>
                        <div class="mt-2">
                            <img :src="users.profile_photo_url" :alt="users.name" class="rounded-full h-20 w-20 object-cover">
                        </div>
                    </div>
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Name" />
                        <jet-input id="name" v-model="form.name" type="text" :class="{'border-red-500' : form.errors.name}" class="mt-1 block w-full" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>
                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="email" value="E-mail" />
                        <jet-input id="email" v-model="form.email" type="text" :class="{'border-red-500' : form.errors.email}" class="mt-1 block w-full" />
                        <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>
                    <!-- Role -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="roles" value="Role" />
                        <select id="roles" v-model="form.roles[0][0].title" class="mt-1 block w-full rounded-md shadow-sm">
                            <option v-for="(option, index) in allRoles" :key="index" :value="option.title" :selected="option.title === form.roles[0][0].title">
                                {{ option.title }}
                            </option>
                        </select>
                        <jet-input-error :message="form.errors.roles" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <Link :href="route('users.index')" class="dark:text-white">
                        Go back to the table
                    </Link>
                    <button type="submit" @click="editUser" :class="{'opacity-25':form.processing}" :disabled="form.processing" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Update
                    </button>
                </template>
            </form-section>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import {Link} from "@inertiajs/inertia-vue3";
import JetInput from "../../Jetstream/Input";
import JetLabel from "../../Jetstream/Label";
import FormSection from "../../Components/FormSection";
import JetInputError from "../../Jetstream/InputError";

export default {
    components: {
        AppLayout,
        Link,
        JetInput,
        JetLabel,
        FormSection,
        JetInputError,
    },
    props: ['users', 'allRoles'],
    data() {
        return {
            form: this.$inertia.form({
                name: this.$props.users.name,
                email: this.$props.users.email,
                // password: this.$props.users.password,
                roles: []
            })
        }
    },
    created() {
        if(this.users.roles) {
            return this.form.roles.push(this.users.roles)
        }
    },
    methods: {
        editUser() {
            this.form.patch(this.route('users.update', this.users.id, this.form), {preserveScroll: true})
        }
    }
}
</script>
