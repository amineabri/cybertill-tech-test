<template>
    <div>
        <div slot="emptystate">
            <h3>Number of requests recorded : {{ settings.totalOfRequestRecorded }}</h3>
        </div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :row-style-class="rowStyleClassFn"
            :group-options="{
            enabled: true
        }"
            :pagination-options="{
            enabled: true
        }"
            :line-numbers="true"
        ></vue-good-table>
    </div>
</template>
<script>
    import axios from 'axios';
    import { VueGoodTable } from 'vue-good-table';
    import 'vue-good-table/dist/vue-good-table.css'

    export default {
        components: {
            VueGoodTable,
        },
        data() {
            return {
                settings: {
                    totalOfRequestRecorded: 0,
                },
                offset: 4,
                columns: [
                    {
                        label: 'Country Of Origin',
                        field: 'countryOfOrigin'
                    },
                    {
                        label: 'IP',
                        field: 'ipAddress',
                    },
                    {
                        label: 'Response Type',
                        field: 'responseType'
                    },
                    {
                        label: 'PATH',
                        field: 'path',
                    },
                    {
                        label: 'Response Time',
                        field: 'responseTime'
                    }
                ],
                rows: [],
            }
        },
        mounted() {
            this.fetchLogs();
        },
        methods: {
            fetchLogs() {
                return axios.get(`/api/logs/without-pagination?page=${this.settings.current_page}&per_page=${this.settings.per_page}`)
                    .then((response) => {
                    this.rows     = response.data.data;
                    this.settings = response.data.settings;
                })
                    .catch(() => {
                    console.log('handle server error from here');
                });
            },
            rowStyleClassFn(row) {
                return row.responseType === 500 ? 'table-danger' : '';
            },
        }
    }
</script>
