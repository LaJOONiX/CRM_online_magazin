import axios from 'axios'
import _ from "lodash";

export default {

  state: {
    client: null,
    product_offers: []
  },

  actions: {

    clear_local_receipt_product_offers({commit}) {
      commit('clear_local_receipt_product_offers')
    },

    async add_product_offer ({dispatch, commit}, data) {
      const found = _.find(this.getters.local_receipt_product_offers, ['title', data.title])
      if (typeof found != 'object') {
        console.log('дата начала', data.date_start)
        console.log('дата конца', data.date_end)
        commit('add_product_offer', {
          id_delivery : data.id_delivery,
          id_product : data.id_product,
          count: data.count,
          product : {
            title: data.title,
            price: data.price,
          },
          delivery: data.delivery,
          date_start : console.log(dispatch('convert_date', data.date_start)),
          date_end : console.log(dispatch('convert_date', data.date_end))
        })
      }
    },

    set_client_local_receipt({ commit }, client) {
      commit('set_client_local_receipt', client)
    },

    clear_client_local_receipt({ commit }) {
      commit('clear_client_local_receipt')
    },

    delete_product_offer({ commit }, product_offer_id) {
      const found = this.getters.local_receipt_product_offers[product_offer_id]
      if (typeof found == 'object') {
        commit('delete_product_offer', product_offer_id)
      }
    },

    increment_product_offer ({ commit }, product_offer_id) {
      commit('increment_count', product_offer_id)
    },

    decrement_product_offer ({ commit }, product_offer_id) {
      const found = this.getters.local_receipt_product_offers[product_offer_id]
      if (+found.count === 1) {
        commit('delete_product_offer', product_offer_id)
      } else {
        commit('decrement_count', product_offer_id)
      }
    },

  },

  mutations: {

    decrement_count(state, product_offer_id) {
      const found = state.product_offers[product_offer_id]
      console.log(found)
      found.count--
    },

    delete_product_offer(state, product_offer_id) {
      state.product_offers.splice(product_offer_id, 1)
    },

    increment_count(state, product_offer_id) {
      const found = state.product_offers[product_offer_id]
      if (typeof found == 'object') {
        found.count++
      }
    },

    set_client_local_receipt(state, client) {
      state.client = client
    },

    clear_client_local_receipt(state) {
      state.client = null
    },

    add_product_offer(state, data) {
      state.product_offers.push(data)
    },

    clear_local_receipt_product_offers(state) {
      state.product_offers = []
    },

  },

  getters: {

    local_receipt_client : s => s.client,
    local_receipt_product_offers : s => s.product_offers

  }

}
