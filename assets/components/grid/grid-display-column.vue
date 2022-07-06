<template>
  <div class="col-span-1 ml-5">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown" data-dropdown-placement="right"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Affichage
      <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown"
         class="z-10 hidden bg-white rounded shadow w-44 w-3/12">
      <ul class="py-1 text-sm" aria-labelledby="dropdownDefault">
        <li v-for="(li,index) in config" :hidden="li.hidden">
          <button class="block px-4 py-2 hover:bg-gray-100 w-full" @click="traitementColumn(index)">
            <span class="grid grid-rows-1 grid-cols-6">
                 <svg class="w-6 h-6 text-green-600 col-span-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg" v-if="li.default">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              <div class="col-span-1" v-else></div>
                <span class="text-left col-span-5"> {{ li.title }}</span>
            </span>
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "grid-display-column",
  props: {
    config: Object,
  },
  methods: {
    traitementColumn: function (index) {
      this.$emit('update', index);
    },
  },
}
</script>

<style scoped>

</style>