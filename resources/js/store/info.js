import axios from 'axios'
import Cookies from 'js-cookie'
import router from "../router"
export default {

  state: {
    info: {}
  },

  actions: {
    login({dispatch, commit}, credentials) {
      axios.post('/api/login', credentials, {
        headers: {
          "Content-type": "application/json"
        }
      }).then(response => {
        Cookies.set('Bearer',response.data.response['api_token'])

        commit('setInfo', response.data.response)

        router.push('/')
      })
    },

    updateInfo({dispatch, commit}, credentials) {
      axios.patch('/api/update_profile', credentials, {
        headers: {
          "Content-Type": "application/json",
        }
      }).then(res => {
        commit('setInfo', res)
        this.$router.push('/')
      })
    }
  },

  mutations: {
    setInfo(state,info) {
      state.info = info
    },
    clearInfo(state) {
      state.info = { locale: state.info.locale }
    }
  },

  getters: {
    info: s => s.info
  }

}
