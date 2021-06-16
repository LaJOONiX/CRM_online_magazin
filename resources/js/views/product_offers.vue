<template>
  <div>
    <product_offers_table @deliver="deliver" :product_offers="product_offers" />
  </div>
</template>

<script>
import product_offers_table from "../components/tables/product_offers_table";
export default {
  name: "product_offers",
  components: {product_offers_table},
  metaInfo() {
    return { title: this.$title('Product Offers') }
  },
  data() {
    return {
      page: +this.$route.query.page || 1,
      res: {},
      loading: true,
      class_name: "product_offers",
      code: '',
    }
  },
  mounted() {
    this.$store.dispatch('fetch_product_offers').then((res) => {
      this.res = res
      this.loading = false
    })

    MicroModal.init()
  },
  computed: {

    product_offers() {
      return this.$store.getters.product_offers
    },

    pageSize() {
      return this.res.meta.per_page
    },

    pageCount() {
      return this.res.meta.last_page
    }
  },
  methods: {

    deliver(code) {
      console.log('Какой-то там блядский код', code)
      this.$store.dispatch('deliver_product_offer', code)
    },

    pageChangeHandler(page) {
      this.loading = true
      this.$router.push(`${this.$route.path}?page=${page}`)
      this.$store.dispatch(`fetch_${this.class_name}`, page).then(() => {
        this.loading = false
      })
    },

  },

}
</script>

<style scoped>

</style>
