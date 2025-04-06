import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import {formatDistance, parseISO} from "date-fns";

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export const relativeDate = (date: string): string => formatDistance(parseISO(date), new Date());
