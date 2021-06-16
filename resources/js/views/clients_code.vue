<template>
  {{client.code}}
  {{client.name}}
  {{client.created_at}}
  <div v-for="subscription in client.subscriptions" :key="subscription.code">
    {{subscription.publication_name}}
    {{subscription.publication_price}}
    {{subscription.publication_count}}
    {{subscription.code_receipt}} <!-- router.push -->
    {{subscription.created_at}}
    {{subscription.date_start}}
    {{subscription.delivered_at}}
    {{subscription.date_end}}

  </div>
  receipts->subscriptions->dropdown
</template>

<script>
export default {
  name: "Clients_code",
  metaInfo() {
    return { title: this.$title('show_client') }
  },
  data() {
    return {
      client: null,
      loading: true
    }
  },
  mounted() {
    const code = this.$route.params.code
    this.$store.dispatch('fetch_client', code).then( res => {
      this.client = res
      this.loading = false
    })
  }
}
</script>

<style scoped>

</style>
