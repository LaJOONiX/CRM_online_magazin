<template>
  <div class="modal micromodal-slide" id="modal_add_product_offer" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            Добавление товарного предложения
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form @submit.prevent="add_product_offer" id="add_product_offer_form">
            <div class="row">
              <div class="input-field col s12">
                <input placeholder="Капитанская дочка" v-model.trim="title" id="title" name="title" type="text" class="validate"
                       :class="{invalid: ($v.title.$dirty && !$v.title.required) || ($v.title.$dirty && !$v.title.minLength)}">
                <label for="title" class="active">Введите название издания</label>
                <small class="helper-text invalid"
                       v-if="$v.title.$dirty && !$v.title.required"
                >Имя товара обязательно к заполнению</small>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <select class="browser-default" :class="{invalid: ($v.delivery.$dirty && !$v.delivery.required)}" v-model.trim="delivery"  name="delivery">
                  <option value="" disabled selected>Выберите способ доставки</option>
                  <option value="Самовывоз">Самовывоз</option>
                  <option value="Курьером">Курьером</option>
                </select>
                <small class="helper-text invalid"
                       v-if="$v.delivery.$dirty && !$v.delivery.required"
                >Нужно указать способ доставки</small>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input v-model.trim="count" :class="{invalid: ($v.count.$dirty && !$v.count.required)}" placeholder="5" id="count" name="count" type="text" class="validate">
                <label for="count" class="active">Введите количество</label>
                <small class="helper-text invalid"
                       v-if="$v.count.$dirty && !$v.count.required"
                >Количество обязательно к заполнению</small>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input :class="{invalid: ($v.date_start.$dirty && !$v.date_start.required)}" v-model.trim="date_start" name="date_start" id="date_start" type="date" class="validate">
                <label for="date_start" class="active">Дата начала доставки</label>
                <small class="helper-text invalid"
                       v-if="$v.date_start.$dirty && !$v.date_start.required"
                >Выберите дату начала доставки</small>
              </div>
              <div class="input-field col s6">
                <input :class="{invalid: ($v.date_end.$dirty && !$v.date_end.required)}" v-model.trim="date_end" name="date_end" id="date_end" type="date" class="validate">
                <label for="date_end" class="active">Дата конца доставки</label>
                <small class="helper-text invalid"
                       v-if="$v.date_end.$dirty && !$v.date_end.required"
                >Выберите дату конца доставки</small>
              </div>
            </div>
          </form>
        </main>
        <footer class="modal__footer">
          <button @click="add_product_offer" class="modal__btn modal__btn-primary">Добавить</button>
          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Отменить</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'
import MicroModal from 'micromodal'
import axios from "axios"

export default {
  name: "m_add_product_offer",
  data() {
    return {
      deliveries: [],
      title: '',
      delivery: '',
      count: '',
      date_start : '',
      date_end : '',
    }
  },
  validations: {

    title: { required, minLength: minLength(3) },
    delivery: { required },
    count: { required },
    date_start: { required },
    date_end: { required }

  },
  mounted() {
    axios.get('api/deliveries').then((res) => {
      console.log(res.data.response)
      this.deliveries = res.data.response
    })

    const elems = document.querySelectorAll('select');
    const instances = M.FormSelect.init(elems);
    MicroModal.init()
  },
  methods: {
    add_product_offer() {

      if (this.$v.$invalid) {
        this.$v.$touch() // активизируем валидацию
        return
      }

      const form = document.querySelector('#add_product_offer_form')
      const data = Object.fromEntries(new FormData(form).entries())

      MicroModal.close('modal_add_product_offer')

      this.$store.dispatch('fetch_product_by_name', data.title).then((product) => { // получение данных об издании по имени
        this.$store.dispatch('fetch_delivery_by_name', data.delivery).then((delivery) => { // получение данных о доставке по имени
          // добавление подписки исходя из введенных в форму данных
          this.$store.dispatch('add_product_offer', { ...data, price: product.price, id_product: product.id, id_delivery: delivery.id})
        })
      })
    }
  }
}
</script>

<style scoped>

</style>
