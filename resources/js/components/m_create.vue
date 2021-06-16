<template>
  <div class="modal micromodal-slide" id="modal_create" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal_create-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal_create-title">
            Создание {{ title }}
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal_create-content">
          <form @submit="create" id="create-form">
            <div v-for="field in fields" class="row">
              <div v-if="field.tag === 'input'" class="input-field">
                <input v-bind:name="field.name" v-bind:id="field.name" v-bind:type="field.type" class="validate">
                <label v-bind:for="field.name">{{field.placeholder}}</label>
              </div>
              <div class="input-field col s12" v-else-if="field.tag === 'select'">
                <select name="id_category">
                  <option value="" disabled selected>Выберите категорию</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">{{category.title}}</option>
                </select>
                <label>Категория</label>
              </div>
            </div>
          </form>
        </main>
        <footer class="modal__footer">
          <button @click.prevent="create" data-micromodal-close class="modal__btn modal__btn-primary">Создать</button>
          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Отменить</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import { required } from 'vuelidate/lib/validators'
import MicroModal from 'micromodal'
export default {
  name: "m_create",
  props: {
    class_name: {
      required: true,
      type: String
    }
  },
  computed: {
    categories() {
      return this.$store.getters.categories
    },
    fields() {
      let elems = document.querySelectorAll('select');
      let instances = M.FormSelect.init(elems)
      if (this.class_name === 'products') {
        return [
          {
            tag: 'select',
            options: this.$store.getters.categories,
            default: 'Выберите категорию',
            label: 'Категория'
          },
          {
            tag: 'input',
            name: 'title',
            type: 'text',
            placeholder: 'Название товара'
          },
          {
            tag: 'input',
            name: 'count',
            type: 'number',
            placeholder: 'Количество'
          },
          {
            tag: 'input',
            name: 'price',
            type: 'number',
            placeholder: 'Цена'
          },

        ]
      } else if(this.class_name === 'clients') {
        return [
          {
            tag: 'input',
            name: 'name',
            type: 'text',
            placeholder: 'ФИО'
          },
          {
            tag: 'input',
            name: 'email',
            type: 'email',
            placeholder: 'Эл. почта'
          },
        ]
      }
    },
    title() {
      switch (this.class_name) {
        case 'products':
          return 'Товаров'
        case 'clients':
          return 'Клиентов'
        case 'pickup_points':
          return 'Пунктов выдачи'
        default:
          return 'Класс не определен!'
      }
    }
  },
  mounted() {
    setTimeout(() => {
      let elems = document.querySelectorAll('select');
      let instances = M.FormSelect.init(elems)
      MicroModal.init()
      M.updateTextFields()
    }, 0)
  },
  methods: {
    create() {
      const form = document.querySelector('#create-form') // получение формы по id
      const data = Object.fromEntries(new FormData(form).entries()) // извлечение данных из формы и преобразование в объект

      this.$store.dispatch('create_'+this.class_name.slice(0, -1), data) // вызов запроса на добавление сущности в зависимости this.class_name

      document.querySelector('#create-form').reset()
    }
  }
}
</script>

<style scoped>
</style>
