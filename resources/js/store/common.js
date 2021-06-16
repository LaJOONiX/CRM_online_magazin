export default {
  state: {
    error: '',
    success: ''
  },

  actions: {

    set_success({commit}, message) {
      commit('set_success', message)
    },

    clear_success({commit}) {
      commit('clear_success')
    },

    set_error({commit}, message) {
      commit('set_error', message)
    },

    clear_error({commit}) {
      commit('clear_error')
    }

  },

  mutations: {

    set_error(state, error) {
      state.error = error
    },

    set_success(state, success) {
      state.success = success
    },

    clear_error(state) {
      state.error = ''
      console.log('Ошибка', this.getters.error)
    },

    clear_success(state) {
      state.success = ''
      console.log('Успех', this.getters.success)
    }

  },

  getters: {
    error: s => s.error,
    success: s => s.success
  }
}
