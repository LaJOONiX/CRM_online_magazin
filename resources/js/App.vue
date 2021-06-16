<template>
  <div id="app">
    <component :is="layout">
    </component>
  </div>
</template>

<script>
import axios from 'axios'
import EmptyLayout from './layouts/EmptyLayout';
import MainLayout from './layouts/MainLayout';
import store from './store'
export default {

  name: "App",
  computed: {
    layout() {
      return (this.$route.meta.layout || "empty") + "-layout";
    }
  },
  components: {
    EmptyLayout,
    MainLayout,
  },
  created() {
    axios.interceptors.response.use(undefined, err => {
      return new Promise((resolve, reject) => {
        if (err.response.status === 401 && this.$route.name !== 'login') {
          store.dispatch('auth_logout')
          reject()
        } else {
          resolve()
        }
      })
    })
  },
}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Quantico&display=swap');
@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
@import "../sass/materialize";
</style>
