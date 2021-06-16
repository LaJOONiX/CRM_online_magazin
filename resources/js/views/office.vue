<template>
  <div>

    <div class="page-title">
      <button class="waves-effect waves-light btn" data-micromodal-trigger="modal_learn_address">Найти офис</button>
    </div>

    <Loader v-if="loading" />

    <p class="center" v-else-if="!employees.length">
      {{ 'NoRecords' | localize }}
    </p>

    <div v-else>
      <employees_table :employees="employees" />


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


    <m_learn_address @check_address="check_address" />

  </div>
</template>

<script>
import employees_table from '../components/tables/employees_table'
import m_delete from '../components/m_delete'
import m_update from '../components/m_update'
import m_learn_address from "../components/m_learn_address";

export default {
  name: "Office",
  metaInfo() {
    return { title: this.$title('Office') }
  },

  data() {
    return {
      page: +this.$route.query.page || 1,
      res: {},
      loading: true,
      class_name: "employees",
      code: '',
      address: '',
    }
  },

  computed: {

    employees() {
      return this.$store.getters.employees
    },

    pageSize() {
      return this.res.meta.per_page
    },

    pageCount() {
      return this.res.meta.last_page
    }

  },

  mounted() {

    const elems = document.querySelectorAll('.modal');
    const instances = M.Modal.init(elems)

    this.$store.dispatch('fetch_employees').then((res) => {
      this.res = res
      this.loading = false
    })

  },
  methods: {

    check_address(address) {
      this.address = address
    },

    pageChangeHandler(page) {
      this.loading = true
      this.$router.push(`${this.$route.path}?page=${page}`)
      this.$store.dispatch(`fetch_${this.class_name}`, page).then(() => {
        this.loading = false
      })
    }

  },
  components: {
    m_learn_address,
    employees_table, m_delete, m_update
  }
}
</script>

<style scoped>

</style>
