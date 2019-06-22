import Vue from 'vue';

export const state = {
    data: []
}

export const getters = {
    getUser() {
        return state.data
    }
}

export const mutations = {
    userUpdate(user) {
        if (state.data.length > 0) {
            state.data.pop()
            state.data.push(user)
        } else {
            state.data.push(JSON.parse(user))
        }       
    }
}

export default {
    state,
    getters,
    mutations
}