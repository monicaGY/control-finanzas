<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Calendar
                    </div>

                </div>
            </div>
            <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class=" text-gray-900">
                        <DashboardFinances :logSpents="logSpents" :typeSpents="typeSpents"></DashboardFinances>
                    </div>
                </div>
            </div>

        </div>
        <div>
        </div>
    </AuthenticatedLayout>

</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DashboardFinances from "@/Pages/Finances/Index.vue"
import { Head } from '@inertiajs/vue3';
export default {
    props: ['logSpents', 'typeSpents'],
    components: {AuthenticatedLayout, DashboardFinances, Head}
}
</script>
