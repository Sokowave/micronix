<!-- resources/js/components/UserMenu.vue -->

<script setup lang="ts">
import { computed } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import UserMenuAction from '@/components/UserMenuAction.vue'
import {
    BadgeCheck,
    CircleX,
    LayoutDashboard,
    LogIn,
    LogOut,
    Package,
    UserLock,
} from 'lucide-vue-next'

import type { PageProps } from '@/types/page'

import UserMenuItem from '@/components/UserMenuItem.vue'

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

const page = usePage<PageProps>()

const user = computed(() => page.props.auth.user)

const initials = computed(() => {
    if (!user.value?.name) {
        return ''
    }

    return user.value.name
        .split(' ')
        .map(name => name.charAt(0))
        .join('')
        .substring(0, 2)
        .toUpperCase()
})

const menuItems = computed(() => [
    {
        label: 'Dashboard',
        href: page.props.routes.backoffice.dashboard,
        icon: LayoutDashboard,
    },
    {
        label: 'Products',
        href: page.props.routes.backoffice.products,
        icon: Package,
    },
])

function logout() {
    router.post(page.props.routes.backoffice.logout)
}
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <button
                type="button"
                aria-label="User menu"
                class="group flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow transition hover:shadow-lg"
            >
                <span
                    v-if="user"
                    class="text-sm font-bold"
                >
                    {{ initials }}
                </span>

                <UserLock
                    v-else
                    class="size-5 transition-transform group-hover:scale-110"
                />
            </button>
        </DropdownMenuTrigger>

        <DropdownMenuContent
            align="end"
            :side-offset="12"
            class="w-80 overflow-hidden rounded-2xl border border-slate-200 bg-white p-0 shadow-xl"
        >
            <!-- Logged In -->
            <template v-if="user">
                <DropdownMenuLabel class="bg-gradient-to-br from-brand-50 via-white to-green-50 p-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 font-bold text-white"
                        >
                            {{ initials }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <h3 class="truncate text-sm font-semibold text-slate-900">
                                {{ user.name }}
                            </h3>

                            <p class="truncate text-xs text-slate-500">
                                {{ user.email }}
                            </p>

                            <div
                                class="mt-2 inline-flex items-center gap-1 rounded-md px-2 py-1 text-[11px] font-medium"
                                :class="
                                    user.status === 'active'
                                        ? 'bg-green-50 text-green-700'
                                        : 'bg-red-50 text-red-700'
                                "
                            >
                                <BadgeCheck
                                    v-if="user.status === 'active'"
                                    class="size-3.5"
                                />

                                <CircleX
                                    v-else
                                    class="size-3.5"
                                />

                                {{ user.status === 'active'
                                    ? 'Active Account'
                                    : 'Inactive Account' }}
                            </div>
                        </div>
                    </div>
                </DropdownMenuLabel>

                <DropdownMenuSeparator />

                <div class="p-2">
                    <UserMenuItem
                        v-for="item in menuItems"
                        :key="item.href"
                        :href="item.href"
                        :icon="item.icon"
                    >
                        {{ item.label }}
                    </UserMenuItem>
                </div>

                <DropdownMenuSeparator />

                <div class="p-2">
                    <UserMenuAction
                        :icon="LogOut"
                        variant="danger"
                        @click="logout"
                    >
                        Logout
                    </UserMenuAction>
                </div>
            </template>

            <!-- Guest -->
            <template v-else>
                <div class="bg-gradient-to-br from-brand-50 via-white to-green-50 p-6 text-center">
                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-brand-600 text-white"
                    >
                        <UserLock class="size-7" />
                    </div>

                    <h3 class="mt-4 text-base font-semibold text-slate-900">
                        Staff Portal
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Sign in with your staff account to access the backoffice dashboard.
                    </p>

                    <Link
                        :href="page.props.routes.backoffice.login"
                        class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-brand-600 px-4 py-3 text-sm font-medium text-white transition hover:from-brand-600 hover:to-brand-700"
                    >
                        <LogIn class="size-5" />

                        Sign In
                    </Link>
                </div>
            </template>
        </DropdownMenuContent>
    </DropdownMenu>
</template>