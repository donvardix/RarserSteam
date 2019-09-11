import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        items: []
    },
    getters: {
        items(state) {
            return state.items
        }
    },
    mutations: {
        getItems(state, items) {
            state.items = items
        }
    },
    actions: {
        getItems ({commit}){
            axios.get('/api/items').then(response => {
                commit('getItems', response.data)
            })
        }
    }
})
