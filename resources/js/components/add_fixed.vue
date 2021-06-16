<template>
  <div>
    <div style="right:0" class="fixed-action-btn">
      <button data-target="modal-create" class="btn-floating modal-trigger btn" data-position="left" v-tooltip="'CreateNewRecord'">
        <i style="background:#2C2C2C" class="large material-icons">add</i>
      </button>
    </div>
    <modal_create :class_name="class_name" />
  </div>
</template>

<script>
export default {
  name: "add-fixed",
}
</script>

<style scoped>

  .fixed-action-btn {
    right: 0
  }
  .btn-floating {
    border-radius:0;
    width:59px;
  }

</style>
