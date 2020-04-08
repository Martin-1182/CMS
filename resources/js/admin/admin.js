import "../bootstrap";
window.Vue = require("vue");
import Toastr from "vue-toastr";
Vue.use(Toastr);
import router from "./router";
require("../../../node_modules/sweetalert2/dist/sweetalert2.all");
require("./main-admin.js");

// import
Vue.component("Admin", require("./Admin.vue").default);

// skeleton
const admin = new Vue({
    router,
    render: h => h("Admin")
}).$mount("#admin");