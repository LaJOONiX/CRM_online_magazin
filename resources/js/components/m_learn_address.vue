<template>
  <div class="modal micromodal-slide" id="modal_learn_address" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            Узнать обслуживаемый адрес
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form @submit.prevent="check_address">
            <div class="row">
              <div class="input-field col s6">
                <input v-model="address" placeholder="Введите адрес" id="address" type="text" class="validate">
                <label for="address" class="active">Адрес</label>
              </div>
              <div style="margin-top: 17px;height: 54px;" class="col s6">
                <button class="btn waves-effect waves-light modal-close" type="submit">Добавить</button>
              </div>
            </div>
          </form>
        </main>
<!--        <footer class="modal__footer">-->
<!--          <button class="modal__btn modal__btn-primary">Создать</button>-->
<!--          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Отменить</button>-->
<!--        </footer>-->
      </div>
    </div>
  </div>
</template>

<script>
import MicroModal from 'micromodal'
import axios from "axios";

export default {
  name: "m_learn_address",
  data() {
    return {
      address: ''
    }
  },
  mounted() {
    MicroModal.init()
  },
  methods: {
    check_address() {
      // парсинг введенного адреса
      let address_cells = this.address.match(/^(?:г. )?([^\,]+), (?:ул. )?([^\,]+), (?:д. )?(?:\d+\/)?(\d+)/)

      // установление значений исходя из парсинга
      const data = {
        city: address_cells[1],
        street: address_cells[2],
        house: address_cells[3],
        corpus: address_cells[4],
      }


      // если корпус не существует, то мы удаляем его из объекта
      if (!data.corpus) {
        delete data.corpus
      }

      // отправка запроса post с указанием введенным пользоваталем адресом
      axios.post('/api/clients/get_office', data).then((res) => {
        const address = res.data.response // полученный адрес офиса с сервера
        this.$store.dispatch('set_success', `Ваш адрес обслуживается отделением ${address}`)
      }).catch(err => this.$message('Введенный адрес не обслуживается ни одним отделением')) // вывод ошибки в случае отсутствия офиса

    }
  }
}
</script>

<style scoped>

</style>
