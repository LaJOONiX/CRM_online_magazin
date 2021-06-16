import axios from 'axios'
import Vue from 'vue'
import router from "../router"

export default {
  state: {
    token: localStorage.getItem('user-token') || "",
    authUser: {},
    status: "",
    hasLoadedOnce: false
  },

  getters: {
    authUser: state => state.authUser,
    isAuthenticated: state => !!state.token,
    authStatus: state => state.status
  },

  actions: {
    update_authUser({dispatch, commit}, credentials) {

      return new Promise((resolve, reject) => {
        axios.patch('/api/update_profile', credentials, {
          headers: {
            "Content-Type": "application/json",
          }
        }).then(res => {

          this.getters.authUser.username = credentials.username
          this.getters.authUser.email = credentials.email
          this.getters.authUser.is_english = !!credentials.is_english

          resolve()
        }).catch(err => {
          reject()
        })
      })
    },

    auth_success({commit}, data) {
      commit('auth_success', data)
    },

    auth_logout({commit}) {
      return new Promise(resolve => {
        commit('clear_local_receipt_subscriptions')
        commit('clear_client_local_receipt')
        commit('auth_logout')
        resolve()
      })

    },
  },
  mutations: {

    auth_request: state => {
      state.status = "loading";
    },
    auth_success: (state, response) => {
      state.status = "success"
      state.token = response.token
      state.hasLoadedOnce = true
      state.authUser = response.user
    },
    auth_error: state => {
      state.status = "error"
      state.hasLoadedOnce = true
    },
    auth_logout: state => {
      state.token = ""
      state.authUser = {}
      state.status = ""
      state.hasLoadedOnce = false
      delete axios.defaults.headers.common['Authorization']
      localStorage.removeItem('user-token')
      Vue.delete(state, "profile")
      router.push('/login')
    }

  }
}
