<template>
  <div>
    <grid-filters :filters="config.filters" @update="updateFilter"></grid-filters>
    <div class="grid grid-flow-row-dense grid-cols-6 grid-rows-1 mt-10">
      <grid-display-column v-model:config="configColumns"
                           @update="updateColumnDefaultValue"></grid-display-column>
      <grid-search @update="updateGlobalSearch"></grid-search>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
              <grid-thead-tr :thead-tr="configColumns" @update="updateOrderBy"></grid-thead-tr>
              <tbody>
              <grid-tbody-tr :tbody="tbody" :config="configColumns"></grid-tbody-tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <grid-footer v-if="totalPages > 0" v-bind:page="page" v-bind:total-pages="totalPages"
                 @changePage="changePage"></grid-footer>
  </div>
</template>

<script>
import GridTbodyTr from "./grid-tbody-tr";
import GridTheadTr from "./grid-thead-tr";
import axios from "axios";
import GridFooter from "./grid-footer";
import GridSearch from "./grid-search";
import GridFilters from "./grid-filters";
import GridDisplayColumn from "./grid-display-column";

export default {
  name: "grid",
  components: {GridDisplayColumn, GridFilters, GridSearch, GridFooter, GridTbodyTr, GridTheadTr},
  props: {
    config: {type: Object},
    routeAjax: {type: String},
  },
  data() {
    return {
      tbody: {type: [Object, Array], default: []},
      totalPages: {type: Number, default: 0},
      page: {type: Number, default: 1},
      globalSearch: '',
      orderBy: {},
      filtersValues: [],
      configColumns: this.config.columns,
    }
  },
  methods: {
    execRequest: function (url, params = {}) {
      axios.get(url, {params: params})
          .then((response) => {
            let data = response.data;
            this.tbody = data.values;
            this.totalPages = data.totalPages;
            this.page = parseInt(data.pageToShow);
          })
    },
    loadPage: function (page) {
      console.log("loadpage")
      this.execRequest(this.routeAjax, {
        page: page,
        search: this.globalSearch,
        filters: this.filtersValues,
        orderBy: this.orderBy,
      })
    },
    changePage: function (page) {
      console.log("change page")
      // this.loadPage(page);
    },
    updateColumnDefaultValue(index) {
      this.configColumns[index]['default'] = !this.configColumns[index]['default'];
    },
    updateFilter(idFilter, value) {
      if (idFilter in this.filtersValues) {
        delete this.filtersValues[idFilter];
      }

      if (value !== '') {
        this.filtersValues[idFilter] = value;
      }

      //   this.loadPage(1);
    },
    updateGlobalSearch(value) {
      this.globalSearch = value;
      //this.loadPage(1);
    },
    updateOrderBy(field, orderByAsc) {
      let array = [];
      array[field] = orderByAsc ? 'ASC' : 'DESC';

      this.orderBy = array;
      //  this.loadPage(1);
    },
  },
  created() {
    //  this.loadPage(1);

  },
}
</script>

<style scoped>

</style>