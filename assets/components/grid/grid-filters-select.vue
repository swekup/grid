<template>
  <div class="grid grid-cols-2">
    <div class="flex justify-center items-center">
      {{ title }}
    </div>
    <div>
      <select :id="selectId"
              class="bg-gray-50 border text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option></option>
        <option v-for="(value,valueId) in options" :value="valueId">{{ value }}</option>
      </select>
    </div>
  </div>
</template>

<script>

export default {
  name: "grid-filters-select",
  props: {
    options: Object,
    selectId: String,
    title: String,
  },
}
</script>

<style scoped>

</style>