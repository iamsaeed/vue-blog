<template>
    <div>
        <h1 class="text-center">Computed Properties</h1>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group ">
                                    <input type="text" class="form-control" placeholder="Item Description" v-model="item.description">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <input type="number" class="form-control" placeholder="Qty" v-model="item.qty">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <input type="number" class="form-control" placeholder="Price" v-model="item.price">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <input type="number" class="form-control" placeholder="Discount" v-model="item.discount">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <input type="number" class="form-control" placeholder="Amount" v-model="amount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-2">
                                Total
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <input type="number" class="form-control" placeholder="Total">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return {
            item : {
                description : '',
                qty : 0,
                price : 500,
                discount : 0,

            }
        }
    },
    computed : {
        amount(){
            return (this.item.price * this.item.qty) - this.item.discount
        },
        grand_total(){

        }
    },
    methods : {

    }
}
</script>
