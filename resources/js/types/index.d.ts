import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    component: string;
    icon?: LucideIcon;
    isActive?: boolean;
    when?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface PaginatedResponse {
    links: {
        first: string;
        last: string;
        next: string | null;
        prev: string | null;
    }
    meta: {
        current_page: number;
        per_page: number;
        total: number;
        from: number;
        to: number;
        last_page: number;
        path: string;
        links: {
            url: string | null;
            label: string;
            active: boolean;
        }[];
    },
}

export type BreadcrumbItemType = BreadcrumbItem;
