<template>
    <div class="row max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <canvas id="chartBuildByCategories"></canvas>
        </div>
    </div>
</template>
<script>
export default {
    props: ['diagramCategorySpents'],
    mounted() {
        this.buildDiagramCategorySpents()
    },
    data(){
        return {
            chartBuild: null
        }
    },
    watch: {
        diagramCategorySpents(){
            this.buildDiagramCategorySpents()
        }
    },
    computed:{
        spents(){
            return this.diagramCategorySpents.map(item => item.total);
        },
        categories(){
            return this.diagramCategorySpents.map(item => item.category);
        }
    },
    methods:{
        buildDiagramCategorySpents(){
            if(this.chartBuild){
                this.chartBuild.destroy()
            }

            const ctx = document.getElementById('chartBuildByCategories');

            this.chartBuild = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: this.categories,
                    datasets: [{
                        label: 'Total',
                        data: this.spents,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        }
    }
}

</script>



<style scoped>

</style>
