<template>
    <div class="container-fluid mt-4">
        <h1 class="title">Gallery albums</h1>
        <table-search
            :count="data.length"
            resource="album"
            @searchQueryChanged="search = $event"
        />
        <div class="row">
            <div
                class="col-6 col-md-4"
                v-for="album in filteredItems"
                :key="album.id"
            >
                <div class="card mb-3 shadow" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img
                                v-bind:src="'/img/album-img/' + album.image"
                                class="card-img"
                                alt="Album cover image"
                            />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ album.title }}</h5>
                                <p class="card-text">
                                    <small class="text-muted"
                                        >Last updated
                                        {{ niceDate(album.updated_at) }}</small
                                    >
                                    <albumEditLinks
                                        resource="album"
                                        :id="album.id"
                                    />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import tableMixin from "../../mixins/tableMixin";
import AlbumEditLinks from "../../components/AlbumEditLinks";
import TableSearch from "../../components/TableSearch.vue";

export default {
    data() {
        return {
            albums: [],
            searchColumn: "title"
        };
    },
    components: {
        AlbumEditLinks,
        TableSearch
    },
    mixins: [tableMixin],
    created() {
        axios.get("/api/albums/").then(response => {
            this.data = response.data;
        });
    }
};
</script>

<style lang="scss" scoped>
.card-img {
    height: 100%;
    overflow: hidden;
    border-top-right-radius: 0%;
    border-bottom-right-radius: 0%;
}
</style>
