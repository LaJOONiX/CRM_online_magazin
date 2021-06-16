import vueRouter from 'vue-router';
import Vue from 'vue';
import store from '../store'
import axios from 'axios';

Vue.use(vueRouter);



const ifNotAuthenticated = (to, from, next) => {
  if (store.getters.isAuthenticated) {
    next()
    return
  }
  console.log('console-log-test')
}

const ifAuthenticated = (to, from, next) => {
  if (store.getters.isAuthenticated) {
    next()
    return
  }
  next('/login')
}

const router = new vueRouter({
  mode: 'history',
 // base: process.env.BASE_URL,
  routes: [
    {
      path: '/login',
      name: 'login',
      meta: {layout: 'empty'},
      component: () => import('../views/login.vue'),
    },
    {
      path: '/',
      name: 'receipts',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/receipts.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/receipts/:code',
      name: 'receipts/:code',
      meta: { layout: 'main', auth: true },
      component: () => import('../views/receipts_code.vue')
    },
    {
      path: '/pickup_points',
      name: 'pickup_points',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/pick-up_points.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/products',
      name: 'products',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/products.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/clients',
      name: 'clients',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/clients.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/profile',
      name: 'profile',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/profile.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/product_offers',
      name: 'product_offers',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/product_offers.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/product_offers/:product_offer',
      name: 'product_offers/:product_offer',
      meta: {layout: 'main', auth: true},
      component: () => import('../views/product_offers_code.vue')
    }
  ]
})

// router.beforeEach((to, from, next) => {
//
//
//   const requireAuth = to.matched.some(record => record.meta.auth)
// });

// router.beforeEach((to, from, next) => {
// проверяем авторизовался (залогинился) пользователь
// const currentUser = firebase.auth().currentUser
//  получаем метаданные маршрута на который нужно перейти
// (требует ли он авторизации пользователя)
// const requareAuth = to.matched.some(record => record.meta.auth)

// if (requareAuth && !currentUser) {
// отсылаем на страницу логина
//   next('/login?message=login')
// } else {
// разрешаем переход по выбранному маршруту
//  next()
//}
//})

export default router
