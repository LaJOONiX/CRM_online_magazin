<template>
  <div>
    <div class="page-title">
      <h3>{{'ProfileTitle' | localize}}</h3>
    </div>

    <form class="form" @submit.prevent="submitHandler">
      <div class="input-field">
        <input
          id="username"
          type="text"
          v-model="username"
          :class="{invalid: $v.username.$dirty &&  !$v.username.required}"
        />
        <label for="username">{{'UserName'|localize}}</label>
        <small
          class="helper-text invalid"
          v-if="($v.username.$dirty &&  !$v.username.required)"
        >{{'Message_EnterUserName'|localize}}</small>
      </div>
      <div class="input-field">
        <input
          id="email"
          type="text"
          v-model="email"
          :class="{invalid: $v.email.$dirty &&  !$v.email.required}"
        />
        <label for="email">{{'Email' | localize}}</label>
        <small
          class="helper-text invalid"
          v-if="($v.email.$dirty &&  !$v.email.required)"
        >{{'Message_EnterEmail'|localize}}</small>
      </div>
      <div class="input-field">
        <input
          id="password"
          type="text"
          v-model="password"
          :class="{invalid: $v.password.$dirty &&  !$v.password.required}"
        />
        <label for="password">{{'Password'|localize}}</label>
        <small
          class="helper-text invalid"
          v-if="($v.password.$dirty &&  !$v.password.required)"
        >{{'Message_EnterPassword'| localize}}</small>
      </div>
      <div class="input-field">
        <input
          id="password_confirm"
          type="text"
          v-model="password_confirm"
          :class="{invalid: $v.password_confirm.$dirty &&  !$v.password_confirm.required}"
        />
        <label for="password_confirm">{{'PasswordConfirm'|localize}}</label>
        <small
          class="helper-text invalid"
          v-if="($v.password_confirm.$dirty &&  !$v.password_confirm.required)"
        >{{'Message_EnterPasswordConfirm'| localize}}</small>
      </div>

      <div class="switch">
        <label>
          Русский
          <input type="checkbox" v-model="is_english" />
          <span class="lever"></span>
          English
        </label>
      </div>

      <button class="btn waves-effect waves-light" type="submit">
        {{'Update'|localize}}
        <i class="material-icons right">send</i>
      </button>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import { required, email } from 'vuelidate/lib/validators'
import localizeFilter from '../filters/localize.filter'
export default {
  name: "Profile",
  metaInfo() {
    return { title: this.$title('Profile') }
  },
  data: () => ({
    username: '',
    email: '',
    password: '',
    password_confirm: '',
    is_english: undefined
  }),
  validations: {
    username: { required },
    email: { required, email },
    password: { required },
    password_confirm: { required },
  },
  computed: {
    ...mapGetters(['authUser'])
  },
  mounted() {
    this.username = this.authUser.username
    this.email = this.authUser.email
    this.is_english = this.authUser.is_english

    setTimeout(() => M.updateTextFields(), 0)
  },
  methods: {

    submitHandler() {
      //  валидация формы
      if (this.$v.$invalid) {
        // прошла ли форма валидацию
        this.$v.$touch() // активизирум валидацию
        return
      }

      const data = {
        username: this.username,
        email: this.email,
        password: this.password,
        is_english: +this.is_english
      }

      this.$store.dispatch('update_authUser', data).then(() => this.$message('Профиль успешно обновлен'));

    }
  }
}
</script>

<style scoped>
.switch {
  margin-bottom: 2rem;
}
</style>
