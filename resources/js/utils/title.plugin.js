import localizeFilter from '../filters/localize.filter'

export default {
  install(Vue) {
    Vue.prototype.$title = function(titleKey) {
      const appName = process.env.MIX_API_KEY
      return `${localizeFilter(titleKey)} | ${appName}`
    }
  }
}
