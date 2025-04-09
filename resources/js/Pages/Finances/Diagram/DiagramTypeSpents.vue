<template>
    <div ref="graphsTypeSpents">
    </div>
</template>
<script>
export default {
    props: ['diagramTypeSpents'],
    data(){
        return {
            chartBuild: null,
            canva: null
        }
    },
    watch: {
        diagramTypeSpents(){
            this.buildChartByMonth()
        }
    },
    mounted() {

        this.buildChartByMonth()
    },
    methods:{
        buildChartByMonth(){
            if (this.chartBuild) {
                this.chartBuild.destroy();
                this.chartBuild = null;
            }

            if (this.canva) {
                this.canva.remove();
                this.canva = null;
            }

            const container = this.$refs.graphsTypeSpents;

            this.canva = document.createElement('canvas');
            this.canva.style.minHeight = '250px';
            container.appendChild(this.canva);

            const ctx = this.canva.getContext('2d');

            this.chartBuild = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.diagramTypeSpents.labels,
                    datasets: [{
                        axis: 'y',
                        label: this.diagramTypeSpents.month,
                        data: this.diagramTypeSpents.data,
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
                        legend: { display: false },
                        title: {
                            display: true,
                            text: this.diagramTypeSpents.month
                        }
                    },
                    scales: {
                        x: { beginAtZero: true }
                    }
                }
            });

        },
    }
}

</script>



<style scoped>

</style>
