<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { HTMLAttributes } from 'vue';

interface Props {
    title: string;
    description?: string;
    classes?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <header>
        <h3 :class="cn('mb-0.5 text-base font-medium', classes)">{{ title }}</h3>
        <p v-if="description" class="text-sm text-muted-foreground">
            {{ description }}
        </p>
        <slot />
    </header>
</template>
