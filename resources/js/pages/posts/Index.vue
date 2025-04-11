<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { relativeDate } from '@/lib/utils';
import { BreadcrumbItem, PaginatedResponse } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

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
                <Link :href="route('posts.show', post.id)">
                    <Heading
                        class="mb-0 hover:text-violet-500"
                        :title="post.title"
                        :description="relativeDate(post.created_at) + ' ago By ' + post.user.name"
                    />
                </Link>
            </li>
        </ul>

        <Pagination :paginate="paginate" class="mb-6" />
    </AppLayout>
</template>
