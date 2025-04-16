<script setup lang="ts">
import { toast, Toaster } from '@/components/ui/toast';
import AppLayout from '@/layouts/app/AppHeaderLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

interface Flash {
    success?: null;
    error?: null;
}

onMounted(() => {
    watch(
        () => usePage<{ flash: Flash }>().props.flash,
        (flash: Flash) => {
            if (flash.success) {
                toast({
                    title: flash.success,
                });
                flash.success = null;
            } else if (flash.error) {
                toast({
                    title: flash.error,
                    variant: 'destructive',
                });
                flash.error = null;
            }
        },
        { immediate: true },
    );
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Toaster />
        <slot />
    </AppLayout>
</template>
