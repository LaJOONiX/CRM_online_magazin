<template>
  <table class="striped">
    <thead>
    <tr>
      <th>Код</th>
      <th>ФИО</th>
      <th>Email</th>
      <th>Дата регистрации</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="client in clients" :key="client.code">
      <td>{{client.code}}</td>
      <td>{{client.name}}</td>
      <td>{{client.email}}</td>
      <td>{{client.created_at}}</td>
      <td style="background:white;width:20px;">
        <button @click="$emit('edit', client.id)" data-micromodal-trigger="modal_edit" class="btn btn-manage-round">
          <i style="cursor:pointer" class="small material-icons">mode_edit</i>
        </button>
      </td>
      <td style="background:white;width:20px;">
        <button @click="$emit('del', client.id)" data-micromodal-trigger="modal_delete" class="btn btn-manage-round">
          <i style="cursor:pointer" class="small material-icons">close</i>
        </button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>

export default {
  name: "clients_table",
  props: {
    clients: {
      required: true,
      type: Array
    }
  },
}
</script>

<style scoped>
button {
  box-shadow:none;
  color:#7486C6;
  background:none;
  border:1px solid #7486C6;
}
</style>
