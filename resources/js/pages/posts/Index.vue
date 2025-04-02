<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

defineProps(['posts']);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Posts" />
        <ul class="divide-y">
            <li v-for="post in posts" :key="post.id" class="px-2 py-4">
                <span class="font-bold text-lg">{{ post.title }}</span>
            </li>
        </ul>
    </AppLayout>
</template>
