<template>
  <div>

    <Loader v-if="loading" />

    <p class="center" v-else-if="!pickup_points.length">
      {{ 'NoRecords' | localize }}
    </p>

    <div v-else>
      <pickup_points_table :pickup_points="pickup_points" />
      <Paginate
        v-model="page"
        :page-count="pageCount"
        :margin-pages="2"
        :click-handler="pageChangeHandler"
        :prev-text="'&laquo;'"
        :next-text="'&raquo;'"
        :container-class="'pagination'"
        :page-class="'waves-effect'"
        :active-class="'indigo lighten-4'"
      />
    </div>

  </div>
</template>

<script>
import pickup_points_table from "../components/tables/pick-up_points_table";
export default {
  name: "pick-up_points",
  components: {pickup_points_table},
  metaInfo() {
    return { title: this.$title('Pickup Points') }
  },
  data() {
    return {
      page: +this.$route.query.page || 1,
      res: {},
      loading: true,
      class_name: "pickup_points",
      code: ''
    }
  },
  computed: {

    pickup_points() {
      return this.$store.getters.pickup_points
    },
    pageSize() {
      return this.res.meta.per_page
    },
    pageCount() {
      return this.res.meta.last_page
    }
  },

  mounted() {
    this.$store.dispatch('fetch_pickup_points').then(res => {
      this.loading = false
      this.res = res
    })

    console.log(this.pickup_points)
  },
  methods: {
    pageChangeHandler(page) {
      this.loading = true
      this.$router.push(`${this.$route.path}?page=${page}`)
      this.$store.dispatch(`fetch_${this.class_name}`, page).then(() => {
        this.loading = false
      })
    }
  }
}
</script>

<style scoped>

</style>
