import axios from 'axios'

export default {

  state: {
    pickup_points: []
  },

  actions: {

    fetch_pickup_points({commit}, page = 1) {
      return new Promise ((resolve, reject) =>
      {
        axios.get('/api/pickup_points?page=' + page).then((res) =>
        {
          commit('set_pickup_points', res.data.response.data)
          resolve(res.data.response)
        }).catch(err => reject() )
      })
    }

  },

  mutations: {

    set_pickup_points(state, pickup_points) {
      state.pickup_points = pickup_points
    }

  },

  getters: {
    pickup_points: s => {
      return s.pickup_points
    }
  }
}
