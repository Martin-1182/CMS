<template>
    <p class="edit-links">
        <router-link
            class="float-right text-info"
            :to="`/admin/${resource}s/${id}/edit`"
        >
            <i class="far fa-edit"></i
        ></router-link>
        <a
            class="float-right text-danger"
            @click="deleteResource"
            style="cursor:pointer;"
            ><i class="far fa-trash-alt"></i
        ></a>
        <router-link
            class="float-right text-success"
            :to="`/admin/${resource}s/${id}`"
        >
            <i class="far fa-eye"></i
        ></router-link>
    </p>
</template>

<script>
export default {
    props: ["resource", "id"],
    methods: {
        deleteResource() {
            if (
                window.confirm(
                    "Naozaj zmazať " +
                        this.resource +
                        "? Táto akcia je neodvolateľná!!"
                )
            ) {
                axios
                    .delete(`/api/${this.resource}s/${this.id}`)
                    .then(response => this.$router.go());
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.card-text a {
    padding-right: 6px;
    color: #292929;
}
.add-image-btn {
    position: absolute;
}
.edit-links {
    position: absolute;
    right: 1px;
    bottom:3px;
}
</style>
