<template>
  <table class="striped">
    <thead>
    <tr>
      <th>Код</th>
      <th>ФИО</th>
      <th>E-mail</th>
      <th>Дата</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="employee in employees" :key="employee.code">
      <td>{{employee.code}}</td>
      <td>{{employee.name}}</td>
      <td>{{employee.email}}</td>
      <td>{{employee.created_at}}</td>
    </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "employees_table",
  props: {
    employees: {
      required: true,
      type: Array
    }
  }
}
</script>

<style scoped>
button {
  box-shadow:none;
  color:black;
  background:none;
  border:1px solid black;
}
</style>
