<template>
    <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <canvas id="chartBuildByCategories"></canvas>
            <canvas id="chartBuildByCategoriesTypeIncomes"></canvas>
        </div>
    </div>
</template>
<script>
export default {
    props: ['diagramCategorySpents'],
    mounted() {
        this.buildDiagramTypeExpenses()
        this.buildDiagramTypeIncomes()
    },
    data(){
        return {
            chartBuild: null,
            chartIncomes: null,
            titleIncomes: 'Income Distribution',
            titleExpenses: 'Expense Distribution',
        }
    },
    watch: {
        diagramCategorySpents(){
            this.buildDiagramTypeExpenses()
            this.buildDiagramTypeIncomes()
        }
    },
    methods:{
        getSpents(typeSpent) {
            return this.diagramCategorySpents
                .filter(item => item['type-id'] === typeSpent)
                .map(item => item.total);
        },

        getCategories(typeSpent) {
            return this.diagramCategorySpents
                .filter(item => item['type-id'] === typeSpent)
                .map(item => item.category);
        },

        getColorsIcon(typeSpent) {
            return this.diagramCategorySpents
                .filter(item => item['type-id'] === typeSpent)
                .map(item => item.iconColor);
        },
        buildDiagramTypeExpenses(){
            if(this.chartBuild){
                this.chartBuild.destroy()
            }

            const ctx = document.getElementById('chartBuildByCategories');

            this.chartBuild = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: this.getCategories(1),
                    datasets: [{
                        label: 'Total',
                        data: this.getSpents(1),
                        backgroundColor: this.getColorsIcon(1),
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: this.titleExpenses,
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            });
        },
        buildDiagramTypeIncomes(){
            if(this.chartIncomes){
                this.chartIncomes.destroy()
            }

            const ctx = document.getElementById('chartBuildByCategoriesTypeIncomes');

            this.chartIncomes = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: this.getCategories(2),
                    datasets: [{
                        label: 'Total',
                        data: this.getSpents(2),
                        backgroundColor: this.getColorsIcon(2),
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: this.titleIncomes,
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            });

        }
    }
}

</script>



<style scoped>

</style>
