<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar/index.js';
import { Button } from '@/components/ui/button';
import { getInitials } from '@/composables/useInitials';
import { relativeDate } from '@/lib/utils';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps(['comment']);

const deleteComment = () =>
    router.delete(route('comments.destroy', props.comment.id), {
        preserveScroll: true,
    });

const canDelete = computed(() => props.comment.user.id === usePage().props.auth.user?.id);
</script>

<template>
    <div class="sm:flex">
        <div class="mb-4 flex items-center sm:mb-0 sm:mr-4">
            <Avatar size="sm">
                <AvatarImage v-if="comment.user.avatar && comment.user.avatar !== ''" :src="comment.user.avatar" :alt="comment.user.name" />
                <AvatarFallback class="rounded-lg text-black dark:text-white">
                    {{ getInitials(comment.user.name) }}
                </AvatarFallback>
            </Avatar>
        </div>
        <HeadingSmall
            classes="break-all"
            :title="comment.body"
            :description="'By ' + comment.user.name + ' ' + relativeDate(comment.created_at) + ' ago'"
        >
            <div class="mt-1">
                <form v-if="canDelete" @submit.prevent="deleteComment">
                    <Button type="submit" class="text-sm uppercase hover:text-red-400" variant="outline">Delete</Button>
                </form>
            </div>
        </HeadingSmall>
    </div>
</template>
