<template>
  <div class='flex items-center justify-center'>
    <div class="rounded-xl border p-5 shadow-md w-11/12 bg-white">
      <div class="w-full items-center border-b pb-3">
        <div class="text-lg font-bold text-slate-700">Recherche avancée</div>
      </div>
      <div>
        <div class="grid grid-cols-4 mt-3">
          <span v-for="(filter,filterId) in filters" class="text-center grid-cols-2">
            <div>
              <span v-if="filter.type === 'select'">
                  <grid-filters-select :options="filter.options" :select-id="filterId"
                                       @change="selectChange($event)"
                                       :title="filter.title">
                  </grid-filters-select>
              </span>
              <span v-else-if="filter.type === 'search'">
                  <grid-filters-search></grid-filters-search>
              </span>
            </div>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GridFiltersSelect from "./grid-filters-select";
import GridFiltersSearch from "./grid-filters-search";

export default {
  name: "grid-filters",
  components: {GridFiltersSearch, GridFiltersSelect},
  props: {
    filters: Object,
  },
  data() {
    return {}
  },
  methods: {
    selectChange(event) {
      let value = event.target.value;
      let idSelect = event.target.id;console.log("selectChange")
      this.$emit('update', idSelect,value);

    },
  },
}
</script>

<style scoped>

</style>