import axios from "axios";

export default {
  state: {
    product_offers: []
  },

  actions: {

    deliver_product_offer({commit}, code) {
      return new Promise((resolve, reject) => {
        axios.get('/api/product_offers/deliver/' + code).then(res => {
          commit('deliver_product_offer', { code, date: res.data.response})
          resolve()
        }).catch(err => reject(err))
      })


    },

    fetch_product_offers({commit}, page = 1) {
      return new Promise ((resolve, reject) => {
        axios.get('/api/product_offers?page=' + page).then((res) => {
          commit('set_product_offers', res.data.response.data)
          resolve(res.data.response)
        })
          .catch(err => reject())
      })
    },

  },

  mutations: {

    set_product_offers(state, product_offers) {
      state.product_offers = product_offers
    },

    deliver_product_offer(state, { code, date }) {

      const index = state.product_offers.findIndex(item => item.code === code)
      state.product_offers[index].delivered_at = date

    }

  },


  getters: {
    product_offers: s => s.product_offers
  }
}
