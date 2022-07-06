<template>
  <div class="grid grid-cols-2 gap-2">
    <div>
      Page : {{page}} / {{totalPages}}
    </div>
    <div>
      <grid-footer-paginator :page="page" :totalPages="totalPages"></grid-footer-paginator>
    </div>
  </div>
</template>

<script>
import GridFooterPaginator from "./grid-footer-paginator";

export default {
  name: "grid-footer",
  components: {GridFooterPaginator},
  props: {
    totalPages: {type: Number, default: 0},
    page: {type: Number, default: 1},
  },
}
</script>

<style scoped>

</style>