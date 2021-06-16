import Vue from 'vue'
import axios from 'axios'
import Vuex from 'vuex'
import common from './common'
import auth from './auth'
import client from './client'
import product from './product'
import employee from './employee'
import receipt from './receipt'
import subscription from './product_offer'
import local_receipt from './local_receipt'
import pickup_point from './pickup_point'
import category from './category'
import createPersistedState from "vuex-persistedstate"

Vue.use(Vuex);

export default new Vuex.Store({
  actions: {
    fetch_delivery_by_name({commit}, title) {
      return new Promise( (resolve, reject) => {
        axios.get(`/api/delivery/title?title=${title}`).then((res) => {
          resolve(res.data.response)
        }).catch(err => reject())
      })
    },

    convert_date({commit}, dateStr) {

      const opt = undefined

      let re = '(?<d>\\d{1,2}).(?<m>\\d{1,2}).(?<y>\\d{4})';
      if (opt instanceof RegExp) {     // имена групп: y - год; m - месяц; d - день
        re = opt;
      } else {
        if ((typeof opt === 'string') && opt.length)  // разделитель (любая строка)
          re = re.replace('.', opt);
        re = new RegExp(re);
      }
      const { d, m, y } = (re.exec(dateStr) || {}).groups || {};
      if (!d) return null;
      const date = new Date(+y, m - 1, +d, 0, 0, 0);
      if (!date) return null;
      return date.toLocaleDateString('ru-RU', {
        day: 'numeric', month: 'long', year: '2-digit',
      }).replace(/(\d\d)\D+$/, '($1г.)');

    }

  },
  modules: {
    pickup_point, client, product, receipt, auth, employee, common, local_receipt, subscription, category
  },
  plugins: [createPersistedState()]
})
