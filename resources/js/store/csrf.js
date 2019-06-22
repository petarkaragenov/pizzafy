import Vue from 'vue';

export const state = {
    data: []
}

export const getters = {
    getCsrfToken() {
        return state.data;
    }
}

export const mutations = {
    storeCsrfToken(token) {
        state.data.push(token)
    }
}

export default {
    state,
    getters,
    mutations
}