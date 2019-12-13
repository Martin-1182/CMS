<template>
    <div>
        <h1>Create new posts</h1>
        <post-create-form :errors="errors" @post-form-submitted="submitForm" />
    </div>
</template>

<script>
import PostCreateForm from "./PostCreateForm";
export default {
    data() {
        return {
            errors: {}
        };
    },
    components: {
        PostCreateForm
    },
    methods: {
        submitForm(data) {
            axios
                .post("/api/posts", data)
                .then(response => {
                    this.$toastr.s("Post created");
                    this.$router.push(`/admin/posts/${response.data.post.id}`);
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                    this.$toastr.e(errors.message);
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
