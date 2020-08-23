<template v-if="logs.meta">
    <table class="table">
        <thead>
            <h3>Number of requests recorded : {{ total }}</h3>
        </thead>
        <thead class="thead-dark">
            <th>UUID</th>
            <th>IP</th>
            <th>Response Type</th>
            <th>Country Of Origin</th>
            <th>Path</th>
            <th>Response Time</th>
        </thead>
        <log-table-body v-for="log in logs.data"  v-bind:key="log.ref" :data="log"/>
        <tfoot>
            <nav aria-label="Page navigation" class="mt-4">
                <pagination :data="logs" @pagination-change-page="fetchLogs" :show-disabled="true">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </nav>
        </tfoot>
    </table>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                logs: {},
                url: '/api/logs/with-pagination',
                total: 0
            }
        },
        mounted() {
            this.fetchLogs();
        },
        methods: {
            fetchLogs(page = 1) {
                return axios.get(this.url+`?page=${page}`)
                    .then((response) => {
                        this.logs  = response.data;
                        this.total = response.data.totalOfRequestRecorded;
                    })
                    .catch(() => {
                        console.log('handle server error from here');
                    });
            },
            fetchPaginateLogs(url) {
                this.url = url;
                this.fetchLogs();
            }
        }
    }
</script>
