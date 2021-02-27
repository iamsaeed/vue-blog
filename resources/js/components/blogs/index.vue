<template>
    <div class="container">
        <div class="row" v-if="showForm">
            <div class="col">
                <h1>{{isEditable ? 'Edit Blog' : 'Add Blog'}}</h1>
                <form @submit.prevent="addBlog">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" v-model="blog.name" class="form-control">
                        <span class="text-danger" v-if="errors">{{errors.name[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" v-model="blog.slug" class="form-control">
                        <span class="text-danger" v-if="errors">{{errors.slug[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control" v-model="blog.category_id">
                            <option disabled selected value="">Select Category</option>
                            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                        </select>
                        <span class="text-danger" v-if="errors">{{errors.category_id[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Select Tags</label>
                        <select class="form-control" v-model="selectedTag" @change="addToTags">
                            <option disabled selected value="">Select Tags</option>
                            <option v-for="tag in tags" :value="tag">{{tag.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span v-for="tag in blog.tags" class="bg-danger p-1 m-1 rounded text-white">
                            {{tag.name}}
                            <span @click="removeFromTag(tag)" style="cursor:pointer; padding: 1px">x</span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  v-model="blog.description"></textarea>
                        <span class="text-danger" v-if="errors">{{errors.description[0]}}</span>
                    </div>
                    <button type="submit" class="btn btn-primary" v-if="!loader">Submit</button>
                    <button type="button" class="btn btn-primary" disabled v-else>
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                        Saving...
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Blogs
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
                    <tr v-for="(blog, index) in blogs">
                        <td>{{++index}}</td>
                        <td>
                            <span>{{blog.name}}</span>
                        </td>
                        <td>
                            <span>{{blog.description}}</span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" @click="editBlog(blog)">Edit</a>
                            <a class="btn btn-sm btn-danger" @click="confirmBlog(blog.id)">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            blog : {
                category_id : '',
                tags: []
            },
            blogs : [],
            showForm : true,
            isEditable : false,
            errors : '',
            success : '',
            loader : false,
            categories : [],
            tags : [],
            selectedTag : {}
        }
    },
    created() {
        this.getBlogs();
        this.getActiveCategories();
        this.getActiveTags();
    },
    methods : {
        addToTags(){
            if(!this.isDuplicate(this.selectedTag, this.blog.tags)) {
                this.blog.tags.push(this.selectedTag);
            }
        },
        removeFromTag(tag){
          this.blog.tags.splice(this.blog.tags[this.blog.tags.indexOf(tag)],1)
        },
        isDuplicate(data, dataArray) {
            for (let i = 0; i < dataArray.length; i++) {
                if (data.id === dataArray[i].id) {
                    return true;
                }
            }
            return false;
        },
        getActiveTags(){
            let _this = this;
            axios({
                method: 'post',
                url: '/api/get-all-active',
                data : {'table' : 'tags'}
            }).then(function (response) {
                _this.tags = response.data.data
            }).catch(function (error) {
                console.log(error);
            });
        },
        getActiveCategories(){
            let _this = this;
            axios({
                method: 'post',
                url: '/api/get-all-active',
                data : {'table' : 'categories'}
            }).then(function (response) {
                _this.categories = response.data.data
            }).catch(function (error) {
                console.log(error);
            });
        },
        addBlog(){
            let _this = this;
            _this.loader = true;
            axios({
                method: 'post',
                url: '/api/blogs-store',
                data : _this.blog
            }).then(function (response) {
                _this.getBlogs();
                _this.loader = false;
            }).catch(function (error) {
                console.log(error);
                _this.loader = false;
            });
        },
        getBlogs(){
            let _this = this;
            axios({
                method: 'get',
                url: '/api/blogs-get'
            }).then(function (response) {
                _this.blogs = response.data.blogs
                _this.blog = {category_id : '', tags: []}
            }).catch(function (error) {
                console.log(error);
            });
        },
        editBlog(blog){
            this.isEditable = true;
            this.blog = blog;
        },
        confirmBlog(blog_id){

        }
    }
}
</script>
