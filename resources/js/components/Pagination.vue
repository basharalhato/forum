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
import type { paginatedResponse } from '@/types';
import { router } from '@inertiajs/vue3';

interface Props {
    paginate: paginatedResponse;
    only?: Array;
}

const props = withDefaults(defineProps<Props>(), {
    only: () => [],
});

const routeOptions = { preserveScroll: true, only: props.only };
</script>

<template>
    <Pagination
        :items-per-page="props.paginate.meta.per_page"
        :total="props.paginate.meta.total"
        :sibling-count="1"
        show-edges
        :default-page="props.paginate.meta.current_page"
        class="mx-auto"
    >
        <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <div v-if="props.paginate.meta.last_page === 1">
                <div class="mt-4 text-center text-gray-500">No more items to show.</div>
            </div>
            <div v-if="props.paginate.meta.last_page !== 1">
                <PaginationFirst v-on:click="() => router.visit(props.paginate.links.first, routeOptions)" />
                <PaginationPrev v-if="props.paginate.links.prev" v-on:click="() => router.visit(props.paginate.links.prev!, routeOptions)" />

                <template v-for="(item, index) in items">
                    <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                        <Button
                            class="h-10 w-10 p-0"
                            :variant="item.value === props.paginate.meta.current_page ? 'default' : 'outline'"
                            v-on:click="() => router.visit(props.paginate.meta.path + '?page=' + item.value, routeOptions)"
                        >
                            {{ item.value }}
                        </Button>
                    </PaginationListItem>
                </template>

                <PaginationNext
                    v-if="props.paginate.links.next"
                    v-on:click="() => router.visit(props.paginate.links.next!, routeOptions)"
                />
                <PaginationLast v-on:click="() => router.visit(props.paginate.links.last, routeOptions)" />
            </div>
        </PaginationList>
    </Pagination>
</template>
