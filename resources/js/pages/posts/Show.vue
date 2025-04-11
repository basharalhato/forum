<script setup lang="ts">
import Comment from '@/components/Comment.vue';
import Container from '@/components/Container.vue';
import Heading from '@/components/Heading.vue';
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { relativeDate } from '@/lib/utils';
import { BreadcrumbItem, PaginatedResponse } from '@/types';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['post', 'comments']);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: props.post.title,
        href: `/posts/${props.post.id}`,
    },
];

const paginate: PaginatedResponse = {
    links: props.comments.links,
    meta: props.comments.meta,
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="post.title" />
        <Container>
            <Heading class="mb-6" :title="post.title" :description="relativeDate(post.created_at) + ' ago by ' + post.user.name" />

            <article>
                <pre class="whitespace-pre-wrap font-sans">{{ post.body }}</pre>
            </article>

            <div class="mt-12">
                <Heading title="Comments" class="m-0" />

                <ul class="mt-4 divide-y">
                    <li v-for="comment in comments.data" :key="comment.id" class="px-2 py-4">
                        <Comment :comment="comment" />
                    </li>
                </ul>

                <Pagination :paginate="paginate" :only="['comments']" class="mb-6" />
            </div>
        </Container>
    </AppLayout>
</template>
