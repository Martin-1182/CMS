<template>
    <div > 
        <h1 class="mt-5">Create album</h1>
       <album-create-form
        :errors="errors"
        @album-form-submitted="submitForm"
       />

    </div>
</template>

<script>
import AlbumCreateForm from "../../components/AlbumCreateForm";
    export default {
        data() {
            return {
                errors: {},
            }
        },
        components: {
            AlbumCreateForm,
        },
                methods: {           
            submitForm(data) {                 
                axios.post('/api/albums', data).then(response => {
                       this.$toastr.s('Album uplaoded successfully');
                       this.$router.push('/admin/albums')
            }).catch(errors => {
                   this.errors = errors.response.data.errors
                })
            }
        }, 
        
    }
</script>

<style lang="scss" scoped>

</style>