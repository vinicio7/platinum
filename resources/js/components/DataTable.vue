<template>
    <table class=" display  table table-striped table-bordered table-responsive" >
        <thead>
        <tr>
            <th v-for="titleitem in parameters.titles" v-html="title(titleitem)"></th>
        </tr>
        </thead>
        <tfoot v-if="footer">
        <tr>
            <th v-for="column in parameters.columns" v-html="column.footer"></th>
        </tr>
        </tfoot>
    </table>
</template>

<script>
    window.$ = window.jQuery = require('jquery');
    require('datatables.net');
    require('datatables.net-bs4');
    require('datatables.net-buttons');
    require('datatables.net-buttons-bs4');
    export default{
        data() {
            return {
                dataTable: {},
                renderComponent: true
            }
        },
        methods: {
            title(column) {
                return column.title || this.titleCase(column.data);
            },
            titleCase(str) {
                return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
            },
            reload(){
                this.renderComponent = false;
                this.$nextTick(() => {
                this.renderComponent = true;
                });
             }
        },
        computed: {
            parameters() {
                const vm = this;
                return window.$.extend({
                    serverSide: true,
                    processing: true,
                    responsive: true
                }, {
                    language: { url: "/lang/datatables-spanish.json" },
                    dom: '<f<t>ip>',
                    ajax: this.ajax,
                    columns: this.columns,
                    titles: this.titles,
                    responsive: true,
                    createdRow(...args) {
                        vm.$emit('created-row', ...args);
                    },
                    drawCallback(...args) {
                        vm.$emit('draw', ...args);
                    },
                    footerCallback(...args) {
                        vm.$emit('footer', ...args);
                    },
                    formatNumber(...args) {
                        vm.$emit('format', ...args);
                    },
                    headerCallback(...args) {
                        vm.$emit('header', ...args);
                    },
                    infoCallback(...args) {
                        vm.$emit('info', ...args);
                    },
                    initComplete(...args) {
                        vm.$emit('init', ...args);
                    },
                    preDrawCallback(...args) {
                        vm.$emit('pre-draw', ...args);
                    },
                    rowCallback(...args) {
                        vm.$emit('draw-row', ...args);
                    },
                    stateLoadCallback(...args) {
                        vm.$emit('state-load', ...args);
                    },
                    stateLoaded(...args) {
                        vm.$emit('state-loaded', ...args);
                    },
                    stateLoadParams(...args) {
                        vm.$emit('state-load-params', ...args);
                    },
                    stateSaveCallback(...args) {
                        vm.$emit('state-save', ...args);
                    },
                    stateSaveParams(...args) {
                        vm.$emit('state-save-params', ...args);
                    },
                }, this.options);
            }
        },
        props: {
            footer: { default: false },
            columns: { type: Array },
            titles: { type: Array },
            ajax: { default: '' },
            options: { }
        },
        mounted() {
            this.dataTable = window.$(this.$el).DataTable(this.parameters);
            this.refresh = function(){
                window.$(this.$el).DataTable(this.parameters);
            }
        },
        destroyed() {
            this.dataTable.destroy();
        },
    }
</script>