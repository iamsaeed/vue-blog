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
                <h1>
                    Category Page
                    <small @click="showCreateForm = !showCreateForm">+</small>
                </h1>
                <span class="text-success" v-if="success">{{success}}</span>

                <form class="form-inline" @submit.prevent="getCategories">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control form-control-sm" v-model="search.name" placeholder="Name">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control form-control-sm" v-model="search.description" placeholder="Description">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mb-2">Filter</button>
                    <button type="button" @click="reset" class="btn btn-sm btn-danger mb-2">Reset</button>
                </form>

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
                        <td>
                            <span @dblclick="searchOnClick('name', category.name)">{{category.name}}</span>
                        </td>
                        <td>
                            <span  @dblclick="searchOnClick('description', category.description)">{{category.description}}</span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" @click="editCategory(category)">Edit</a>
                            <a class="btn btn-sm btn-danger" @click="deleteCategory(category.id)">Delete</a>
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
            search : {
                name : '',
                description : ''
            },
            category : {
                name: '',
                description : ''
            },
            categories : [],
            showCreateForm : false,
            errors : '',
            success : '',
            loader : false,
            isEditable : false
        }
    },
    created(){
        this.getCategories();
    },
    methods : {
        reset(){
            this.search = {
                name : '',
                    description : ''
            }
            this.getCategories();
        },
        searchOnClick(key, value){
              if(key === 'name'){
                  this.search.name = value;
              }
            if(key === 'description'){
                this.search.description = value;
            }
            this.getCategories();
        },
        getCategories(){
            let _this = this;
            axios({
                method: 'get',
                url: '/api/categories-get?'
                    +'name='+_this.search.name
                    +'&description='+_this.search.description
            }).then(function (response) {
                _this.categories = response.data.categories
            }).catch(function (error) {
                console.log(error);
            });
        },
        editCategory(category){
            this.isEditable = true
            this.category = category
            this.showCreateForm = true;
        },
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
                _this.getCategories();
                _this.showCreateForm=false;
                _this.loader = false;
            }).catch(function (error) {
                _this.errors = error.response.data.errors;
                _this.loader = false;
            });
        },
        deleteCategory(id){
            // adding category
          if(confirm('Are you sure?')){
              let _this = this;
              _this.loader = true;
              axios({
                  method: 'post',
                  url: '/api/categories-delete',
                  data : {id : id}
              }).then(function (response) {
                  _this.success = response.data.message;
                  _this.getCategories();
                  _this.loader = false;
              }).catch(function (error) {
                  _this.errors = error.response.data.errors;
                  _this.loader = false;
              });
          }
        }
    }

}

</script>


<style>
/*css*/
</style>

