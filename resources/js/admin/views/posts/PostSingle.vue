
<template>
    <div>
          
          <img :src="`/img/post-img/${post.image}`" alt="post image">
          <h1><span class="text-muted ">Post ☛</span>  {{ post.title }}</h1>
          <div class="text" v-html="post.text"></div>
          <table class="table table-bordered the-dark mt-4">
            <thead>
                <tr>
                <th scope="col">ID</th>
                
                <th scope="col">SLUG</th>
                <th scope="col">CREATED AT</th>
                <th scope="col">UPDATE AT</th>
                
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">{{ post.id }}</th>
              
                <td>{{ post.slug }}</td>
                <td>{{ metaDate(post.created_at) }}</td>
                <td>{{ metaDate(post.updated_at) }}</td>
                </tr>
               
            </tbody>
</table> 
        <single-edit-links resource="post" :id="post.id"/>
    </div>
</template>

<script>
import SingleEditLinks from '../../components/SingleEditLinks.vue';
import moment from 'moment'
    export default {
        data() {
            return {
                post: {}
            }
        },
        created () {
            axios.get('/api/posts/' + this.$route.params.id).then( response => {
                this.post = response.data
            })
            .catch(error => {
                return this.$router.push('/admin/404')
            });
            
        },
        components: {
            SingleEditLinks,
        },
        methods: {
            metaDate(datetime) {
            return moment(datetime).format('DD.MM.Y ⌚ HH:mm:ss')
         }
        },
        
    }
</script>

<style lang="scss" scoped>

.text-muted {
    font-size: 25px;
}
.text {
    //width: 90%;
    font-size: 1.2em;
    padding-top: 2em;
}
img {
    width: 40em;
    margin: 2em 0 2em;
    border-radius: 0.3em;
}

</style>