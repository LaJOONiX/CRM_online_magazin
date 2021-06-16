<template>
  <div class="modal micromodal-slide" id="modal_edit" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal_edit-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal_edit-title">
            Редактирование {{class_name}}
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal_edit-content">
          <form v-if="editable_item" @submit="edit" id="update-form">
            <div v-for="key in Object.keys(editable_item).filter(item => !unnecessary_props.includes(item))" class="input-field">
              <input v-bind:name="key" v-bind:id="key" type="text" class="validate" v-bind:value="editable_item[key]">
              <label v-bind:for="key">{{key}}</label>
              <input name="id" type="hidden" v-bind:value="editable_item.id">
            </div>
          </form>
        </main>
        <footer class="modal__footer">
          <button @click.prevent="edit" data-micromodal-close class="modal__btn modal__btn-primary">Редактировать</button>
          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Отменить</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "m_edit",
  props: {
    class_name: {
      required: true,
      type: String
    },
    id_bd: {
      required: true
    }
  },
  data() {
    return {
      unnecessary_props: ['id','code','created_at','sold_month','purchased_count']
    }
  },
  computed: {

    editable_item() {
        let item = undefined
        if (this.id_bd && this.id_bd !== -1) {
          item = this.$store.getters[this.class_name].find(item => item.id === this.id_bd)
          setTimeout(() => M.updateTextFields(), 0)
        }
        return item
      }

  },

  watch: {
    id_bd : function (val) {
      MicroModal.init()
      M.updateTextFields()
    }
  },

  mounted() {
    setTimeout(() => {
      MicroModal.init()
      M.updateTextFields()
    }, 0)

  },

  methods: {

    edit() {
      const form = document.querySelector('#update-form')
      const data = Object.fromEntries(new FormData(form).entries())


      this.$emit('react_edit', data)
      this.$store.dispatch(`update_${this.class_name.slice(0, -1)}`, data).then(() => {
        this.$message('Запись отредактирована!')
      })
    }

  }
}
</script>

<style scoped>

</style>
