<template>
    <div class="row">
        <SpentsRegisterByMonth @showModalSpentsByCategory="showModalSpentsByCategory" class="col-6" :logSpents="logSpents"></SpentsRegisterByMonth>
        <DiagramTypeSpentsByMonth class="col-6" :diagramMonth="diagramMonth"></DiagramTypeSpentsByMonth>
    </div>
    <ModalSpentsByCategory :spentsByCategoryProps="spentsByCategory"></ModalSpentsByCategory>
</template>
<script>
import SpentsRegisterByMonth from "./Spents/Register.vue"
import DiagramTypeSpentsByMonth from "@/Pages/Finances/Diagram/DiagramTypeSpents.vue";
import ModalSpentsByCategory from "@/Pages/Finances/Spents/Modals/ModalSpentsByCategory.vue";
export default {
    props: ['logSpents', 'diagramMonth'],
    components: {ModalSpentsByCategory, DiagramTypeSpentsByMonth, SpentsRegisterByMonth},
    computed: {

    },
    data(){
        return {
            spentsByCategory: []
        }
    },
    methods: {
        showModalSpentsByCategory(categoryId){
            this.spentsByCategory = this.logSpents.filter(item => item['category-id'] === categoryId)
            $('#modalSpentsByCategory').modal('show');


        }
    }
}

</script>



<style scoped>

</style>
