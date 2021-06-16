import axios from 'axios'

export default {

  state: {
    employees: []
  },

  actions: {

    fetch_employees({ commit }, page = 1) {
      return new Promise((resolve, reject) => {
        axios.get('/api/employees?page=' + page).then((res) => {
          commit('set_employees', res.data.response.data)
          resolve(res.data.response)
        }).catch(err => { reject() })
      })
    },


  },


  mutations: {

    set_employees(state, employees) {
      state.employees = employees
    },

  },

  getters: {
    employees: s => s.employees
  },
}
