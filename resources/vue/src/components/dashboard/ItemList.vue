<template>
    <div class="col">
        <h2 class="text-center mb-3">{{ title }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Item</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items">
                <th scope="row">{{ item.id }}</th>
                <td>{{ item.name }}</td>
                <td>
                    <a href="" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'ItemList',
        data() {
            return {
                title: 'List of items',
            }
        },
        computed: {
            items() {
                return this.$store.getters.items
            }
        },
        created() {
            this.$store.dispatch('getItems')
        }
    }
</script>
