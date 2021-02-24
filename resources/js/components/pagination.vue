<template>
    <div>
        <br>
        <div class="text-center">
            <button :disabled="this.paginationData.current_page === 1" class="btn btn-sm btn-primary" @click="paginate('back')"> Back </button>
            <button class="btn btn-sm btn-danger">{{paginationData.current_page}}</button>
            <button :disabled="this.paginationData.current_page === this.paginationData.last_page" class="btn btn-sm btn-primary" @click="paginate('next')"> Next </button>
        </div>
        <br>
    </div>
</template>

<script>
export default {
    props : ['paginationData'],
    data(){
        return {

        }
    },
    methods : {
        paginate(direction){
            if(direction === 'back'){
                this.paginationData.current_page -= 1
                this.$emit('paginate', this.paginationData.current_page)
            } else {
                this.paginationData.current_page += 1
                this.$emit('paginate', this.paginationData.current_page)
            }
        },
    }
}
</script>
