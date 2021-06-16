<template>
<div>
  <div class="page-title">
    <h5>Клиенты</h5>
    <button style="background:none;border: 2px solid rgb(99, 99, 99); box-shadow: none;" data-micromodal-trigger="modal_create" class="btn-floating btn" data-position="left" v-tooltip="'CreateNewRecord'">
      <i style="position:relative;left:-2px;top:-2px;color:#2C2C2C" class="large material-icons">add</i>
    </button>
  </div>

  <Loader v-if="loading" />

  <p class="center" v-else-if="!clients.length">
    {{ 'NoRecords' | localize }}
  </p>

  <div v-else>

    <clients_table @edit="edit" @del="del" :clients="clients"/>
    <m_delete @react_delete="react_delete" :class_name="class_name" :id_bd="id_bd" />
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

  <m_create :class_name="class_name" />
<!--  <m_update v-if="this.code" :code ="code" :class_name="class_name" />-->
  <m_edit @react_edit="react_edit" :id_bd="id_bd" :class_name="class_name" />

</div>
</template>

<script>
import MicroModal from "micromodal";

import clients_table from '../components/tables/clients_table'
import m_delete from '../components/m_delete'
import m_edit from '../components/m_edit'

export default {
  name: "Clients",
  metaInfo() {
    return { title: this.$title('Clients') }
  },
  data() {
    return {
      page: +this.$route.query.page || 1,
      res: {},
      loading: true,
      class_name: "clients",
      id_bd: -1
    }
  },
  computed: {
    clients() {
      return this.$store.getters.clients
    },
    pageSize() {
      return this.res.meta.per_page
    },
    pageCount() {
      return this.res.meta.last_page
    }
  },
  mounted() {

    this.$store.dispatch('fetch_clients').then((res) => {
      this.res = res
      this.loading = false
    })


  },
  methods: {

    pageChangeHandler(page) {
      this.loading = true
      this.$router.push(`${this.$route.path}?page=${page}`)
      this.$store.dispatch(`fetch_${this.class_name}`, page).then(() => {
        this.loading = false
      })
    },

    react_delete() {
      this.$store.dispatch('delete_client', this.id_bd)
    },

    react_edit(editable_data) {
      const index_item_edit = this[this.class_name].findIndex(item => +item.id === +editable_data.id)

      const editable_item = this[this.class_name][index_item_edit]

      for (let key in editable_data) {

        for (let inner_key in editable_item) {
          if (inner_key === key)  {
            editable_item[inner_key] = editable_data[key]
          }
        }

      }
    },

    del(id_bd) {
      this.id_bd = id_bd
    },

    edit(id_bd) {
      this.id_bd = id_bd
    },

  },
  components: {
    clients_table, m_delete, m_edit
  }
}
</script>

<style scoped>

</style>
