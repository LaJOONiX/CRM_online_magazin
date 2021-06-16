<template>
  <div class="modal micromodal-slide" id="modal_payment_code" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            Введение платежного кода
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form @submit.prevent="pay_receipt">
            <div class="row">
              <div class="input-field col s6">

                PY-
                <div class="input-field col s6 inline">
                  <input v-model="payment_code" placeholder="Введите числовой код" id="payment_code" type="text" class="validate">
                  <input type="hidden" v-model="receipt_code">
                  <label for="payment_code" class="active">Платежный код</label>
                  <!--                <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>-->
                </div>
              </div>
              <div style="margin-top: 17px;height: 54px;" class="col s6">
                <button class="btn waves-effect waves-light modal-close" type="submit">Оплатить</button>
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
import MicroModal from "micromodal";
export default {
  name: "m_payment_code",
  props: ['receipt_code'],
  data() {
    return {
      payment_code : ''
    }
  },
  methods: {
    pay_receipt() {
      this.$store.dispatch('pay_receipt', { code : this.receipt_code, payment_code : this.payment_code })
    }
  },
  mounted() {
    MicroModal.init()
  }
}
</script>

<style scoped>

</style>
