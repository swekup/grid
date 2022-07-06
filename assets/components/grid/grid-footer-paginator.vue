<template>
  <nav aria-label="Page navigation example">
    <ul class="inline-flex items-center -space-x-px">
      <li v-if="this.isNotFirstPage()">
        <button @click="changePage(this.page - 1)"
                class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <span class="sr-only">Précédent</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
      </li>
      <li v-for="item in this.initPagesToShow()">
        <button v-if="isSamePage(item)" aria-current="page" disabled
                class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50  border-blue-300 border hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
          {{ item }}
        </button>
        <button v-else :data-id="getDataPageId(item)" :disabled="disabledButton(item)" @click="changePage(item)"
                class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          {{ item }}
        </button>
      </li>
      <li v-if="this.isNotLastPage()">
        <button @click="changePage(this.page + 1)"
                class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <span class="sr-only">Suivant</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
      </li>
    </ul>
  </nav>
</template>

<script>

export default {
  name: "grid-footer-paginator",
  props: {
    page: Number,
    totalPages: Number,
  },
  methods: {
    changePage: function (page) {
      this.$emit('update', page);
   //   this.$parent.$parent.loadPage(page);
    },
    getDataPageId(page) {
      return Number.isInteger(page) ? page : '';
    },
    disabledButton(page) {
      return !Number.isInteger(page);
    },
    initPagesToShow() {
      let pagesToShow = [];

      if (this.page < 5) {
        pagesToShow = [1, 2, 3, 4, 5, 6, '...'];
      } else if (this.page === this.totalPages) {
        pagesToShow = ['...', this.page - 2, this.page - 1, this.page];
      } else {
        pagesToShow = ['...', this.page - 2, this.page - 1, this.page, this.page + 1];
        if (this.totalPages >= this.page + 2) {
          pagesToShow.push(this.page + 2);
          if (this.totalPages >= this.page + 3) {
            pagesToShow.push('...');
          }
        }
      }

      return pagesToShow;
    },
    isSamePage(page) {
      return this.page === page;
    },
    isNotFirstPage() {
      return this.page > 1;
    },
    isNotLastPage() {
      return this.page < this.totalPages;
    },
  },
}
</script>

<style scoped>

</style>