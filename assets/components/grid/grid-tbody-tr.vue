<template>
  <tr class="border-b" v-for="(array, index) in tbody" :class="colorLine(index)">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-normal" v-for="(value,index) in array" v-show="showTr(index)">
      {{ value }}
    </td>
  </tr>
</template>

<script>
export default {
  name: "grid-tbody-tr",
  props: {
    tbody: {type: [Object, Array], default: []},
    config: {type: Object, default: []},
  },
  data() {
    return {
      line: 0,
    }
  },
  methods: {
    colorLine: function (indexLine) {
      if (Number(indexLine) % 2 == 0) {
        return '';
      }

      return 'bg-gray-100';
    },
    showTr: function (tr) {
      return this.config[tr] ? !this.config[tr].hidden && this.config[tr].default : false;
    }
  }
}
</script>

<style scoped>

</style>