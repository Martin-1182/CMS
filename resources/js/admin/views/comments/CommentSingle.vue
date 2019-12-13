<template>
    <div class=" container text">
        <h1><i class="fa fa-comments"></i> {{ comment.user.name }}</h1>
        <p class="text">{{ comment.text }}</p>
        <table class="table table-bordered the-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">POST</th>
                    <th scope="col">USER</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">UPDATE AT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ comment.id }}</th>
                    <th scope="row">{{ comment.post.title }}</th>
                    <th scope="row">{{ comment.user.name }}</th>
                    <td>{{ metaDate(comment.created_at) }}</td>
                    <td>{{ metaDate(comment.updated_at) }}</td>
                </tr>
            </tbody>
        </table>
        <single-edit-links css="displayNone" resource="comment" :id="comment.id" />
    </div>
</template>
<script>
import SingleEditLinks from "../../components/SingleEditLinks.vue";
import moment from "moment";
export default {
    data() {
        return {
            comment: {
                user: {},
                post: {}
            },

        }
    },
    created() {
        axios
            .get("/api/comments/" + this.$route.params.id)
            .then(response => {
                this.comment = response.data;
            })
            .catch(error => {
                return this.$router.push("/admin/404");
            });
    },
    components: {
        SingleEditLinks
    },
    methods: {
        metaDate(datetime) {
            return moment(datetime).format("DD.MM.Y ⌚ HH:mm:ss");
        }
    }
};
</script>

<style lang="scss" scoped>
.text-muted {
    font-size: 25px;
}
.text {
    //width: 90%;
    font-size: 1.2em;
    margin: 2em 0 2em;
}
.container {
    margin-left: 0;
}
single-edit-links {
    .not-new {
        display: none;
    }
}
.displayNone {
	display: none;
}
</style>
