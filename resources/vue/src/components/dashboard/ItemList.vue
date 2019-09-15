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
                    <button @click="deleteItem(item.id)" class="close" aria-label="Close" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'

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
        },
        methods: {
            deleteItem(id) {
                axios.delete('api/items/' + id);
                this.$store.dispatch('getItems');
            }
        }
    }
</script>
