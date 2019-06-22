import Vue from 'vue';

export const state = {
    data: []
}

export const getters = {
    getItems() {
        return state.data
    }
}

export const mutations = {
    storeItem(item) {
        if (state.data.length > 0 && state.data.filter(existingItem => existingItem.id === item.id).length > 0) {
            state.data
                .filter(existingItem => existingItem.id === item.id)
                .map(existingItem => {
                    return existingItem.quantity = parseInt(existingItem.quantity) + parseInt(item.quantity);                        
                })
        } else {
            state.data.push(item)
        }
    },
    removeItem(index) {
        state.data.splice(index)
    },
    flushItemsArray() {
        state.data.splice(0);
    }
}

export default {
    state,
    getters,
    mutations
}