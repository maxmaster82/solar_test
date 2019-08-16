import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        comments: [],
        formId: 0
    },
    mutations: {
        FETCH(state, comments) {
            function getNestedComments(comments, parent) {
                let nestestedComments = [];
                for(let i in comments) {
                    if(comments[i].parent === parent) {
                        let replies = getNestedComments(comments, comments[i].id);
                        if(replies.length) {
                            comments[i].replies = replies
                        }
                        nestestedComments.push(comments[i])
                    }
                }
                return nestestedComments;
            }
            state.comments = getNestedComments(comments.data, 0);
        }
    },
    actions: {
        fetch({commit}) {
            return axios.get(`/api/comments`)
                .then(response => commit('FETCH', response.data))
                .catch();
        },
        deleteComment({}, id) {
            axios.delete(`/api/comments/${id}`)
                .then(() => this.dispatch('fetch'))
                .catch();
        },
        editComment({}, comment) {
            axios.put(`/api/comments/${comment.id}`, {
                text: comment.text
            })
                .then(() => this.dispatch('fetch'));
        },
        addComment({}, payload) {
            axios.post(`/api/comments`, payload)
                .then(() => this.dispatch('fetch'));
        }
    }
})