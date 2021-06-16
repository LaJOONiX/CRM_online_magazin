<template>
  <div class="modal micromodal-slide" id="modal_create" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal_create-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal_create-title">
            Форма осуществления доставки
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal_create-content">
          <form @submit="create" id="create-form">
<!--            asdfoasdufio-->
          </form>
        </main>
        <footer class="modal__footer">
          <button @click.prevent="deliver" data-micromodal-close class="modal__btn modal__btn-primary">Доставить</button>
          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Отменить</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "m_delivered",
  methods: {
    deliver() {

    }
  }
}
</script>

<style scoped>

</style>
