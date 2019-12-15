<template>
    <div>
        <h1>
            Edit album <small>{{ album.title }}</small>
        </h1>
        <album-create-form
            :album="album"
            :errors="errors"
            @album-form-submitted="submitForm"
        />
    </div>
</template>

<script>
import AlbumCreateForm from "../../components/AlbumCreateForm";
export default {
    components: {
        AlbumCreateForm
    },
    data() {
        return {
            album: {},
            errors: {}
        };
    },
    created() {
        axios.get("/api/albums/" + this.$route.params.id).then(response => {
            this.album = response.data;
        });
    },
    methods: {
        submitForm(data) {
            let id = this.$route.params.id;

            axios
                .patch(`/api/albums/${id}`, data)
                .then(response => {
                    this.$toastr.s("Album updated");
                    this.$router.push("/admin/albums");
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
