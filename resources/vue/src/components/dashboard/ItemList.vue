<template>
    <div class="col">
        <h2 class="text-center mb-3">List of items</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Item</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <!--                    @foreach ($items as $item)-->
            <tr>
                <th scope="row"><!--{{ $item->id }}--></th>
                <td><!--{{ $item->name }}--></td>
                <td>
                    <a href="" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </td>
            </tr>
            <!--                    @endforeach-->
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'ItemList',
        data() {
            return {
                select: null,
                title: 'Add item',
                games: [
                    'Dota 2',
                    'CS:GO'
                ],
            }
        },
    }
</script>