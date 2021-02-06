<template>
    <div class="row">
        <div class="col">
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
    </div>
</template>

<script>
export default {
    data(){
        return {
            categories : []
        }
    },
    created() {
        this.fetchCategories();
    },
    methods : {
        fetchCategories(){
            let _this = this;
            axios({
                method: 'get',
                url: 'api/categories-get',
            }).then(function (response) {
                _this.categories = response.data.categories
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>
