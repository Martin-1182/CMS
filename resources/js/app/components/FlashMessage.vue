<template>
  <transition name="fade">
    
    <div class="notification shadow alert alert-info" role="alert" v-show="visible">{{ message }}</div>
    
  </transition>
</template>

<script>
export default {
  props: ["text"],
  data() {

    return { 

      visible: false,
      message: ''
      
      }
  },

  created() {
    if (this.text) {

      this.message = this.text
      this.show()

    }

     this.$root.$on('flash', message => {

       this.message = message
       this.show()
     })

  },

  methods: {
    show() {
      this.visible = true;

      setTimeout(() => {
        this.hide();
      }, 3000);
    },

    hide() {
      this.visible = false;
    }
  }
};
</script>

<style lang="scss" scoped>
.notification {
  max-width: 40%;
  text-align: center;
  position: fixed;
  right: 2em;
  bottom: 2em;
}
.fa-window-close {
  font-size: 11px;
  color: black;
  position: absolute;
  top: 3px;
  right: 3px;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>