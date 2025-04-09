<template>
    <div class="row">
        <SpentsRegisterByMonth @showModalSpentsByCategory="showModalSpentsByCategory" class="col-6" :logSpents="logSpents"></SpentsRegisterByMonth>
        <DiagramCategorySpents class="col-6" :diagramCategorySpents="diagramCategorySpents"></DiagramCategorySpents>
    </div>
    <ModalAddRegister :categoriesProps="categories" @emitUploadSpents="uploadSpents" :dateProps="dateProps"></ModalAddRegister>
    <ModalSpentsByCategory :spentsByCategoryProps="spentsByCategory" @emitUploadSpents="uploadSpents"></ModalSpentsByCategory>
</template>
<script>
import SpentsRegisterByMonth from "./Spents/Register.vue"
import DiagramCategorySpents from "@/Pages/Finances/Diagram/DiagramCategorySpents.vue";
import ModalSpentsByCategory from "@/Pages/Finances/Spents/Modals/ModalSpentsByCategory.vue";
import ModalAddRegister from "@/Pages/Finances/Spents/Modals/ModalAddRegister.vue";
import {route} from "ziggy-js";
export default {
    props: ['logSpentsProps', 'diagramCategorySpentsProps', 'categoriesProps', 'dateProps'],
    components: {ModalSpentsByCategory, DiagramCategorySpents, SpentsRegisterByMonth, ModalAddRegister},
    data(){
        return {
            spentsByCategory: [],
            logSpents: this.logSpentsProps,
            diagramCategorySpents: this.diagramCategorySpentsProps,
            categories: this.categoriesProps,
            categoryId: null
        }
    },
    watch:{
        diagramCategorySpentsProps(){
            this.diagramCategorySpents = this.diagramCategorySpentsProps
        },
        logSpentsProps(){
            this.logSpents = this.logSpentsProps
        }
    },
    methods: {
        showModalSpentsByCategory(categoryId){
            this.categoryId = categoryId
            this.spentsByCategory = this.logSpents.filter(item => item['category-id'] === this.categoryId)
            $('#modalSpentsByCategory').modal('show');
        },
        async uploadSpents(){
            this.$emit('emitUploadSpents')
            if(this.spentsByCategory.length === 0){
                $('#modalSpentsByCategory').modal('hide');
            }
        }
    }
}

</script>



<style scoped>

</style>
