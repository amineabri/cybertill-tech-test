<template>
        <tbody>
            <tr class="table-active">
                <td colspan="5" class="">
                    <span class="font-weight-bold">{{ data.countryOfOrigin }} ({{ data.children.length }})</span>
                </td>
                <td class="text-muted">
                    <span class="font-weight-bold">{{ data.responseTime }}%</span>
                </td>
            </tr>
            <tr v-for="log in data.children" v-bind:class="[log.responseType === 500 ? 'table-danger' : '']">
                <td>{{ log.uuid }}</td>
                <td>{{ log.ipAddress }}</td>
                <td>{{ log.responseType }}</td>
                <td>{{ log.countryOfOrigin }}</td>
                <td>{{ log.path }}</td>
                <td>{{ log.responseTime }}</td>
            </tr>
        </tbody>
</template>
<script>
    export default {
        data() {
            return {
                logs: {},
            }
        },
        props: ['data'],
        mounted() {
            this.fetchLogs();
        },
        methods: {
            fetchLogs() {
                this.logs = this.data.children;
            }
        }
    }
</script>
