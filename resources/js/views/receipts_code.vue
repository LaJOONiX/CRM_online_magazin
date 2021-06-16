<template>
  <div>
    <Loader v-if="loading" />
    <div v-else-if="receipt">
      <div class="breadcrumb-wrap">
        <router-link to="/" class="breadcrumb">{{ 'Menu_Receipts' | localize }}</router-link>
        <a @click.prevent class="breadcrumb">{{ receipt.code }}</a>
      </div>
      <div class="row">
        <div class="col s12 m6">
          <div style="background: #EDF8F3;
  box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.15), 0px 0px 4px rgba(0, 0, 0, 0.1);color:black" class="card">
            <div class="card-content">
              <span class="card-title">Подробный просмотр квитанции {{receipt.code}}</span>
              <div>{{receipt.created_at}}</div>
              <div>{{receipt.payment_code}}</div>
              <div>-------------------------------------------------------------</div>
              <div>
                <span style="display:inline-block;padding: 2px 10px;border-radius:8px;border:1px solid #431321">Подписки</span>
                <div v-for="(subscription,index) in receipt.subscriptions">
                  <div>Код подписки: {{subscription.code}}</div>
                  <div>Количество изданий: {{subscription.count}}</div>
                  <div>Название издания: {{subscription.publication.title}}</div>
                  <div>Когда создано: {{subscription.created_at}}</div>
                  <div>-------------------------------------------------------------</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="center" v-else>Запись с id = {{$route.params.id}} не найдена</p>
  </div>
</template>

<script>
export default {
  name: "Receipts_code",
  metaInfo() {
    return { title: this.$title(`show_receipt`) }
  },
  data() {
    return {
      receipt: null,
      loading: true
    }
  },
  mounted() {
    const code = this.$route.params.code
    this.$store.dispatch('fetch_receipt', code).then((res) => {
      this.receipt = res
      this.loading = false
    })
  }
}
</script>

<style scoped>

</style>
