<template>
    <div class="row stats-container">
        <div class="card shadow the-dark mb-3 stats">
            <div class="card-header text-center">
                <i class="fas fa-pencil-alt fa-2x"></i>
            </div>
            <div class="card-body text-center">
                <h4 class="card-title text-center">
                    Posts <br />
                    <span class="badge badge-secondary"> {{ postCount }}</span>
                </h4>
            </div>
        </div>
        <div class="card shadow  the-dark mb-3 stats">
            <div class="card-header text-center">
                <i class="fas fa-comment fa-2x"></i>
            </div>
            <div class="card-body text-center">
                <h4 class="card-title text-center">
                    Comments <br />
                    <span class="badge badge-secondary">
                        {{ commentCount }}</span
                    >
                </h4>
            </div>
        </div>
        <div class="card shadow the-dark mb-3 stats">
            <div class="card-header text-center">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div class="card-body">
                <h4 class="card-title text-center">
                    Users <br />
                    <span class="badge badge-secondary"> {{ userCount }}</span>
                </h4>
            </div>
        </div>
        <div class="card shadow the-dark mb-3 stats">
            <div class="card-header text-center">
                <i class="fas fa-images fa-2x"></i>
            </div>
            <div class="card-body">
                <h4 class="card-title text-center">
                    Albums <br />
                    <span class="badge badge-secondary"> {{ albumCount }}</span>
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            postData: [],
            commentData: [],
            userData: [],
            albumData: []
        };
    },
    mounted() {
        axios.get("/api/posts").then(response => {
            this.postData = response.data;
        });
        axios.get("/api/comments").then(response => {
            this.commentData = response.data;
        });
        axios.get("/api/users").then(response => {
            this.userData = response.data;
        });
        axios.get("/api/albums").then(response => {
            this.albumData = response.data;
        });
    },
    computed: {
        postCount() {
            return this.postData && this.postData.length;
        },
        commentCount() {
            return this.commentData && this.commentData.length;
        },
        userCount() {
            return this.userData && this.userData.length;
        },
        albumCount() {
            return this.albumData && this.albumData.length;
        }
    }
};
</script>

<style lang="scss" scoped>
.stats {
    margin-right: 1em;
    width: 18rem;
}
.stats-container {
    display: flex;
    justify-content: center;
    flex-direction: row;
}
</style>
