<template>
    <div class="mt-4">
        <router-link
            :to="`/admin/${resource}s/new`"
            :class="`${css} btn btn-outline-success mr-2`"
            ><i class="fa fa-plus-square"></i> Create new
            {{ resource }}</router-link
        >
        <router-link
            :to="`/admin/${resource}s/${id}/edit`"
            class="btn btn-outline-info mr-2"
        >
            <i class="fa fa-edit"></i> Edit this {{ resource }}</router-link
        >
        <button @click="deleteResource" class="btn btn-outline-danger">
            <i class="fas fa-trash-alt"></i> Delete this {{ resource }}
        </button>
    </div>
</template>

<script>
export default {
	props: ["resource", "id", "css"],
	data() {
		return {
		}
	},
    computed: {
		class() {
			return this.class
		}
	},
    methods: {
        deleteResource() {
            if (
                window.confirm("Naozaj zmazať? Táto akcia je neodvolateľná!! ")
            ) {
                axios
                    .delete(`/api/${this.resource}s/${this.id}`)
                    .then(response =>
                        this.$router.push(`/admin/${this.resource}s`)
                    );
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.displayNone {
	display: none;
}
</style>
