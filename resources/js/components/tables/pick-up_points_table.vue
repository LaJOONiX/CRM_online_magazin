<template>
  <table class="striped">
    <thead>
    <tr>
      <th></th>
      <th>Адрес</th>
      <th>Часы работы</th> <!-- надпись - работает или нет -->
      <th></th> <!-- Кнопка доставить -->
      <th></th> <!-- Кнопка подробно просмотра подписки -->
    </tr>
    </thead>
    <tbody>
    <tr v-for="(pickup_point, index) in pickup_points" :key="pickup_point.address">
      <td>{{index + 1}}</td>
      <td>{{pickup_point.address}}</td>
      <td>{{pickup_point.hours}}</td>
    </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "pick-up_points_table",
  props: ["pickup_points"]
}
</script>

<style scoped>

</style>
