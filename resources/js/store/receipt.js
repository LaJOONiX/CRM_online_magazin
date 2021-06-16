import axios from 'axios'
import _ from 'lodash'
export default {

  state: {
    receipts: [],
  },

  actions: {

    add_receipt({ commit }, data) {
      commit('add_receipt', data)
    },

    fetch_receipt({commit}, code) {
      return new Promise((resolve, reject) => {
        axios.get(`/api/receipts/${code}`).then((res) => {
          resolve(res.data.response)
        }).catch(err => reject(err))
      })
    },

    pay_receipt({ commit }, {code, payment_code}) {

      return new Promise ((resolve, reject) => {
        commit('pay_receipt', {code, 'payment_code': 'PY-XXXXXXXX'})
        payment_code = 'PY-' + payment_code
        axios.post(`/api/receipts/${code}/pay`, { payment_code }).then((res) => {
          commit('pay_receipt', { code, payment_code })
          resolve()
        }).catch(err => reject(err))
      })

    },

    fetch_receipts({commit}, page = 1) {

      return new Promise ((resolve, reject) =>
      {
        axios.get('/api/receipts?page=' + page).then((res) => {

          console.log(res.data.response.data)

          res.data.response.data.map(item => {

            item.code_client = item.client.code
            item.code_employee = item.employee.code
            item.product_offers_count = item.product_offers.length

            delete item.client
            delete item.employee

            return item
          })
          commit('set_receipts', res.data.response.data)
          resolve(res.data.response)
        }).catch(err => reject(err) )
      })

    },

  },

  mutations: {

    add_receipt(state, receipt) {
      if (receipt.sum === -1) {
        state.receipts.unshift(receipt)
        state.receipts.pop()
      } else {
        state.receipts[0].code = receipt.code
        state.receipts[0].code_employee = receipt.code_employee
        state.receipts[0].created_at = receipt.created_at
        state.receipts[0].sum = receipt.sum
      }
    },

    pay_receipt(state, { code, payment_code }) {
      const index = state.receipts.findIndex(item => item.code === code)
      state.receipts[index].payment_code = payment_code
    },

    set_receipts(state, receipts) {
      state.receipts = receipts
    },

  },

  getters: {

    receipts: s => s.receipts,

  }
}
