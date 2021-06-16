<template>
  <td style="position:relative">
    <button
      style="cursor:pointer;position:absolute;background:#F8F8F8;border-radius:50%;width:32px;height:32px;top:50%;margin-top:-16px;border:2px solid #5F5F5F;color:#545454"
      data-position="top"
      v-tooltip.noloc="tooltip"
      @click="$router.push(push_path)">
      <i style="top:1px;left:-2px;position:relative;" class="material-icons">arrow_forward</i>
    </button>
  </td>
</template>

<script>
export default {
  name: "show_arrow_table",
  props: ['push_path', 'tooltip']
} //
</script>

<style scoped>

</style>
