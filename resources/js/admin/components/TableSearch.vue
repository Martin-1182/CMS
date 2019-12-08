<template>
    <div class="col-12">
        <div class="row">
            <div class="input-group mb-3 col-3 pl-0">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"
                        ><small class="counter text-muted text-left mr-3"
                            >{{ count }} {{ resource }}s </small
                        ><i class="fas fa-filter"></i
                    ></span>
                </div>
                <input
                    type="text"
                    class="form-control"
                    :placeholder="'Find a ' + resource"
                    v-model="searchQuery"
                />
            </div>
            .
            <div class="">
                <router-link
                    :to="`/admin/${resource}s/new`"
                    class=" form-control btn btn-outline-success float-right"
                    >Add new {{ resource }}</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        count: {
            type: Number,
            default: 0
        },
        resource: {
            type: String
        }
    },
    data() {
        return {
            searchQuery: ""
        };
    },
    watch: {
        searchQuery(value) {
            this.$emit("searchQueryChanged", value);
        }
    }
};
</script>

<style lang="scss" scoped>
.btn {
    cursor: pointer;
}
</style>
