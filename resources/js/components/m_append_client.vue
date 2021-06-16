<template>
  <div class="modal micromodal-slide" id="modal_append_client" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            Добавление клиента
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form id="append_client_form" @submit.prevent="append_client">
            <div class="row">
              <div class="input-field col s6">
                <input :class="{invalid: ($v.code_client.$dirty && !$v.code_client.required )}" v-model.trim="code_client" placeholder="Введите код клиента" id="code_client" type="text" class="validate">
                <label for="code_client" class="active">Клиент</label>
                <small class="helper-text invalid"
                       v-if="$v.code_client.$dirty && !$v.code_client.required"
                >Введите код клиента</small>
              </div>
              <div style="margin-top: 17px;height: 54px;" class="col s6">
                <button class="btn waves-effect waves-light modal-close" type="submit">Добавить</button>
              </div>
            </div>
          </form>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import { required } from 'vuelidate/lib/validators'
import MicroModal from 'micromodal'
export default {
  name: "m_append_client",
  data() {
    return {
      code_client: '',
    }
  },
  validations: {
    code_client : { required }
  },
  methods: {
    append_client() { // функция добавления клиента в локальную квитанцию

      if (this.$v.$invalid) {
        this.$v.$touch() // активизируем валидацию
        return
      }

      if (!this.code_client) { // если не введен код клиента
        this.$store.dispatch('clear_client_local_receipt') // очищаем ячейку локального хранилища, отвечающую за хранение клиента в локальной квитанции
      } else { // если введен код клиента
        this.$store.dispatch('fetch_client', this.code_client).then((client) => { // отправляем запрос с кодом клиента для извлечения данных о нем
          MicroModal.close('modal_append_client');
          this.$store.dispatch('set_client_local_receipt', client) // если клиент существует мы записываем его данные в локальное хранилище
        }).catch(err => { // если клиента не существует
          this.$message(`Клиента с кодом ${this.code_client} не существует!`) // выводим ошибку
        })
      }

    }
  },
  mounted() {
    MicroModal.init()
  }
}
</script>

<style scoped>

</style>
