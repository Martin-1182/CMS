<template>
    <div class="container mt-5">
        <h1 class="heading mb-5">Edit comment</h1>
        <h4 class="mb-2">{{ shorten(comment.post.title) }}</h4>
        <p class="post-text mb-1" v-html="comment.post.text"></p>
        <div class="meta-data muted mb-5">
            <i class="fal fa-calendar-plus mr-1"></i>
            <strong> {{ niceDate(comment.post.updated_at) }}</strong>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="badge badge-warning"
                >Update your comment</label
            >
            <textarea
                v-model="text"
                name="text"
                class="form-control"
                id="exampleFormControlTextarea1"
                rows="3"
                placeholder="Please type your comment here"
            ></textarea>
        </div>
        <button @click="submitForm" class="btn btn-primary btn-sm mb-4">
            update comment
        </button>
        <button @click="deleteComment" class="btn btn-danger btn-sm mb-4">
            delete comment
        </button>
    </div>
</template>

<script>
import tableMixin from "../../mixins/tableMixin";
export default {
    data() {
        return {
            text: "",
            comment: {
                user: {},
                post: {}
            }
        };
    },
    mixins: [tableMixin],
    created() {
        axios.get("/api/comments/" + this.$route.params.id).then(response => {
            this.comment = response.data;
        });
    },
    watch: {
        comment(comment) {
            this.text = comment.text;
        }
    },
    methods: {
        submitForm() {
            let data = {
                text: this.text
            };
            let id = this.$route.params.id;
            axios
                .patch(`/api/comments/${id}`, data)
                .then(response => {
                    this.$toastr.s("Comment updated");
                    this.$router.push(`/admin/comments/${id}`);
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                    this.$toastr.e(errors.message);
                });
        },
        deleteComment() {
            if (
                window.confirm("Naozaj zmazať? Táto akcia je neodvolateľná!! ")
            ) {
                axios
                    .delete(`/api/${this.comments}/${this.id}`)
                    .then(response =>
                        this.$router.push(`/admin/${this.resources}`)
                    );
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.post-text {
    font-size: 1.1em;
}
</style>
