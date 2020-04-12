<template>
    <div class="container">
        <h1 class="title pt-4">
            <router-link :to="'/admin/albums/'"
                ><i class="far fa-images"></i
            ></router-link>
            <small>Album|</small>
            {{ album.title }}
            <br />
            <em class="badge badge-info">{{ niceDate(album.created_at) }}</em>
        </h1>
        <div class="grid">
            <div class="grid-sizer"></div>

            <div v-for="image in album.images" :key="image.id">
                <div class="grid-item p-1">
                    <img
                        @click="() => del(image.id)"
                        v-bind:src="'/img/gallery-img/' + image.image"
                        class="card-img image"
                        alt="Album image"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Click to delete image"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import tableMixin from "../../mixins/tableMixin";
import Isotope from "isotope-layout";
import imagesLoaded from "imagesloaded";

export default {
    mixins: [tableMixin],
    data() {
        return {
            album: {
                images: {}
            }
        };
    },
    created() {
        axios
            .get("/api/albums/" + this.$route.params.id)
            .then(response => {
                this.album = response.data;
            })
            .catch(error => {
                return this.$router.push("/admin/404");
            });
    },
    methods: {
        del(id) {
            if (
                window.confirm("Naozaj zmazať? Táto akcia je neodvolateľná!! ")
            ) {
                axios.delete("/api/images/" + id).then(response => {
                    this.$toastr.s("Image deleted successfully");
                    this.$router.go();
                });
            }
        }
    }
};
</script>

<style lang="scss" scoped>
em {
    font-size: 15px;
}
.text {
    position: relative;
}
img {
    cursor: pointer;
}
</style>
