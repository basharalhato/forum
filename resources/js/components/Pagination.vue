<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Pagination,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/components/ui/pagination';
import type { PaginatedResponse } from '@/types';
import { router } from '@inertiajs/vue3';

defineProps<{
    paginate: PaginatedResponse;
}>();
</script>

<template>
    <Pagination
        :items-per-page="paginate.meta.per_page"
        :total="paginate.meta.total"
        :sibling-count="1"
        show-edges
        :default-page="paginate.meta.current_page"
        class="mx-auto"
    >
        <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <div v-if="paginate.meta.last_page === 1">
                <div class="mt-4 text-center text-gray-500">No more items to show.</div>
            </div>
            <div v-if="paginate.meta.last_page !== 1">
                <PaginationFirst v-on:click="() => router.visit(paginate.links.first, { preserveScroll: true })" />
                <PaginationPrev v-if="paginate.links.prev" v-on:click="() => router.visit(paginate.links.prev!, { preserveScroll: true })" />

                <template v-for="(item, index) in items">
                    <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                        <Button
                            class="h-10 w-10 p-0"
                            :variant="item.value === paginate.meta.current_page ? 'default' : 'outline'"
                            v-on:click="() => router.visit(paginate.meta.path + '?page=' + item.value, { preserveScroll: true })"
                        >
                            {{ item.value }}
                        </Button>
                    </PaginationListItem>
                </template>

                <PaginationNext v-if="paginate.links.next" v-on:click="() => router.visit(paginate.links.next!, { preserveScroll: true })" />
                <PaginationLast v-on:click="() => router.visit(paginate.links.last, { preserveScroll: true })" />
            </div>
        </PaginationList>
    </Pagination>
</template>
