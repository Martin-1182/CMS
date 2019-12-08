<template>
    <section>
        
         <h1 class="title">Posts</h1>
          <table-search 
          :count="filteredItems.length"
          resource="post"
          @searchQueryChanged="search = $event"/>
            <table class="table">
                <thead class="the-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">User</th>
                    <th scope="col">Published at</th>
                    <th scope="col">Edit links</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr v-for="post in filteredItems" :key="post.id">                                   
                            <th scope="row">{{ post.id }}</th>
                                <td>{{ post.title}} <small class="text-muted">{{ shorten(post.text) }}</small></td>  
                                <td class="nowrap">
                                    <router-link :to="'/admin/users/' + post.user.id">{{ post.user.name }} </router-link>
                                </td>        
                                <td>{{ niceDate(post.created_at) }}</td>
                                <td class="edit-links">
                                    <table-edit-links resource="post" :id="post.id"/>
                                </td>
                        </tr>              
                    </tbody>
            </table>
    </section>
</template>

<script>
import tableMixin from '../../mixins/tableMixin';
import TableSearch from '../../components/TableSearch.vue';
import TableEditLinks from '../../components/TableEditLinks.vue';

    export default {
        data() {
            return {
                searchColumn: 'title'
            }
        },
        mixins:[tableMixin],
        components: {
            TableSearch,
            TableEditLinks,
        },
        created () {
            axios.get('/api/posts/').then(response => {
            this.data = response.data
})

        },
    }
</script>

<style lang="scss" scoped>

</style>