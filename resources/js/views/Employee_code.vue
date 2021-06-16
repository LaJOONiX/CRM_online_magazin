<template>
fio
avatar (сделать загрузку аватара)
Недавно оформленные заказы а в них подписки как бы нажимаем и там внутри инфа о них и общая цена
</template>

<script>
export default {
  name: "Employee_code",
  metaInfo() {
    return { title: this.$title('show_employee') }
  },
  data() {
    return {
      employee: null,
      loading: true
    }
  },
  mounted() {
    const code = this.$route.params.code
    this.$store.dispatch('fetch_employee', code).then( res => {
      this.employee = res
    })
    this.loading = false
  }
}
</script>

<style scoped>

</style>
