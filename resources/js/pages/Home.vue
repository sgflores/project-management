<template>
    <div class="vld-parent">
        <vue-loader></vue-loader>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="min-height:500px;">
                    <div class="card-header">
                        <h2>Project List</h2>  
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <th>Name</th>
                                    <th>Tasks</th>
                                    <td></td>
                                </thead>
                                <tbody>
                                    <tr v-for="list in projects" :key="list.id"
                                        style="cursor:pointer;padding:1px;" @click="selectProject(list)"
                                        :class="{'bg-success': selectedProject && selectedProject.id == list.id}">
                                        <td>
                                            {{list.name}}
                                        </td>
                                        <td>
                                            <span v-if="list.tasks">
                                                {{list.tasks.length}}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" @click="deleteProject(list)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" style="min-height:500px;">
                    <div class="card-header">
                        <h2> Project Details </h2>
                    </div>
                    <div class="card-body">
                        <div v-if="selectedProject" class=" table-responsive">
                            <h2> {{selectedProject.name}} </h2>

                            <table v-if="selectedProject.tasks.length > 0" class="table table-sm table-striped">
                                <thead>
                                    <th>Name</th>
                                    <th>Priority</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                    <tr v-for="list in selectedProject.tasks" :key="list.id">
                                        <td>{{list.name}}</td>
                                        <td>{{list.priority}}</td>
                                        <td>{{list.created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div v-else class="alert alert-warning">
                                Selected Project has no assigned task
                            </div>

                        </div>
                        <div v-else class="alert alert-warning">
                            No Selected Project
                        </div>
                    </div>
                    <div class="card-footer" v-if="selectedProject">
                        <router-link :to="'/project/'+selectedProject.id" class="btn btn-primary col-md-12">Edit Project</router-link>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters({
            'projects': 'projects',
        }),
    },
    data() {
        return {
            selectedProject: null
        };
    },
    methods: {
        loadProjects() {
            this.$store.dispatch('updateIsLoading', true);
            this.$store.dispatch('all')
            .then((response) => {
                // console.log(this.projects);
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                this.$store.dispatch('updateIsLoading', false);
            });
        },
        selectProject(project) {
            this.selectedProject = project;
        },
        deleteProject(project) {
            // global window instance init @app.js
            project.vm = this; // instance of vue
            helpers.confirmDeleteSwal('delete', project);
        }
    },
    created() {
        this.loadProjects();
    }
}
</script>