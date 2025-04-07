<template>
    <div>
        <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="mx-3 my-4 row text-gray-900">
                <canvas style="min-height:250px" id="chartBuildByCategories" ></canvas>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    props: ['diagramMonth'],
    data(){
        return {
            chartBuild: null,
        }
    },
    mounted() {
        console.log('diagram', this.diagramMonth)
        this.buildChartByMonth()
    },
    methods:{
        buildChartByMonth(){

            const ctx = document.getElementById('chartBuildByCategories');

            this.chartBuild = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.diagramMonth.labels,
                    datasets: [{
                        axis: 'y',
                        label: this.diagramMonth.month,
                        data: this.diagramMonth.data,
                        backgroundColor: [
                            'rgba(255,206,111,0.5)',
                            'rgba(255,167,250,0.5)'
                        ],
                        borderColor: [
                            'rgb(255,187,99)',
                            'rgb(238,161,241)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: this.diagramMonth.month
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
    }
}

</script>



<style scoped>

</style>
