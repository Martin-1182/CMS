<template>
    <div>
        <a class="navbar-brand" href="/">
            <img src="/img/sumar.svg" height="120" />
        </a>
        <nav>
            <h5 class="heading">ADMIN</h5>
            <li class="nav-item">
                <router-link to="/admin/">Dashboard</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/users">Users</router-link>
            </li>

            <h5 class="heading">BLOG</h5>
            <li class="nav-item">
                <router-link to="/admin/posts">Posts</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/comments">Comments</router-link>
            </li>

            <h5 class="heading">GALLERY</h5>
            <li class="nav-item">
                <router-link to="/admin/albums">Albums</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/images">Images</router-link>
            </li>

            <h5 class="heading">GENERAL</h5>
            <li class="nav-item"><a href="/">Homepage</a></li>
            <li class="nav-item">
                <a href="#" @click.prevent="logout">Logout</a>
            </li>
        </nav>
    </div>
</template>

<script>
export default {
    data: () => ({
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    }),
    methods: {
        logout: function() {
            axios
                .post("/logout")
                .then(response => {
                    if (response.status === 302 || 401) {
                        document.location.href = "/";
                    } else {
                        // throw error and go to catch block
                    }
                })
                .catch(error => {});
        }
    }
};
</script>

<style lang="scss" scoped></style>
