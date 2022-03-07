<template>
    <app-layout title="User Information">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Viewing user information
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <section-content>
                <template #title>
                    Detailed information about the user
                </template>

                <template #description>
                    Viewing detailed user information {{ users.name }}
                </template>

                <template #content>
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Profile Photo -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label value="Profile Picture" />
                            <div class="mt-2">
                                <img :src="users.profile_photo_url" :alt="users.name" class="rounded-full h-20 w-20 object-cover">
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label value="Name" />
                            <span class="block font-medium text-lg text-gray-700">
                                {{ users.name }}
                            </span>
                        </div>
                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label value="E-mail" />
                            <span class="block font-medium text-lg text-gray-700">
                                {{ users.email }}
                            </span>
                        </div>
                        <!-- Role -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label value="Role" />
                            <span v-for="role in users.roles" :key="role.id" class="block font-medium text-lg text-gray-700">
                                {{ role.title }}
                            </span>
                        </div>
                    </div>
                </template>

                <template #footer>
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <Link :href="route('users.index')" class="dark:text-white">
                            Go back to the table
                        </Link>
                        <Link :href="route('users.edit', users.id)">
                            Edit
                        </Link>
                    </div>
                </template>
            </section-content>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import {Head, Link} from "@inertiajs/inertia-vue3";
import JetLabel from "../../Jetstream/Label";
import SectionContent from "../../Components/SectionContent";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        JetLabel,
        SectionContent,
    },
    props: ['users'],
}
</script>
