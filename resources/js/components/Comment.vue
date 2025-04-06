<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar/index.js';
import { getInitials } from '../composables/useInitials.js';
import { relativeDate } from '../lib/utils.js';

defineProps(['comment']);
</script>

<template>
    <div class="sm:flex">
        <div class="mb-4 flex items-center sm:mb-0 sm:mr-4">
            <Avatar class="" size="sm">
                <AvatarImage v-if="comment.user.avatar && comment.user.avatar !== ''" :src="comment.user.avatar" :alt="comment.user.name" />
                <AvatarFallback class="rounded-lg text-black dark:text-white">
                    {{ getInitials(comment.user.name) }}
                </AvatarFallback>
            </Avatar>
        </div>
        <HeadingSmall :title="comment.body" :description="'By ' + comment.user.name + ' ' + relativeDate(comment.created_at) + ' ago'" />
    </div>
</template>
