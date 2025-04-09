<template>
    <div class="modal fade" id="modalAddRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Register movement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="error" class="alert alert-danger" role="alert">
                        {{error}}
                    </div>
                    <div v-if="message" class="alert alert-success" role="alert">
                        {{message}}
                    </div>

                    <div class="row justify-content-center">

                        <div class="col-3 form-check">
                            <input class="form-check-input" type="radio" value="1" v-model="form.type" id="typeExpenses">
                            <label class="form-check-label" for="typeExpenses">
                                Expenses
                            </label>
                        </div>
                        <div class="col-3 form-check">
                            <input class="form-check-input" type="radio" value="2" v-model="form.type" id="typeIncomes">
                            <label class="form-check-label" for="typeIncomes">Incomes</label>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label class="col-2 form-label">Date</label>
                        <div class="col">
                            <input class="form-control" type="date" v-model="form.date">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label class="col-2 form-label">Amount</label>
                        <div class="col">
                            <input class="form-control" placeholder="Introduce la cantidad" type="number" v-model="form.amount">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <label class="form-label">Select category: </label>
                    </div>
                    <div class="row">
                        <div class="col-auto" v-for="item in categories" @click="select = item.id">
                            <div class="icon-container" :style="{backgroundColor: item.iconColor, borderRadius: item.id ===select ? '10%' : '50%'}">
                                <i :class="item.icon" class="fa-lg"></i>
                            </div>
                            <label class="form-label">{{ item.name }}</label>
                        </div>

                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="add">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {route} from "ziggy-js";

export default {
    props: ['categoriesProps', 'dateProps'],
    data(){
        return {
            form: {
                type: 1,
                date: this.dateProps,
                amount: 100,
                categoryType: this.select
            },
            categories: this.categoriesProps,
            select: null,
            error: null,
            message: null,
        }
    },
    watch: {
        dateProps(){
            this.form.date = this.dateProps
        },
    },
    mounted() {
        this.categories  =this.formatCategories
    },
    computed: {
        formatCategories(){
            return this.categoriesProps.map(item => ({
                ...item,
                check: false,
            }));
        },
        add(){
            this.error = null
            this.form.category = this.select
            axios.post(route('spent.add'), this.form).then(() => {
                this.message = 'Successfully completed!'
                this.$emit('emitUploadSpents')
            }).catch(error => {
                this.error = error.response.data.message
            })
        }
    },
}
</script>

<style scoped>
</style>
