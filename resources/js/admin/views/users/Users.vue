<template>
    <section>
        <h1 class="title">Users</h1>
          <table-search 
          :count="data.length"
          resource="user"
          @searchQueryChanged="search = $event"/>
            <table class="table">
                <thead class="the-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Registred at</th>
                    <th scope="col">Edit links</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr v-for="user in filteredItems" :key="user.id">                                   
                        <th scope="row">{{ user.id }}</th>                      

                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ niceDate(user.created_at) }}</td>
                        <td class="edit-links">
                                    <table-edit-links resource="user" :id="user.id"/>
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
        mixins: [tableMixin],
        components: {
            TableSearch,
            TableEditLinks
        },
        data() {
            return {
                searchColumn: 'name'
            }
        },
        created () {
            axios.get('/api/users/').then(response => {
            this.data = response.data
          })
        }
    }
</script>

<style lang="scss" scoped>
.user {
    padding: 2em 2em;
}

</style>