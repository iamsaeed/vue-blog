<template>
    <div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div v-if="showCreateForm">
                    <h1>Add Category</h1>
                    <form @submit.prevent="addCategory">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" v-model="category.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control"  v-model="category.description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <h1>
                    Category Page
                    <small @click="showCreateForm = !showCreateForm">+</small>
                </h1>
                <table class="table table-borderless table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories">
                        <td>{{category.id}}</td>
                        <td>{{category.name}}</td>
                        <td>{{category.description}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary">View</a>
                            <a class="btn btn-sm btn-warning">Edit</a>
                            <a class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>

        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            category : {
                name: '',
                description : ''
            },
            categories : [],
            showCreateForm : false,
        }
    },
    created(){
        this.getCategories();
    },
    methods : {
        getCategories(){
            let _this = this;
            axios({
                method: 'get',
                url: '/api/categories-get'
            }).then(function (response) {
                _this.categories = response.data.categories
            }).catch(function (error) {
                console.log(error);
            });
        },
        addCategory(){
            // adding category
            let _this = this;
            axios({
                method: 'post',
                url: '/api/categories-store',
                data : _this.category
            }).then(function (response) {
                _this.category = {
                    name: '',
                    description : ''
                }
                _this.getCategories();
            }).catch(function (error) {
                console.log(error);
            });
        }
    }

}

</script>


<style>
/*css*/
</style>

