<template>
<div>
  <a v-if="!client" data-micromodal-trigger="modal_append_client" class="waves-effect waves-light btn modal-trigger">
    Клиент
  </a>
  <div v-else>
    <a class="btn dropdown-trigger" href="#!" data-target="dropdown3">{{this.$initials(client.name)}}<i class="material-icons right">arrow_drop_down</i></a>
    <button data-position="right" v-tooltip.noloc="'Добавить продажу'" class="waves-effect btn light-blue lighten-5 add_product_offer" data-micromodal-trigger="modal_add_product_offer"><span style="font-size:20px;position:relative;top:-8px;">+</span></button>
    <ul id="dropdown3" class="dropdown-content">
      <li><a @click.prevent="clear_local_client" href="#!">Очистить</a></li>
      <li><a data-micromodal-trigger="modal_append_client"><span style="position: absolute;right: 0;" class="new badge"></span>Сменить пользователя</a></li>
    </ul>
  </div>

  <carousel style="min-height:212px;" :product_offers="product_offers" />

  <div style="justify-content:flex-start" class="page-title">
    <span style="font-size:21px;">Итого:</span>
    <span style="color: rgb(102, 106, 115);font-weight: bold;font-size: 21px;margin-left: 23px;
    margin-right: 18px;width: 167px;text-align: center;display: inline-block;">{{ this.total_price }}&nbsp;₽</span>
    <beauty_button @issue_receipt="issue_receipt" v-if="product_offers.length !== 0" :text="'Оформить'" />
  </div>
  <Loader v-if="loading" />

  <p class="center" v-else-if="!receipts.length">
    {{ 'NoRecords' | localize }}
  </p>

  <div v-else>

    <receipts_table @set_receipt_code="set_receipt_code" :receipts="receipts" />
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

  <m_append_client />
  <m_add_product_offer />
  <m_payment_code :receipt_code="code" />


</div>
</template>

<script>
import receipts_table from '../components/tables/receipts_table'
import m_append_client from "../components/m_append_client"
import carousel from '../components/external/carousel'
import m_add_product_offer from "../components/m_add_product_offer"
import m_payment_code from "../components/m_payment_code"
import beauty_button from '../components/external/beauty_button'
import axios from 'axios'

export default {
  name: "Receipts",
  metaInfo() {
    return { title: this.$title('Receipts') }
  },
  data() {
    return {
      page: +this.$route.query.page || 1,
      res: {},
      loading: true,
      class_name: "receipts",
      code: '',
    }
  },
  computed: {

    receipts() {
      return this.$store.getters.receipts
    },

    pageSize() {
      return this.res.meta.per_page
    },

    pageCount() {
      return this.res.meta.last_page
    },

    product_offers() {
      return this.$store.getters.local_receipt_product_offers
    },

    total_price() {
      return this.$store.getters.local_receipt_product_offers.reduce((sum, product_offer) => {
        return sum + product_offer.product.price * product_offer.count
      }, 0)
    },

    client() {
      setTimeout(() => {
           let elems = document.querySelectorAll('.dropdown-trigger')
           let instances = M.Dropdown.init(elems, {
             alignment: 'middle',
             coverTrigger: false
           })
         }, 0)
      return this.$store.getters.local_receipt_client
    }
  },
  mounted() {

   // this.delayy(10000)

    if (this.$store.getters.local_receipt_client) {
      this.$store.dispatch('fetch_client', this.$store.getters.local_receipt_client.code).then((client) => {
        this.$store.dispatch('set_client_local_receipt', client)
      }).catch(err => {
        this.$store.dispatch('clear_local_receipt_product_offers')
        this.$store.dispatch('clear_client_local_receipt')
      })
    }

    this.$store.dispatch('fetch_receipts').then((res) => {
      this.res = res
      this.loading = false
    })

    MicroModal.init()

  },

  methods: {

    clear_local_client() {
      this.$store.dispatch('clear_client_local_receipt')
    },

    set_receipt_code(code) {
      this.code = code
      console.log('КАКОЙ_ТО КОД', this.code)
    },

    append_client(client) {
      this.client = client
    },

    pageChangeHandler(page) {
      this.loading = true
      this.$router.push(`${this.$route.path}?page=${page}`)
      this.$store.dispatch(`fetch_${this.class_name}`, page).then(() => {
        this.loading = false
      })
    },

    // async delayy(time) {
    //   setTimeout(() => {
    //     console.log('Client', this.$store.getters.local_receipt_client)
    //     // console.log('Подписки в квитацнии', this.$store.getters.local_receipt)
    //     this.delayy(time)
    //   }, time)
    // },

    issue_receipt() {
      let data = {}
      data.id_client = this.$store.getters.local_receipt_client.id

      data.product_offers = this.$store.getters.local_receipt_product_offers

      data.product_offers_count = data.product_offers.length
      data.code_client = this.$store.getters.local_receipt_client.code
      data.code = 'R-00000000'
      data.created_at = 'calculating'
      data.sum = -1


      this.$store.dispatch('add_receipt', data)

      axios.post('/api/receipts/issue', data).then((res) => {
        data.code = res.data.response.code
        data.sum = res.data.response.sum
        data.code_client = res.data.response.code_client
        data.code_employee = res.data.response.code_employee
        data.created_at = res.data.response.created_at
        this.$store.dispatch('add_receipt',data)
        this.$store.dispatch('clear_local_receipt_product_offers')
        this.$message('Квитанция успешно оформлена')
      }).catch(err => console.log(err))
    }

  },

  components: {
    m_payment_code,
    m_add_product_offer,
    m_append_client,
    receipts_table,
    carousel,
    beauty_button
  }
}
</script>

<style scoped>
  .add_product_offer {
    color: black;
    border-radius: 50%;
    height: 25px;
    width: 25px;
    padding: 0;
    border: 1px solid #CCC;
    margin-left: 9px;
  }
</style>
