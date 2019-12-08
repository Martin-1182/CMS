
<template>
    <div class="container"> 
        <header class="user-head text-center mt-4">
            
           <h1>{{user.name}}</h1>
        </header>
        

           <section>
               <h3>Posts this user</h3>
               <div v-for="post in user.posts" :key="post.id">
                   <ul><li>Post title -> {{ post.title }}</li></ul>
               </div>
           </section>
               

       
        <section>
            <h3>Comments this user</h3>
            <div v-for="comment in user.comments" :key="comment.id">
                <ul>
                    <li>Comment text -> 
                        <em>{{ comment.text }}</em>
                    </li>
                </ul>
            </div>

        </section>
      <!--  <single-edit-links resource="user" :id="user.id"/> -->
    </div>
     
</template>
<script>

// import SingleEditLinks from '../../components/SingleEditLinks.vue';
import moment from 'moment'
    export default {
        data() {
            return {
                user: {
                    post:{},
                    comment:{}
                }
            }
        },
        created () {
            axios.get('/api/users/' + this.$route.params.id).then( response => {
                this.user = response.data 
                console.error('Dokonči to :)');
                
            })
            .catch(error => {
                return this.$router.push('/admin/404')
           });
            
        },
        components: {
          //  SingleEditLinks,   
        },
        methods: {
            metaDate(datetime) {
            return moment(datetime).format('DD.MM.Y ⌚ HH.mm.ss')
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
.user {
  display: inline-block;
  width: 10em;
  height: 10em;
  border-radius: 50%;

  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}
section {
    padding-top: 1em;
    border-top: 3px solid black;
}

</style>