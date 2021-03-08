require('./bootstrap');
import DataTable from 'laravel-vue-datatable';
window.Vue = require('vue').default;
Vue.component('propierties-component',  require('./components/PropiertieComponent.vue').default);
Vue.component('regions-component', 		require('./components/RegionComponent.vue').default);
Vue.component('zones-component', 		require('./components/ZoneComponent.vue').default);
Vue.component('banks-component', 		require('./components/BankComponent.vue').default);
Vue.component('history-component', 		require('./components/HistoryComponent.vue').default);
Vue.component('roles-component', 		require('./components/RoleComponent.vue').default);
Vue.component('users-component', 		require('./components/UserComponent.vue').default);
Vue.use(DataTable);

const app = new Vue({
    el: '#app',
});
