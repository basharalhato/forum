<script setup lang="ts">
import Container from '@/components/Container.vue';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { formatDistance, parseISO } from 'date-fns';
import { computed } from 'vue';

const props = defineProps(['post']);

const formattedDate = computed(() => formatDistance(parseISO(props.post.created_at), new Date()));

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: props.post.title,
        href: `/posts/${props.post.id}`,
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="post.title" />
        <Container>
            <Heading :title="post.title" :description="formattedDate + ' ago by ' + post.user.name" />

            <article>
                <pre class="whitespace-pre-wrap font-sans">{{ post.body }}</pre>
            </article>
        </Container>
    </AppLayout>
</template>
