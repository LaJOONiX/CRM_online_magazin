<template>
  <table class="striped">
    <thead>
    <tr>
      <th>Код</th>
      <th>Товар</th>
      <th>Адрес</th>
      <th>Доставить от</th>
      <th>Дата доставки</th>
      <th>Доставить до</th>
      <th>Сумма</th>

      <th></th> <!-- Кнопка доставить -->
      <th></th> <!-- Кнопка подробно просмотра подписки -->
    </tr>
    </thead>
    <tbody>
    <tr v-for="product_offer in product_offers" :key="product_offer.code">
      <td>{{product_offer.code}}</td>
      <td>{{product_offer.product.title}}</td>
<!--      <td>{{product_offer.count}}</td>-->
<!--      <td>{{product_offer.price}}</td>-->
      <td>{{product_offer.address}}</td>
      <td>{{product_offer.start_at}}</td>
      <td style="position:relative;">
        <button style="position:relative;left:-17.5px;display:block;margin:0 auto;"
                v-if="!product_offer.delivered_at"
                @click="$emit('deliver', product_offer.code)"
                class="btn btn-manage-round"
                data-position="top"
                v-tooltip.noloc="'Доставить (дата-сегодня)'"
        >
        <i style="cursor:pointer" class="small material-icons">clear_all</i>
        </button>
        <span v-else>{{product_offer.delivered_at}}</span>
      </td>
      <td>{{product_offer.end_at}}</td>
      <td>
        <span
          data-position="top"
          style="padding:1px 5px;border-radius:5px;border:1px solid orangered"
          v-tooltip.noloc="(function(){return product_offer.product.title + ` ${product_offer.product.price}₽x${product_offer.count}=${product_offer.product.price*product_offer.count}` + '<br>'}())"
        >
          {{product_offer.count * product_offer.product.price}}
        </span>

      </td>


      <show_arrow_table :push_path="'/product_offer/' + product_offer.code" :tooltip="'Просмотреть платеж'" />
    </tr>
    </tbody>
  </table>
</template>

<script>
import show_arrow_table from "../assets/show_arrow_table";

export default {
  name: "product_offers_table",
  props: {
    product_offers: {
      required: true,
      type: Array
    }
  },

  components: {show_arrow_table}
}
</script>

<style scoped>

</style>
