require('./bootstrap');

window.Vue = require('vue').default;
Vue.component('data-table',             		require('./components/DataTable.vue').default);
Vue.component('region-component', 				require('./components/RegionComponent.vue').default);
Vue.component('departament-component', 			require('./components/DepartamentComponent.vue').default);
Vue.component('municipality-component', 		require('./components/MunicipalityComponent.vue').default);
Vue.component('zones-component', 				require('./components/ZoneComponent.vue').default);
Vue.component('bank-component', 				require('./components/BankComponent.vue').default);
Vue.component('user-component', 				require('./components/UserComponent.vue').default);
Vue.component('cliente-component', 				require('./components/ClienteComponent.vue').default);
Vue.component('property-component', 			require('./components/PropertyComponent.vue').default);
Vue.component('propertypdf-component', 			require('./components/PropertyPDFComponent.vue').default);
Vue.component('roles-component', 				require('./components/RoleComponent.vue').default);
//Vue.use(DataTable);
import Editor from '@tinymce/tinymce-vue'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
const app = new Vue({
    el: '#app',
});
