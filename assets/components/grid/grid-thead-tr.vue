<template>
  <thead class="bg-white border-b">
  <tr>
    <th scope="col" class="text-sm font-medium text-left w-1/12" v-for="(value,index) in theadTr"
        v-show="value.hidden === false && value.default === true">
      <div class="grid grid-cols-2">
        <div> {{ value.title }}</div>
        <div class="flex justify-end mr-5">
          <button class="flex justify-center items-center" v-on:click="execOrderBy(index)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " v-bind:class="orderByAscClass(index)"
                 viewBox="0 0 10 20"
                 fill="currentColor">
              <path fill-rule="evenodd"
                    d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" v-bind:class="orderByDescClass(index)"
                 viewBox="0 0 10 20"
                 fill="currentColor">
              <path fill-rule="evenodd"
                    d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"/>
            </svg>
          </button>
        </div>
      </div>
    </th>
  </tr>
  </thead>
</template>

<script>
export default {
  name: "grid-thead-tr",
  props: {
    theadTr: {type: Object},
  },
  data() {
    return {
      orderByAsc: {type: Boolean, default: true},
      orderById: {type: String}
    }
  },
  methods: {
    execOrderBy: function (newOrderById) {
      let oldOrderBy = this.orderById;

      if (oldOrderBy !== newOrderById) {
        this.orderByAsc = true;
      } else {
        this.orderByAsc = !this.orderByAsc;
      }
      this.$emit('update', newOrderById, this.orderByAsc);

      this.orderById = newOrderById;

    },
    orderByAscClass: function (newOrderBy) {
      if (this.orderById === newOrderBy && this.orderByAsc) {
        return ['font-black']
      } else {
        return ['font-normal text-gray-400']
      }
    },
    orderByDescClass: function (newOrderBy) {
      if (this.orderById === newOrderBy && !this.orderByAsc) {
        return ['font-black']
      } else {
        return ['font-normal text-gray-400']
      }
    },
  },

  created() {
  }
}
</script>

<style scoped>

</style>