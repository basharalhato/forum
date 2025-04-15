<script setup lang="ts">
import Comment from '@/components/Comment.vue';
import Container from '@/components/Container.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import Pagination from '@/components/Pagination.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { relativeDate } from '@/lib/utils';
import { BreadcrumbItem, PaginatedResponse } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

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

const commentForm = useForm({
    body: '',
});

const addComment = () => {
    commentForm.post(route('posts.comments.store', props.post.id), {
        preserveScroll: true,
        onSuccess: () => commentForm.reset(),
    });
};

const deleteComment = (commentId: number) =>
    router.delete(route('comments.destroy', { comment: commentId, page: paginate.meta.current_page }), {
        preserveScroll: true,
    });
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

                <form v-if="$page.props.auth.user" @submit.prevent="addComment" class="mb-4">
                    <div class="mb-3 mt-4 grid w-full gap-2">
                        <Label for="body" class="sr-only">Body</Label>
                        <Textarea id="body" rows="4" required :tabindex="1" v-model="commentForm.body" placeholder="Speed your mind Spock.." />
                        <InputError :message="commentForm.errors.body" />
                    </div>
                    <Button type="submit" class="text-sm uppercase" :tabindex="2" :disabled="commentForm.processing">
                        <LoaderCircle v-if="commentForm.processing" class="h-4 w-4 animate-spin" />
                        Add Comment
                    </Button>
                </form>

                <ul class="divide-y">
                    <li v-for="comment in comments.data" :key="comment.id" class="px-2 py-4">
                        <Comment @delete="deleteComment" :comment="comment" />
                    </li>
                </ul>

                <Pagination :paginate="paginate" :only="['comments']" class="mb-6" />
            </div>
        </Container>
    </AppLayout>
</template>
