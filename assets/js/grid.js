import {createApp} from "vue";
import GridComponent from '/assets/components/grid/grid'

const app = createApp({})
app.component('grid', GridComponent)
app.mount('#app');

