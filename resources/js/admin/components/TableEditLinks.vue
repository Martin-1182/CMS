<template>
    <div>

        <router-link :to="`/admin/${ resource }s/${ id }`"><i class="fa fa-eye text-info "> </i></router-link>
                            
        <router-link :to="`/admin/${ resource }s/${ id }/edit`"><i class="fa fa-edit text-success "></i></router-link>
                            
        <a @click="deleteResource"><i class="fas fa-trash-alt text-danger "></i></a>

    </div>

</template>

<script>
    export default {
        props: ['resource', 'id'],
                methods: {
          deleteResource() {
            if (window.confirm("Naozaj zmazať? Táto akcia je neodvolateľná!! ")) {
              axios.delete(`/api/${this.resource}s/${this.id}`).then(response => this.$router.go())
            }
            
          }
        },
        
    }
</script>

<style lang="scss" scoped>
div {
    display: flex;
    //justify-content: center;
}
a {
    padding: 5px;
    cursor: pointer;
}
a:hover {
    border: none;
    
}
</style>