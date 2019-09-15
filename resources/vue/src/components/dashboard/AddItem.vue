<template>
    <div class="col">
        <h2 class="text-center">{{ title }}</h2>
        <hr>
        <div class="row">
            <div class="col-3">
                <label for="appId" class="sr-only">App ID</label>
                <select id="appId" name="appId" class="custom-select" v-model="appId">
                    <option v-for="game in games" v-bind:value="game.value">
                        {{ game.text }}
                    </option>
                </select>
            </div>
            <div class="col-9">
                <label for="nameItem" class="sr-only">Name item</label>
                <input v-model="nameItem" id="nameItem" class="form-control" name="nameItem" type="text"
                       placeholder="Name item">
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <button @click="addItem" id="addItem" class="btn btn-primary btn-block" type="button">Add</button>
            </div>
            <div class="col-2 d-flex justify-content-center">
                <div v-if="wait" class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span v-if="success" class="align-middle text-success">Done</span>
                <span v-if="error" class="align-middle text-danger">Error</span>
            </div>
            <div class="col-5">
                <button @click="startParser" class="btn btn-warning btn-block" type="button">Start parser</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: 'AddItem',
        data() {
            return {
                title: 'Add item',
                appId: 570,
                games: [
                    {text: 'Dota 2', value: 570},
                    {text: 'CS:GO', value: 730}
                ],
                nameItem: '',
                wait: false,
                success: false,
                error: false,
            }
        },
        methods: {
            addItem() {
                this.wait = true;
                let memberData = {
                    appId: this.appId,
                    nameItem: this.nameItem
                };
                axios.post('/api/items', memberData).then(response => {
                    this.wait = false;
                    if (response.data.success === 1) {
                        this.$store.dispatch('getItems');
                        this.success = true;
                        setTimeout(() => {
                            this.success = false;
                        }, 2000);
                    } else if (response.data.success === 0) {
                        this.error = true;
                        setTimeout(() => {
                            this.error = false;
                        }, 2000);
                    } else {
                        console.log('Unknown error')
                    }
                })
            },
            startParser() {
                this.wait = true;
                axios.get('/api/parser').then(response => {
                    this.wait = false;
                    if (response.data.success === 1) {
                        this.success = true;
                        setTimeout(() => {
                            this.success = false;
                        }, 2000);
                    } else if (response.data.success === 0) {
                        this.error = true;
                        setTimeout(() => {
                            this.error = false;
                        }, 2000);
                    } else {
                        console.log('Unknown error')
                    }
                });

            }
        }
    }
</script>
