<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import {BreadcrumbItem, PaginatedResponse} from '@/types';
import { Head } from '@inertiajs/vue3';
import Pagination from "@/components/Pagination.vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

const props = defineProps(['posts']);

const paginate: PaginatedResponse = {
    links: props.posts.links,
    meta: props.posts.meta,
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Posts" />
        <ul class="divide-y">
            <li v-for="post in posts.data" :key="post.id" class="px-2 py-4">
                <span class="text-lg font-bold">{{ post.title }}</span>
            </li>
        </ul>

        <Pagination :paginate="paginate" class="mb-6" />
    </AppLayout>
</template>
