<template>
    <div class="modal fade" id="modalSpentsByCategory" tabindex="-1" aria-labelledby="modalLabelSpentsByCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabelSpentsByCategory">Transaction records for: {{category}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="error" class="alert alert-warning" role="alert">
                        {{error}}
                    </div>
                    <div v-if="message" class="alert alert-success" role="alert">
                        {{message}}
                    </div>
                    <div class="col container">
                        <div class="row align-items-center" v-for="item in spentsByCategory">
                            <div :style="{'background-color': item.iconColor}" class="icon-container col-auto">
                                <i :class="item.icon" class="fa-lg"></i>
                            </div>
                            <div class="col-auto">
                                {{item.type}}
                            </div>
                            <div class="col text-center">
                                <span v-if="!item.edit">{{item.amount}}</span>
                                <span v-else>
                                    <input class="text-center form-control" type="number" v-model="item.amountnew">
                                </span>

                            </div>
                            <div class="col-auto">
                                <span v-if="!item.edit">{{item.date}}</span>
                                <span v-else>
                                    <input class="text-center form-control" type="date" v-model="item.dateNew" >
                                </span>
                            </div>
                            <div v-if="!item.edit && !item.load" class="col-auto">
                                <a href="javascript:void(0)" title="Edit" @click="item.edit = true">
                                    <i class="fa-solid fa-pen-to-square" style="color: #63E6BE;"></i>
                                </a>
                            </div>
                            <div class="col-auto" v-if="!item.load">
                                <a v-if="!item.edit" href="javascript:void(0)" @click="item.load = true; spentDelete(item.id, item)" title="Delete">
                                    <i class="fa-solid fa-xmark" style="color: #ff0000;"></i>
                                </a>
                                <a v-else href="javascript:void(0)" title="Save" @click="item.load = true; spentEdit(item.id, item)">
                                    <i class="fa-solid fa-check" style="color: #74C0FC;"></i>
                                </a>
                            </div>
                            <div v-if="item.load" class="col-auto">
                                <div class="spinner-border text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
import {route} from "ziggy-js";

export default {
    props: ['spentsByCategoryProps'],
    data(){
        return{
            category: this.spentsByCategoryProps.length === 0 ? '': this.spentsByCategoryProps[0].category,
            error: null,
            spentsByCategory: this.generateSpentsFormat,
            message: null
        }
    },
    watch: {
        spentsByCategoryProps(){
            this.message = null
            this.error = null
            this.category= this.spentsByCategoryProps.length === 0 ? '': this.spentsByCategoryProps[0].category
            this.spentsByCategory = this.generateSpentsFormat
        }
    },
    computed: {
        generateSpentsFormat(){
            return this.spentsByCategoryProps.map(item => ({
                ...item,
                amountnew: item.amount,
                dateNew: this.formartDate(item.date),
                edit: false,
                load: false,
            }));
        }
    },
    methods: {
        route,
        formartDate(date){
            let dateSplit = date.split('/');
            return `${dateSplit[2]}-${dateSplit[1]}-${dateSplit[0]}`;
        },
        spentDelete(id, spent){
            axios.delete(route('spent.delete', id))
                .then(() => {
                    this.$emit('emitUploadSpents')
                    this.message = 'Successfully completed!'
                }).finally(() => {
                    spent.load = false
                })
        },
        spentEdit(id, spent){
            this.error = null

            axios.put(route('spent.upload', id), {
                amount: spent.amountnew,
                date: spent.dateNew
            }).then(() => {
                let dateSplit = spent.dateNew.split('-');
                let date = `${dateSplit[2]}/${dateSplit[1]}/${dateSplit[0]}`;

                spent.amount = spent.amountnew
                spent.date = date
                spent.edit = false
                this.$emit('emitUploadSpents')
                this.message = ''

            }).catch(error => {
                if(error.response){
                    this.error = error.response.data.message
                }
            }).finally(() => {
                spent.load = false
            })
        }
    }
}

</script>



<style scoped>

</style>
