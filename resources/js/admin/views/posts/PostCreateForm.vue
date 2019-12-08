<template>
    <div class="container mt-4">
        <div class="form-group">
            <label for="title" class="badge badge-success">NEW POST ↓</label>
            <input
                class="form-control form-control-lg "
                :class="{ 'is-invalid': errors.title }"
                id="title"
                type="text"
                name="title"
                placeholder="Post title"
                autocomplete="off"
                v-model="title"
            />
            <div v-if="errors.title" class="invalid-feedback">
                <div v-for="(error, index) in errors.title" :key="index">
                    {{ error }}
                </div>
            </div>
        </div>
        <div class="form-group">
            <input
                class="form-control form-control-lg"
                :class="{ 'is-invalid': errors.slug }"
                type="text"
                name="slug"
                placeholder="slug"
                autocomplete="off"
                v-model="slug"
                readonly
            />
            <div v-if="errors.slug" class="invalid-feedback">
                <div v-for="(error, index) in errors.slug" :key="index">
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
            <label for="x" class="badge badge-info">YOUR TEXT ↓ </label>

            <input id="x" value="" type="hidden" name="text" v-model="text" />
            <trix-editor
                input="x"
                class="form-control"
                :class="{ 'is-invalid': errors.text }"
            >
            </trix-editor>
            <div v-if="errors.text" class="invalid-feedback">
                <div v-for="(error, index) in errors.text" :key="index">
                    {{ error }}
                </div>
            </div>
        </div>
        <div class="form-group">
            <button @click="submitForm" type="button" class="btn btn-success">
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
</template>

<script>
import trix from "trix";

export default {
    props: ["errors", "post"],
    data() {
        return {
            title: "",
            text: "",
            image: ""
        };
    },
    mounted() {
        document.addEventListener("trix-change", () => {
            this.text = document.getElementById("x").value;
        });
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
                slug: this.slug,
                image: this.image,
                user_id: 1
            };

            this.$emit("post-form-submitted", data);
        }
    },
    computed: {
        slug() {
            return _.trim(
                _.deburr(this.title.toLowerCase()) // diacritics
                    .replace(/[^\w\s]/gi, "") // special characters
                    .replace(/ {2,}/g, " ") // repeating spaces
                    .replace(/ /g, "-"), // space to -
                "-" // trailing -
            );
        }
    },
    watch: {
        post(post) {
            this.title = post.title;
            this.text = post.text;
            this.slug = post.slug;
            this.image = post.image;

            let trix = document.querySelector("trix-editor");
            trix.editor.insertHTML(post.text);
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~trix/dist/trix.css";
input,
textarea {
    margin-top: 1em;
    width: 60%;
}

trix-editor {
    min-height: 20em;
}
input[type="file"] {
    border: none;
    padding-left: 0;
}
</style>
