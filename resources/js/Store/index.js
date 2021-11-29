import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.store({
    state:{
        count:0,
    },
    mutations:{
        INCREMENT(state){
            state.count++
        },
    },
    actions:{}
});

export default store;