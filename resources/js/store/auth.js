import Vuex from 'vuex';
import axios from 'axios';
import apiURL from '../connect.js';
const store = new Vuex.Store({
    state: {
        authenticated: false,
        user: {},
        admin: {},
        token: localStorage.getItem('token') || 0,
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user;
        },
        admin(state) {
            return state.admin;
        },
        token(state) {
            return state.token
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        setUser(state, user) {
            state.user = user;
        },
        setAdmin(state, admin) {
            state.admin = admin;
        },
        setToken(state, token) {
            state.token = token;
        },
    },
    actions: {
        login({ commit }, { user, token }) {
            commit('setUser', user);
            commit('setToken', token);
        },
        logout({ commit }) {
            commit('setUser', null);
            commit('setToken', null);
        },
        async setTokenUser({commit}, token) {
            localStorage.setItem('token', token.token);
            commit('setToken',  token.token);
        },
        async getUser({commit, state}) {
            const token = localStorage.getItem('token');
            const headers = {
                'accept': 'application/json',
                'Authorization': 'Bearer '  + token
            }
            try {
                const API_BACK_END = apiURL.baseURL;
                if(token != "" && token != null){
                    const { data } = await axios.get(`${API_BACK_END}auth/get-user`, {headers : headers});
                    if (data.status == 'success') {
                        commit('setUser', data.data);
                        commit('setAdmin', data.admin);
                        commit('SET_AUTHENTICATED', true);
                    }
                }
            } catch ({ res }) {
                localStorage.removeItem('token');
                commit('setUser', {});
                commit('setAdmin', {});
                commit('SET_AUTHENTICATED', false);
            }
        },
       
        async logout({commit}, token) {
            localStorage.removeItem('token');
            commit('setUser', {});
            commit('setAdmin', {});
            commit('SET_AUTHENTICATED', false);
        }
    }
});
export default store;
