<template>
  <ul class="sidenav app-sidenav" :class="{open: value}">
      <router-link
        v-for="link in links"
        :key="link.url"
        tag="li"
        active-class="active"
        :to="link.url"
        :exact="link.exact"
      >
        <a href="#" class="waves-effect pointer">{{link.title}}</a>
      </router-link>
      <a @click.prevent="reset()" class="reset btn waves-effect">Сбросить проект</a>
  </ul>
</template>


<script>
  import axios from 'axios'
  import localizeFilter from "../../filters/localize.filter"
  export default {
    props: ['value'],
    data: () => ({
      links: [
        { title: localizeFilter('Menu_Receipts'), url: '/', exact: true },
        { title: localizeFilter('Menu_Sales'), url: '/product_offers' },
        // { title: localizeFilter('Menu_Pickup_Points'), url: '/pickup_points' },
        { title: localizeFilter('Menu_Products'), url: '/products' },
        { title: localizeFilter('Menu_Clients'), url: '/clients' },
      ]
    }),
    methods: {
      reset() {
        this.$store.dispatch('auth_logout')
        axios.get('/api/reset')
      }
    }
  }
</script>

<style scoped>
  .pointer {
    font-size: 16px;
    font-weight:normal;
  }
  .sidenav {
    overflow-y: visible;
  }
  .reset {

    width: 100%;
    box-shadow: none;
    border-radius: 0;
    background: none !important;
    border: 2px solid #B8BAC4;
    color: #9C9DA7;
    border-right: 0;
    border-left: 0;
    text-shadow: 1px 0 rgb(5 25 128 / 25%);

    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none;   /* Chrome/Safari/Opera */
    -khtml-user-select: none;    /* Konqueror */
    -moz-user-select: none;      /* Firefox */
    -ms-user-select: none;       /* Internet Explorer/Edge */
    user-select: none;
  }
</style>
