import axios from 'axios'

export default {
  state: {
    categories: []
  },

  actions: {

    fetch_categories({ commit }, page = 1) {
      return new Promise ((resolve, reject) =>
      {
        axios.get('/api/categories?page=' + page).then((res) =>
        {
          commit('set_categories', res.data.response.data)
          resolve(res.data.response)
        }).catch(err => reject() )
      })
    },

  },

  mutations: {
    set_categories(state, categories) {
      state.categories = categories
    }
  },

  getters: {
    categories: s => s.categories
  }
}
