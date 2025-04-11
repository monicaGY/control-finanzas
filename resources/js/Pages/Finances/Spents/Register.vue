<template>
    <div>
        <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 row text-gray-900" data-bs-toggle="modal" data-bs-target="#modalAddRegister">
                <div class="col">Recorded movements</div>
                <div class="col-auto">
                    <a title="Add" href="javascript:void(0)" style="background-color: #fffc11" class="icon-add"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div v-for="item in spentsByCategories" class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 row text-gray-900">
                <div :style="{'background-color': item.iconColor}" class="icon-container">
                    <i :class="item.icon" class="fa-lg"></i>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">{{ item.category }}</div>
                        <div class="col-auto">{{item.amount}}</div>
                    </div>
                    <div class="row mt-3">
                        <button class="text-white col-auto btn btn-warning bg-orange-button ms-auto " @click="modalSpentsByCategory(item.categoryId)">Details</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['logSpents'],
    data(){
        return {
            spentsByCategory: []
        }
    },
    computed:{
        spentsByCategories(){
            return Object.values(
                this.logSpents.reduce((acc, item) => {
                    const categoryId = item["category-id"];
                    if (!acc[categoryId]) {
                        acc[categoryId] = {
                            icon: item.icon,
                            iconColor: item.iconColor,
                            category: item.category,
                            categoryId: item["category-id"],
                            amount: 0
                        };
                    }
                    acc[categoryId].amount += item.amount;
                    return acc;
                }, {})
            );
        }
    },
    methods: {
        modalSpentsByCategory(categoryId){
            this.$emit('showModalSpentsByCategory', categoryId)
        }
    }
}
</script>


<style>
.icon-container {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    margin: 5px;
}

.icon-add {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin: 3px;
}

</style>
