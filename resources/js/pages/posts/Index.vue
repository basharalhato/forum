<script setup lang="ts">
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, PaginatedResponse } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import Heading from "@/components/Heading.vue";
import {formatDistance, parseISO} from "date-fns";

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

const formattedDate = (post: any) => {
    return formatDistance(parseISO(post.created_at), new Date());
};

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Posts" />
        <ul class="divide-y">
            <li v-for="post in posts.data" :key="post.id" class="px-2 py-4">
                <Link :href="route('posts.show', post.id)">
                    <Heading class="mb-0 hover:text-violet-500" :title="post.title" :description="formattedDate(post) + ' ago by ' + post.user.name" />
                </Link>
            </li>
        </ul>

        <Pagination :paginate="paginate" class="mb-6" />
    </AppLayout>
</template>
