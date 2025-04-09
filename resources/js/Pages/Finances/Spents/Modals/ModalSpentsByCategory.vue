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
                    <div class="col container">
                        <div class="row align-items-center" v-for="item in spentsByCategory">
                            <div :style="{'background-color': item.iconColor}" class="icon-container col-auto">
                                <i :class="item.icon" class="fa-lg"></i>
                            </div>
                            <div class="col text-center">
                                <span v-if="!item.edit">{{item.amount}}</span>
                                <span v-else>
                                    <input class="text-center form-control" v-model="item.amountnew">
                                </span>

                            </div>
                            <div class="col-auto">
                                {{item.date}}
                            </div>
                            <div v-if="!item.edit" class="col-auto">
                                <a href="javascript:void(0)" title="Edit" @click="item.edit = true">
                                    <i class="fa-solid fa-pen-to-square" style="color: #63E6BE;"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a v-if="!item.edit" href="javascript:void(0)" @click="spentDelete(item.id)" title="Delete">
                                    <i class="fa-solid fa-xmark" style="color: #ff0000;"></i>
                                </a>
                                <a v-else href="javascript:void(0)" title="Save" @click="spentEdit(item.id, item)">
                                    <i class="fa-solid fa-check" style="color: #74C0FC;"></i>
                                </a>
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
            spentsByCategory: this.generateSpentsFormat
        }
    },
    watch: {
        spentsByCategoryProps(){
            this.edit = false
            this.category= this.spentsByCategoryProps.length === 0 ? '': this.spentsByCategoryProps[0].category
            this.spentsByCategory = this.generateSpentsFormat
        }
    },
    computed: {
        generateSpentsFormat(){
            return this.spentsByCategoryProps.map(item => ({
                ...item,
                amountnew: item.amount,
                edit: false,
            }));
        }
    },
    methods: {
        route,
        spentDelete(id){
            axios.delete(route('spent.delete', id))
                .then(() => {
                    this.$emit('emitUploadSpents')
                })
        },
        spentEdit(id, spent){
            this.error = null

            axios.put(route('spent.upload', id), {
                amount: spent.amountnew
            }).then(() => {
                spent.amount = spent.amountnew
                spent.edit = false
                this.$emit('emitUploadSpents')
                this.message = ''

            }).catch(error => {
                if(error.response){
                    this.error = error.response.data.message
                }
            })
        }
    }
}

</script>



<style scoped>

</style>
