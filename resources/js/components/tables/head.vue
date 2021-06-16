<template>
  <thead>
  <tr>
    <th v-for="head in heads" :key="head">{{head}}</th>
  </tr>
  </thead>
</template>

<script>
export default {
  name: "head.vue",
  props: ['heads']
}
</script>

<style scoped>

</style>
