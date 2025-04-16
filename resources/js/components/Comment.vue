<script setup lang="ts">
import Alert from '@/components/Alert.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar/index.js';
import { Button } from '@/components/ui/button';
import { getInitials } from '@/composables/useInitials';
import { relativeDate } from '@/lib/utils';

defineProps(['comment']);

defineEmits(['edit', 'delete']);
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
        <div class="flex-1">
            <HeadingSmall
                classes="break-all"
                :title="comment.body"
                :description="'By ' + comment.user.name + ' ' + relativeDate(comment.created_at) + ' ago'"
            >
                <div class="mt-1 flex justify-end space-x-3 empty:hidden">
                    <form v-if="comment.can?.update" @submit.prevent="$emit('edit', comment.id)">
                        <Button type="submit" class="text-xs uppercase hover:font-semibold hover:text-blue-500 hover:duration-200" variant="outline">
                            Edit
                        </Button>
                    </form>
                    <form v-if="comment.can?.delete">
                        <Alert
                            title="Are you sure?"
                            description="This will permanently delete the comment. This action cannot be undone."
                            positive-title="Delete"
                            :positive-action="() => $emit('delete', comment.id)"
                        >
                            <Button class="text-xs uppercase hover:font-semibold hover:text-red-500 hover:duration-200" variant="outline"
                                >Delete
                            </Button>
                        </Alert>
                    </form>
                </div>
            </HeadingSmall>
        </div>
    </div>
</template>
