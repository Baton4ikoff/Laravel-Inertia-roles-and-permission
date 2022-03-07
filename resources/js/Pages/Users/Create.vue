<template>
    <app-layout title="Create a user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Create a user
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form-section @submitted="createUser">
                <template #title>
                    Creating a new user
                </template>

                <template #description>
                    Creating a new user
                </template>

                <template #form>
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
                    <!-- Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password" value="Password" />
                        <jet-input id="password" v-model="form.password" type="password" :class="{'border-red-500' : form.errors.password}" class="mt-1 block w-full" />
                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                    <!--Role-->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="roles" value="Role" />
                        <select v-model="form.roles" :class="{'border-red-500' : form.errors.roles}" class="mt-1 block w-full rounded-md shadow-sm" tabindex="1">
                            <option v-for="(option, index) in allRoles" :key="index" :value="option.id">
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
                    <button type="submit" @click="createUser" :class="{'opacity-25':form.processing}" :disabled="form.processing" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Create
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
import JetInputError from "../../Jetstream/InputError";
import FormSection from "../../Components/FormSection";

export default {
    components: {
        AppLayout,
        Link,
        JetInput,
        JetLabel,
        JetInputError,
        FormSection,
    },
    props: ['allRoles'],
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                password: null,
                roles: [],
            })
        }
    },
    methods: {
        createUser() {
            this.form.post(this.route('users.store', this.form), {preserveScroll: true})
        }
    }
}
</script>
