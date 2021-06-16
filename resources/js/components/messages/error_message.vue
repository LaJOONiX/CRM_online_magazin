<template>
  <div class="success error-block closeable">
    <div class="cross"></div>
    <span> {{ message }} </span>
  </div>
</template>

<script>
export default {
  name: "error_message",
  props: ['message'],

  mounted() {
    this.init_closeable();
  },

  methods: {
    init_closeable() {
      for(let block of document.getElementsByClassName("closeable")){
        block.style.height = block.offsetHeight+"px";
        block.style.marginBottom = window.getComputedStyle(block).marginBottom;
      }
      document.body.addEventListener("click", (e) => {
        const cross = e.target.closest(".cross"),
          closeable = e.target.closest(".closeable");
        if (!(cross && closeable)) {
          return;
        }
        closeable.style.height = "0px";
        closeable.style.marginBottom = "0";

        closeable.querySelector("span").style.marginTop = "-20px";
        //
        setTimeout(() => {
          this.$store.dispatch('clear_error')
          closeable.remove();
        }, 1400);
      });
    }
  }
}
</script>

<style scoped>

</style>
