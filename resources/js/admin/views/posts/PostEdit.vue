<template>
    <div>
        <h1>Edit post</h1>
        <post-create-form
        :post="post"
        :errors="errors"
        @post-form-submitted="submitForm"
        />
   </div>
</template>

<script>
import PostCreateForm from "./PostCreateForm";
    export default {
        data() {
            return {
                errors: {},
                post: {}
            }
        },
        components: {
            PostCreateForm
        },
        methods: {
            submitForm(data) {
                  let id = this.$route.params.id
                axios.patch(`/api/posts/${id}`, data).then(response => {
                       this.$router.push(`/admin/posts/${id}`)
            }).catch(errors => {
                   this.errors = errors.response.data.errors
                })
            }
        },
         created () {
            axios.get('/api/posts/' + this.$route.params.id).then( response => {
                this.post = response.data
            }).catch(error => {
                return this.$router.push("/admin/404");
            });
        },
    }
</script>

<style lang="scss" scoped>

</style>