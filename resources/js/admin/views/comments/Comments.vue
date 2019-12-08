<template>
    <section>
        <h1 class="title">Comments</h1>
        <table-search
            :count="filteredItems.length"
            resource="comment"
            @searchQueryChanged="search = $event"
        />
        <table class="table">
            <thead class="the-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Post</th>
                    <th scope="col">User</th>
                    <th scope="col">Published at</th>
                    <th scope="col">Edit links</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="comment in filteredItems" :key="comment.id">
                    <th scope="row">{{ comment.id }}</th>
                    <td>{{ shorten(comment.text) }}</td>
                    <td class="nowrap">
                        <router-link :to="'/admin/posts/' + comment.post_id">
                            <strong> <i class="fa fa-eye pr-1"> </i> </strong>
                            {{ comment.post_id }}
                        </router-link>
                    </td>
                    <td class="nowrap">
                        <router-link :to="'/admin/users/' + comment.user.id">
                            {{ comment.user.name }}
                        </router-link>
                    </td>

                    <td>{{ niceDate(comment.created_at) }}</td>
                    <td class="edit-links">
                        <table-edit-links resource="comment" :id="comment.id" />
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
import TableSearch from "../../components/TableSearch.vue";
import tableMixin from "../../mixins/tableMixin";
import TableEditLinks from "../../components/TableEditLinks.vue";
export default {
    data() {
        return {
            searchColumn: "text"
        };
    },
    mixins: [tableMixin],
    components: {
        TableSearch,
        TableEditLinks
    },

    created() {
        axios.get("/api/comments/").then(response => {
            this.data = response.data;
        });
    }
};
</script>

<style lang="scss" scoped>
.comment {
    padding: 2em 2em;
}
</style>
