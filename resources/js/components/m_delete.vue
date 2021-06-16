<template>
  <div class="modal micromodal-slide" id="modal_delete" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal_delete-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal_delete-title">
            Подтвердите удаление
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal_delete-content">
          <p>Вы действительно хотите удалить {{class_name}} с id {{id_bd}}?</p>
        </main>
        <footer class="modal__footer">
          <button @click="del" data-micromodal-close class="modal__btn modal__btn-primary">Удалить</button>
          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Отменить</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import MicroModal from "micromodal";
import axios from "axios";

export default {
  name: "m_delete",
  props: ['id_bd','class_name'],
  mounted() {
    setTimeout(() => {
      MicroModal.init()
      M.updateTextFields()
    }, 0)
  },
  methods: {
    del() {
      axios.delete(`/api/${this.class_name}/${this.id_bd}`).then(() => {

        this.$emit('react_delete')
      })
    }
  },
}
</script>

<style scoped>

</style>
