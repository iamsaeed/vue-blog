<template>
    <div>
        <messages :messages="success" @hideMessage="success = ''" className="alert-success"></messages>
        <messages :messages="error" @hideMessage="error = ''" className="alert-danger"></messages>

        <h1>{{isEditable ? 'Edit Category' : 'Add Category'}}</h1>
        <form @submit.prevent="addCategory">
            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="category.name" class="form-control">
                <span class="text-danger" v-if="errors">{{errors.name[0]}}</span>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control"  v-model="category.description"></textarea>
                <span class="text-danger" v-if="errors">{{errors.description[0]}}</span>
            </div>
            <button type="submit" class="btn btn-primary" v-if="!loader">Submit</button>
            <button type="button" class="btn btn-primary" disabled v-else>
                <div class="spinner-border spinner-border-sm" role="status"></div>
                Saving...
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props : [ 'editCategory', 'isEditable' ],
    data(){
        return {
            success : '',
            category : {
                name: '',
                description : ''
            },
            errors : '',
            error : '',
            loader : false,
        }
    },
    watch: {
        editCategory: function (val) {
           this.category = val
        },
    },
    created(){

    },
    methods : {
        addCategory(){
            // adding category
            let _this = this;
            _this.loader = true;
            axios({
                method: 'post',
                url: '/api/categories-store',
                data : _this.category
            }).then(function (response) {
                _this.success = response.data.message;
                _this.category = {
                    name: '',
                    description : ''
                }
                _this.$emit('refresh');
                _this.loader = false;
            }).catch(function (error) {
                _this.errors = error.response.data.errors;
                _this.error = error.response.data.message;
                _this.loader = false;
            });
        },
    }
}
</script>
