import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import api from './api';

const store = new Vuex.Store({
    state: {
        isLoading: false,
        fullPage: true,
        color: '#20a8d8',
        loader: 'dots',
        projects: [],
        project: {}
    },

    // mutations will receive the state as first arguments
    // 2nd argument as the payload
    mutations: {
        updateIsLoading(state, isLoading) {
            state.isLoading = isLoading
        },
        setProjects(state, projects) {
            state.projects = projects;
        },
        setProject(state, project) {
            if (project) {
                state.project = project;
                return;
            }
            state.project = {
                id: null,
                name: null,
                tasks: []
            };
        },
        deleteProject(state, payload) {
            state.projects = state.projects.filter(project => {
                return project.id != payload.id;
            });
        },
    },

    // getters will receive the state as first arguments
    // getters will also receive other getters as the 2nd argument:
    getters: {
        projects(state) {
            return state.projects;
        },
        project(state) {
            return state.project;
        },
        isLoading(state) {
            return state.isLoading;
        },
        fullPage(state) {
            return state.fullPage;
        },
        color(state) {
            return state.color;
        }
    },

    // Actions are similar to mutations, the differences being that:
    // Instead of mutating the state, actions commit mutations.
    // Actions can contain arbitrary asynchronous operations.
    // actions will receive the context as first arguments
    // 2nd argument as the payload
    actions: {
        updateIsLoading(context, isLoading) {
            context.commit('updateIsLoading', isLoading);
        },
        setProjects(context, projects) {
            context.commit('setProjects', projects);
        },
        setProject(context, project) {
            context.commit('setProject', project);
        },
        all(context, payload) {
            return api.all('/projects', payload, context, 'setProjects');
        },
        show(context, id) {
            return api.show('/projects/'+id, null, context, 'setProject');
        },
        save(context, payload) {
            return api.save('/projects', payload, null, null);
        },
        update(context, payload) {
            return api.update('/projects/'+payload.id, payload, null, null);
        },
        delete(context, payload) {
            this.dispatch('updateIsLoading', true);
            return api.delete('/projects/'+payload.id, null, null)
            .then((response) => {
                // global window object @swal.js
                Toast.fire({
                    icon: 'success',
                    title: "Project has been deleted!"
                });
                payload.vm.selectedProject = null; // reinitialize selectedProject
                this.commit('deleteProject', payload);
                return response;
            })
            .catch((error) => {
                // global window object @helpers.js init @app.js
                helpers.toastBackendValidationErrors(error.response.data);
                return Promise.reject(error);
            })
            .finally(() => {
                this.dispatch('updateIsLoading', false); // call parent store
            });
        },
    },

    modules: {

    },
});

export default store;