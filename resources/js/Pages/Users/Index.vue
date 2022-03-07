<template>
    <app-layout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-700">

                        <div class="pb-5">
                            <Link :href="route('users.create')" class="text-indigo-600 dark:text-yellow-400 hover:text-indigo-900 font-bold my-5">
                                Create new user
                            </Link>
                        </div>

                        <div class="max-w-xs">
                            <jet-input type="text" v-model="email" @keyup="search" aria-label="Search" placeholder="Search by E-mail..." class="dark:bg-gray-600 dark:border-gray-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:placeholder-yellow-400 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                        </div>

                        <div class="mt-6 text-gray-500">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden rounded-lg border">
                                            <table class="min-w-full">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                                            Information
                                                        </th>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                                            Role
                                                        </th>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-white px-6 py-4 text-left">
                                                            Options
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200">
                                                    <tr v-for="(user, index) in users.data" :key="user.id" :class="{'bg-gray-50 dark:bg-gray-600' : index%2 === 0}" class="hover:bg-gray-100 dark:hover:bg-gray-500">
                                                        <td class="py-4 px-6 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div class="flex-shrink-0 w-10 h-10">
                                                                    <img class="w-10 h-10 rounded-full" :src="user.profile_photo_url" alt=""/>
                                                                </div>
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                                        {{ user.name }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500 dark:text-gray-300">
                                                                        {{ user.email }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td v-for="role in user.roles" :key="role.id" class="py-4 px-6 text-sm text-gray-500 dark:text-white whitespace-nowrap">
                                                            {{ role.title }}
                                                        </td>
                                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                            <div class="flex text-sm text-gray-500 dark:text-white item-center justify-center">
                                                                <Link :href="route('users.show', user.id)">
                                                                    <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                        </svg>
                                                                    </div>
                                                                </Link>
                                                                <Link :href="route('users.edit', user.id)">
                                                                    <div class="w-4 mr-2 transform hover:text-yellow-400 hover:scale-110">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                        </svg>
                                                                    </div>
                                                                </Link>
                                                                <Link @click="destroy(user.id)">
                                                                    <div class="w-4 mr-2 transform hover:text-yellow-400 hover:scale-110">
                                                                        <svg type="submit" class="w-4 mr-2 transform hover:text-red-600 hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </div>
                                                                </Link>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Pagination class="mt-10" :links="users.links"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import {Head, Link} from "@inertiajs/inertia-vue3";
import JetInput from "../../Jetstream/Input";
import lodash from 'lodash';
import Pagination from "../../Components/Pagination";

export default {
    components: {
        JetInput,
        AppLayout,
        Head,
        Link,
        Pagination,
    },
    props: ['users'],
    data() {
        return {
            email: ''
        }
    },
    methods: {
        search: lodash.throttle(function () {
            this.$inertia.replace(this.route('users.index', {email: this.email}, {preserveState: true}))
        }, 200),

        destroy(id) {
            if(confirm('Are you sure you want to delete it?')) {
                this.$inertia.delete(this.route('users.destroy', id), {
                    preserveScroll: true,
                })
            }
        }
    },
}
</script>
