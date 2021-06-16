<template>
  <table class="striped">
    <thead>
    <tr>
      <th>Код</th>
      <th>Сотрудник</th>
      <th>Клиент</th>
      <th>Дата</th>
      <th></th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="receipt in receipts" :key="receipt.code">
      <td>{{receipt.code}}</td>
      <td>{{receipt.code_employee}}</td>
      <td>{{receipt.code_client}}</td>
      <td>{{receipt.created_at}}</td>
      <td style="position:relative;">
        <span data-position="top" v-tooltip.noloc="'Общая сумма квитанции'" style="padding:0 5px;border: 1px solid #F17D7D;border-radius: 5px;">{{receipt.sum}} ₽</span>
        <span data-position='top' v-tooltip.noloc="(function(){return receipt.product_offers.reduce((carry, item) =>
         { return carry + item.product.title + ` ${item.product.price}₽x${item.count}=${item.product.price*item.count}` + '<br>'},'')}())" style="position:absolute;left:-109px;margin-top:-2px;border-bottom:1px solid orangered">{{receipt.product_offers_count}} подписок</span>
      </td>
      <td>
        <button style="position: relative;left: -39px;" @click="$emit('set_receipt_code', receipt.code)" v-if="!receipt.payment_code" class="pay_button modal-trigger" data-target="modal_payment_code" data-position="top" v-tooltip.noloc="'Оплатить'">
          <i style="position: relative;left: -2px;top: 1px;" class="material-icons">done</i>
        </button>
        <div style="position: absolute;margin-left: -39px;margin-top:-15px;" v-else >
          <span v-tooltip.noloc="'Квитанция оплачена'" data-position="top">
            {{receipt.payment_code}}
            <button data-micromodal-trigger="modal_payment_code" v-if="receipt.payment_code" data-position="top" style="background:none;border:none;color:#4fd996" class="tooltipped">
              <i class="material-icons">done_all</i>
            </button>
          </span>
        </div>
      </td>

      <show_arrow_table :push_path="'/receipts/' + receipt.code" :tooltip="'Просмотреть квитанцию'" />
    </tr>
    </tbody>
  </table>
</template>

<script>
import show_arrow_table from "../assets/show_arrow_table";
export default {
  name: "receipts_table",
  components: {show_arrow_table},
  props: {
    receipts: {
      type: Array,
      required: true
    }
  },
  methods: {
    console(text) {
      console.log(text)
    }
  }
}
</script>

<style scoped>
  .pay_button {
    cursor: pointer;
    background: #C0CDDB;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
  }
</style>
