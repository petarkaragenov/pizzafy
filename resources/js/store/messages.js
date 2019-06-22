import Vue from 'vue';

export const state = {
    data: []
}

export const getters = {
    getMessages() {
        return state.data;
    }
}

export const mutations = {
    storeMessages(obj) {
        state.data.push(obj);
    },
    emptyMessagesArray() {
        state.data.pop();
    }
}

export default {
    state,
    getters,
    mutations
}