<template>
    <div class="container">
        <hr>
        <div class="row">
            <AddItem/>
            <ItemList/>
        </div>
    </div>
</template>

<script>
    import AddItem from '@/components/dashboard/AddItem.vue'
    import ItemList from '@/components/dashboard/ItemList.vue'

    export default {
        name: 'dashboard',
        components: {
            AddItem,
            ItemList
        }
    }
</script>
