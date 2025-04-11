<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
      <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>-->

        <div class="py-12">
            <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="col-auto">
                    <vue-cal date-picker :views="['year', 'month']" style="height: 27rem; min-width: 20rem;background-color: #e6e4e4" @cell-click="logEvents($event)" @view-change="handleViewChange($event)"/>
                </div>
                <div class="col bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DiagramTypeSpents :diagramTypeSpents="diagramTypeSpents"></DiagramTypeSpents>
                </div>
            </div>

            <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class=" text-gray-900">
                        <DashboardFinances @emitUploadSpents="updateSpents"
                                           :diagramCategorySpentsProps="diagramCategorySpents"
                                           :logSpentsProps="logSpents"
                                           :categoriesProps="categories"
                                           :dateProps="date">
                        </DashboardFinances>
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
import { VueCal } from 'vue-cal'
import 'vue-cal/style'
import DiagramTypeSpents from "@/Pages/Finances/Diagram/DiagramTypeSpents.vue";
import {route} from "ziggy-js";

export default {
    props: ['logSpentsProps', 'categories', 'diagramCategorySpentsProps', 'diagramTypeSpentsProps'],
    components: {DiagramTypeSpents, AuthenticatedLayout, DashboardFinances, Head, VueCal},
    computed:{
        dateFormat(){
            let date = new Date()
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
    },
    data(){
        return {
            date: null,
            view: 'month',
            diagramTypeSpents: this.diagramTypeSpentsProps,
            diagramCategorySpents: this.diagramCategorySpentsProps,
            logSpents: this.logSpentsProps,
            days: [],
            check: true,
        }
    },
    created() {
        this.date = this.dateFormat;
    },
    watch:{
        days(){
            if(this.check === true){
                this.check = false

                setTimeout(() => {
                    if(this.days.length === 2){
                        this.date = this.days[1]
                    }else if(this.days.length === 1){
                        this.date = this.days[0]
                    }
                    this.days = []
                    this.updateSpents()
                   // this.buildDiagrams()
                },100)
            }
        }
    },
    methods: {
        logEvents(e){
            if(this.view === 'month' && this.days.length !== 2){
                this.date = this.transformDate(e.cell.start)
                $('#modalAddRegister').modal('show');
            }
        },
        handleViewChange(e){
            this.check = true
            this.days = [...this.days, e.start]
            this.view = e.id
        },
        transformDate(date){
            date = new Date(date);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
        async updateSpents(){
            let year = new Date(this.date).getFullYear()
            let date = new Date(this.date)
            const month = String(date.getMonth() + 1).padStart(2, '0');

            await this.buildDiagrams(year, month)
            await this.updateLogSpents(year, month)
        },
        async buildDiagrams(year, month){
            let params = {year: year}

            if(this.view === 'year'){
                let response = await axios.get(route('diagram.type.spents', params))
                this.diagramTypeSpents = response.data
                response = await axios.get(route('diagram.type.category', params))
                this.diagramCategorySpents = response.data
            }

            if(this.view === 'month'){
                params.month = month
                let response = await axios.get(route('diagram.type.spents', params))
                this.diagramTypeSpents = response.data
                response = await axios.get(route('diagram.type.category', params))
                this.diagramCategorySpents = response.data
            }
        },
        async updateLogSpents(year, month){
            let params = { year: year }
            if(this.view === 'month') {
                params.month = month
            }
            let response = await axios.get(route('spents.log.date', params))
            this.logSpents = response.data
        }
    }

}
</script>
