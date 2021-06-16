<template>
  <form style="height:349px;" class="card auth-card" @submit.prevent="submitHandler">
    <div class="card-content">
      <span style="text-align: center;margin-left: -19px;" class="card-title">
        <i class="material-icons">layers</i><span>OFFICE</span></span>
      <div class="input-field">
        <input
          id="username"
          type="text"
          v-model.trim="username"
          :class="{invalid: ($v.username.$dirty && !$v.username.required)}" />
        <label for="username">Логин</label>
        <small class="helper-text invalid"
               v-if="$v.username.$dirty && !$v.username.required"
        >{{ 'Message_UsernameRequired' | localize }}</small>
      </div>
      <div class="input-field">
        <input
          id="password"
          type="password"
          v-model.trim="password"
          :class="{invalid: ($v.password.$dirty && !$v.password.required) || ($v.password.$dirty && !$v.password.minLength)}"
        />
        <label for="password">{{ 'Password' | localize }}</label>
<!--        <div v-if="error-section" class="error-section"></div>-->
        <small
          class="helper-text invalid"
          v-if="$v.password.$dirty && !$v.password.required"
          >{{ 'Message_EnterPassword' | localize }}</small>
        <small class="helper-text invalid"
          v-else-if="$v.password.$dirty && !$v.password.minLength"
        >{{ 'Message_MinLength' | localize }} {{ $v.password.$params.minLength.min}}</small>
      </div>
    </div>
    <div style="position:absolute;left:0;right:0;bottom:27px;" class="card-action">
      <div>
        <button style="box-shadow:none" class="btn indigo lighten-2 waves-effect auth-submit" type="submit">
          {{ 'Login' | localize }}
          <i class="material-icons right">send</i>
        </button>
      </div>

    </div> <!-- card-action -->
  </form>
</template>

<script>

import { required, minLength } from 'vuelidate/lib/validators'
import messages from '../utils/messages';
import localizeFilter from '../filters/localize.filter';
import axios from "axios";
import router from "../router";


export default {
  name: "Login",
  metaInfo() {
    return { title: this.$title('Login') }
  },
  data: () => ({
    username: '',
    password: '',
  }),
  validations: {
    username: { required },
    password: { required, minLength: minLength(6) }
  },
  computed: {
    // error_section () {
    //   return this.username.trim().length < 7 ? "Имя пользователя должно быть длиннее 6 символов" : ''
    // },
  },
  mounted() {
    if (messages[this.$route.query.message]) {
      this.$message(localizeFilter(messages[this.$route.query.message]))
    }
  },
  methods: {
    submitHandler() {

      // валидация формы
      if (this.$v.$invalid) {
        this.$v.$touch() // активизируем валидацию
        return
      }
      // отправка данных для отправки на сервер
      const formData = {
        username: this.username,
        password: this.password
      }

      axios.post('/api/login', formData).then(res => {
        const data = res.data.response

        localStorage.setItem('user-token', data.token)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token
        this.$store.dispatch('auth_success', data)
        router.push('/')
      }).catch(err => {
        this.$message('Неправильный логин/или пароль')
        localStorage.removeItem("user-token")
      })

    }
  }
}
</script>

<style scoped>
  .card-title span {
    margin-left: 9px;
  }

  .card-title > * {
    display: inline-block;
    vertical-align: middle;
  }

  .card .card-content .card-title i {
    line-height:normal;
    font-size: 48px;
  }
  .card-title {
    font-family: Quantico, sans-serif;
    font-size: 20px;
    letter-spacing: 0.12em;
  }
  .card-action {
    padding-top:0;
  }
  .center {
    margin-top:20px;
  }
</style>
