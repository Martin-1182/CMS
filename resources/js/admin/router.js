// router
window.Vue = require("vue");
import Router from "vue-router";
Vue.use(Router);

// views
import Dashboard from "./views/Dashboard.vue";
import NotFound from "./views/NotFound.vue";

// images
import Image from "./views/images/Image.vue";

// albums
import Album from "./views/albums/Album.vue";
import AlbumEdit from "./views/albums/AlbumEdit.vue";
import AlbumCreate from "./views/albums/AlbumCreate.vue";
import AlbumSingle from "./views/albums/AlbumSingle.vue";

// posts
import Posts from "./views/posts/Posts.vue";
import PostSingle from "./views/posts/PostSingle.vue";
import PostCreate from "./views/posts/PostCreate.vue";
import PostEdit from "./views/posts/PostEdit.vue";

// comments
import Comments from "./views/comments/Comments.vue";
import CommentSingle from "./views/comments/CommentSingle.vue";
import CommentEdit from "./views/comments/CommentEdit.vue";

// users
import Users from "./views/users/Users.vue";
import UserSingle from "./views/users/UserSingle.vue";

export default new Router({
    mode: "history",
    routes: [
        {
            path: "/admin/",
            component: Dashboard
        },
        // IMAGES
        {
            path: "/admin/images",
            component: Image
        },
        // ALBUMS
        {
            path: "/admin/albums",
            component: Album
        },
        {
            path: "/admin/albums/:id/edit",
            component: AlbumEdit
        },
        {
            path: "/admin/albums/new",
            component: AlbumCreate
        },
        {
            path: "/admin/albums/:id",
            component: AlbumSingle
        },
        // POSTS
        {
            path: "/admin/posts",
            component: Posts
        },
        {
            path: "/admin/posts/new",
            component: PostCreate
        },
        {
            path: "/admin/posts/:id",
            component: PostSingle
        },
        {
            path: "/admin/posts/:id/edit",
            component: PostEdit
        },
        // COMMENTS
        {
            path: "/admin/comments",
            component: Comments
        },
        {
            path: "/admin/comments/:id",
            component: CommentSingle
        },
        {
            path: "/admin/comments/:id/edit",
            component: CommentEdit
        },
        // USERS
        {
            path: "/admin/users",
            component: Users
        },
        {
            path: "/admin/users/:id",
            component: UserSingle
        },
        // 404
        {
            path: "/admin/404",
            component: NotFound
        },
        {
            path: "*",
            redirect: "/admin/404"
        }
    ]
});
