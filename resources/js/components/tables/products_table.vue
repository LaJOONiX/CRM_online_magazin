<template>
  <div>
<!--    <button @click="get_type">УЗнать тип</button>-->
    <table class="striped">
      <thead>
      <tr>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Цена ₽</th>
        <th>Шт. в мес.</th>
        <th>Дата появления</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="product in products" :key="product.title">
        <td>{{product.title}}</td>
        <td>{{product.count}}</td>
        <td>{{product.price}}</td>
        <td>{{product.sold_month}}</td>
        <td>{{product.created_at}}</td>
        <td style="background:white;width:20px;">
          <button @click="$emit('edit', product.id)" data-micromodal-trigger="modal_edit" class="btn btn-manage-round">
            <i style="cursor:pointer" class="small material-icons">mode_edit</i>
          </button>
        </td>
        <td style="background:white;width:20px;">
          <button @click="$emit('del', product.id)" data-micromodal-trigger="modal_delete" class="btn btn-manage-round">
            <i style="cursor:pointer" class="small material-icons">close</i>
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "products_table",
  props: {
    products: {
      required: true,
      type: Array,
    }
  }
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
