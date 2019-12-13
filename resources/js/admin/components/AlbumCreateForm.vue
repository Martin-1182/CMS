<template>
    <div>
        <div class="container mt-5">
            <div class="form-group">
                <label class="badge badge-info" for="title">Album title</label>
                <input
                    type="text"
                    v-model="title"
                    name="title"
                    class="form-control"
                    id="title"
					:class="{ 'is-invalid': errors.title }"
                />
				<div v-if="errors.title" class="invalid-feedback">
                    <div v-for="(error, index) in errors.title" :key="index">
                        {{ error }}
                    </div>
                </div>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label class=" mt-3 badge badge-info" for="text"
                    >Album text</label
                >
                <textarea
                    v-model="text"
                    class="form-control"
                    name="text"
                    id="text"
                    cols="30"
                    rows="10"
					:class="{ 'is-invalid': errors.text }"
                ></textarea>
				<div v-if="errors.text" class="invalid-feedback">
                    <div v-for="(error, index) in errors.text" :key="index">
                        {{ error }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input
                    type="file"
                    name="image"
                    v-on:change="onImageChange"
                    class="form-control"
                    :class="{ 'is-invalid': errors.image }"
                />
                <div v-if="errors.image" class="invalid-feedback">
                    <div v-for="(error, index) in errors.image" :key="index">
                        {{ error }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button
                    @click="submitForm"
                    type="button"
                    class="btn btn-success"
                >
                    Create
                </button>
                <button
                    @click="$router.go(-1)"
                    type="button"
                    class="btn btn-outline-danger"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["errors", "album"],
    data() {
        return {
            title: "",
            text: "",
            image: ""
        };
    },
    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        submitForm() {
            let data = {
                title: this.title,
                text: this.text,
                image: this.image
            };

            this.$emit("album-form-submitted", data);
        }
    },
    watch: {
        album(album) {
            this.title = album.title;
            this.text = album.text;
            this.image = album.image;
        }
    }
};
</script>

<style lang="scss" scoped>
input,
textarea {
    margin-top: 1em;
    width: 60%;
}

input[type="file"] {
    border: none;
    padding-left: 0;
}
</style>
