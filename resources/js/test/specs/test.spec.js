import { shallowMount } from '@vue/test-utils'
import Login from '../../views/login.vue'


describe('Hello', () => {
  const wrapper = shallowMount(Login)

  // устанавливаем `username` меньше 7 символов, без учёта пробелов
  wrapper.setData({ username: ' '.repeat(3) })

  // проверяем, что ошибка отобразилась
  expect(wrapper.find('.error-section').exists()).toBe(true)

  // обновляем имя, чтобы оно было достаточно длинным
  wrapper.setData({ username: 'qwertyqwerty' })

  // проверяем, что ошибка исчезла
  expect(wrapper.find('.error-section').exists()).toBe(false)
})
