<template>
    <div class="modal fade" id="modalSpentsByCategory" tabindex="-1" aria-labelledby="modalLabelSpentsByCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabelSpentsByCategory">Transaction records for: {{category}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col container">
                        <div class="row align-items-center" v-for="item in spentsByCategoryProps">
                            <div :style="{'background-color': item.iconColor}" class="icon-container col-auto">
                                <i :class="item.icon" class="fa-lg"></i>
                            </div>
                            <div class="col text-center">
                                {{item.amount}}
                            </div>
                            <div class="col-auto">
                                {{item.date}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
export default {
    props: ['spentsByCategoryProps'],
    data(){
        return{
            category: this.spentsByCategoryProps.length === 0 ? '': this.spentsByCategoryProps[0].category
        }
    },
    watch: {
        spentsByCategoryProps(){
            this.category= this.spentsByCategoryProps.length === 0 ? '': this.spentsByCategoryProps[0].category
        }
    }
}

</script>



<style scoped>

</style>
