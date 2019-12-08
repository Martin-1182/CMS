<template>
    <div>
        <add-images />
    </div>
</template>

<script>
import tableMixin from "../../mixins/tableMixin";
import AddImages from "../../components/AddImages";

export default {
    mixins: [tableMixin],
    data() {
        return {
            albums: [],
            searchColumn: "title"
        };
    },
    components: {
        AddImages
    }
};
</script>

<style lang="scss" scoped>
  @import '~vue-toastr/src/vue-toastr.scss';
</style>
