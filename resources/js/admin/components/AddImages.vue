<template>
    <div class="container">
        <div
            class="uploader"
            @dragenter="OnDragEnter"
            @dragleave="OnDragLeave"
            @dragover.prevent
            @drop="onDrop"
            :class="{ dragging: isDragging }"
        >
            <div class="upload-control" v-show="images.length">
                <label for="file">Select a file</label>
                <button @click="upload">Upload</button>
                <select class="upc" v-model="album_id">
                    <option value="" selected data-default>Select album</option>
                    <option
                        v-for="album in albums"
                        :key="album.id"
                        :value="album.id"
                    >
                        {{ album.title }}
                    </option>
                </select>
            </div>

            <div v-show="!images.length">
                <i class="fas fa-cloud-upload-alt fa-4x"></i>
                <p>Drag your images here</p>
                <div>OR</div>
                <div class="file-input">
                    <label for="file">Select a file</label>
                    <input
                        type="file"
                        id="file"
                        @change="onInputChange"
                        multiple
                    />
                </div>
            </div>

            <div class="images-preview" v-show="images.length">
                <div
                    class="img-wrapper"
                    v-for="(image, index) in images"
                    :key="index"
                >
                    <img :src="image" :alt="`Image Uplaoder ${index}`" />
                    <div class="details">
                        <span
                            class="name badge badge-warning mb-1 "
                            v-text="files[index].name"
                        ></span>
                        <span
                            class="size badge badge-info"
                            v-text="getFileSize(files[index].size)"
                        ></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        isDragging: false,
        dragCount: 0,
        files: [],
        images: [],
        album_id: "",
        albums: []
    }),
    created() {
        axios.get("/api/albums/").then(response => {
            this.albums = response.data;
        });
    },
    methods: {
        OnDragEnter(e) {
            e.preventDefault();

            this.dragCount++;
            this.isDragging = true;
            return false;
        },
        OnDragLeave(e) {
            e.preventDefault();
            this.dragCount--;
            if (this.dragCount <= 0) this.isDragging = false;
        },
        onInputChange(e) {
            const files = e.target.files;
            Array.from(files).forEach(file => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            this.isDragging = false;
            const files = e.dataTransfer.files;
            Array.from(files).forEach(file => this.addImage(file));
        },
        addImage(file) {
            if (!file.type.match("image.*")) {
                this.$toastr.e(`${file.name} is not an image`);
                return;
            }
            this.files.push(file);
            const img = new Image(),
                reader = new FileReader();
            reader.onload = e => this.images.push(e.target.result);
            reader.readAsDataURL(file);
        },
        getFileSize(size) {
            const fSExt = ["Bytes", "KB", "MB", "GB"];
            let i = 0;

            while (size > 900) {
                size /= 1024;
                i++;
            }
            return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
        },
        upload() {
            const formData = new FormData();

            this.files.forEach(file => {
                formData.append("images[]", file, file.name);
            });
            formData.append("album_id", this.album_id);
            if (this.album_id <= 0) {
                this.$toastr.e("Album is required");
                return;
            }

            axios.post("/api/images/", formData).then(response => {
                this.$toastr.s("All images uplaoded successfully");
                this.images = [];
                this.files = [];
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.uploader {
    width: 100%;
    background: #292929;
    color: #fff;
    padding: 40px 15px;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #fff;
    font-size: 20px;
    position: relative;
    &.dragging {
        background: #fff;
        color: #292929;
        border: 3px dashed #292929;
        .file-input label {
            background: #292929;
            color: #fff;
        }
    }
    i {
        font-size: 85px;
    }
    .file-input {
        width: 200px;
        margin: auto;
        height: 68px;
        position: relative;
        label,
        input {
            background: #fff;
            color: #292929;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            padding: 10px;
            border-radius: 4px;
            margin-top: 7px;
            cursor: pointer;
        }
        input {
            opacity: 0;
            z-index: -2;
        }
    }
    .images-preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
        .img-wrapper {
            width: 160px;
            display: flex;
            flex-direction: column;
            margin: 10px;
            height: 150px;
            justify-content: space-between;
            background: #fff;
            box-shadow: 5px 5px 20px #3e3737;
            img {
                max-height: 105px;
            }
        }
        .details {
            font-size: 12px;
            background: #fff;
            color: #000;
            display: flex;
            flex-direction: column;

            padding: 5px 10px;
            .name {
                padding-top: 3px;
                overflow: hidden;
                height: 18px;
            }
        }
    }
    .upload-control {
        position: absolute;
        width: 100%;
        background: #fff;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;
        button,
        label {
            background: #292929;
            border: 2px solid #292929;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }
        label {
            padding: 2px 5px;
            margin-right: 10px;
        }
    }
}
.upc {
    padding: 1.3px;
    margin-left: 8px;
    background: #292929;
    border: 2px solid #292929;
    border-radius: 3px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
}
select option[data-default] {
    background: #292929!important;
}
select option {
	background: #292929!important;
}
select option[data-default] {
    background: #292929!important;
}
</style>
