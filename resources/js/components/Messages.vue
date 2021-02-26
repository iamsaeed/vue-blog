<template>
    <div class="container" v-if="messages">
        <div class="row">
            <div class="col">
                <div class="alert alert-dismissible fade show" role="alert" :class="className">
                    {{messages}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" @click="hideAlert">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : ['messages', 'className'],
    methods : {
        hideAlert(){
            this.$emit('hideMessage')
        }
    }
}
</script>
