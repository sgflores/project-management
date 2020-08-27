<template>
    <div class="vld-parent">
        <vue-loader></vue-loader>
        <div class="card">
            <div class="card-header">
                <span v-if="project">
                    {{(formType == 'Create') ? 'Create New Project' : 'Edit '+project.name }}
                </span>
            </div>
            <div class="card-body">
                <form @submit.prevent="saveProject">

                    <div class="form-group">
                        <label for="name">Project Name <required-label></required-label> </label>
                        <input type="text" class="form-control" 
                            id="name" name="name" 
                            v-model="$v.project.name.$model"
                            :class="{'is-invalid': $v.project.name.$error}"
                            placeholder="Enter Project Name">
                    </div>

                    <div class="form-group">
                        <label for="">Task Details </label>
                        <button type="button" class="btn btn-success btn-sm" @click="addNewTask"> Add New Task</button>
                    </div>

                    <draggable v-if="project.tasks && project.tasks.length > 0"  @change="dragChanged"
                        v-model="project.tasks"  @start="drag=true" @end="drag=false">
                        <div class="row" v-for="(list, index) in project.tasks" :key="index"
                            style="cursor:move;">
                                <div class="col-md-10 form-group">
                                    <input type="text" class="form-control"
                                        name="task_name" 
                                        v-model="$v.project.tasks.$each[index].name.$model"
                                        :class="{'is-invalid': $v.project.tasks.$each[index].name.$error}"
                                        placeholder="Enter Task Name">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm" @click="removeTask(index)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                        </div>
                    </draggable>

                    <div v-else class="alert alert-warning">
                        Task details is empty
                    </div>

                    <router-link to="/" class="btn btn-warning">Cancel</router-link>
                    <button type="submit" class="btn btn-primary">Save Project</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { required } from 'vuelidate/lib/validators';
import draggable from 'vuedraggable'
export default {
    components: {
        draggable
    },
    computed: {
        ...mapGetters({
            'project': 'project',
        }),
    },
    validations: {
        project: {
            name: {
                required,
            },
            tasks: {
                $each: {
                    name: {
                        required,
                    },
                    priority: {
                       required, 
                    },
                }
            }
        }
    },
    watch: {
        '$route' () {
            this.loadProject();
        },
    },
    data() {
        return {
            formType: 'Create',
        }
    },
    methods: {
        loadProject() {
            this.formType = this.$route.meta.formType || 'Create';

            if ( this.formType == 'Create' ) {
                this.$store.dispatch('setProject', null);
                return;
            }

            this.$store.dispatch('updateIsLoading', true);
            this.$store.dispatch('show', this.$route.params.id)
            .then(response => {
                // console.log(response);
                this.$store.dispatch('updateIsLoading', false);
            })
            .catch(error => {
                if ( error.response.status == 404 ) {
                    this.$router.push('/404');
                }
            })
            .finally(() => {
                this.$store.dispatch('updateIsLoading', false);
            });

        },
        addNewTask() {
            this.project.tasks.push({
                id: null,
                name: null,
                priority: this.project.tasks.length
            });
        },
        removeTask(index) {
            this.project.tasks.splice(index, 1);
        },
        saveProject() {
            
            // trigger vuelidate
            this.$v.$touch();
            if (this.$v.$invalid) {
                // @helpers.js
                helpers.toastMissingRequiredFields();
                return;
            }

            const action = this.formType == 'Create' ? 'save' : 'update';

            this.$store.dispatch('updateIsLoading', true);
            this.$store.dispatch(action, this.project)
            .then((response) => {
                // @helpers.js
                helpers.toastSaveSuccessMessage();
                this.$v.$reset();

                if (action == 'save') {
                    this.$store.dispatch('setProject', null);
                }
            })
            .catch((error) => {
                // global window object @helpers.js init @app.js
                helpers.toastBackendValidationErrors(error.response.data);
            })
            .finally(() => {
                this.$store.dispatch('updateIsLoading', false); // call parent store
            });
        },
        dragChanged(el) {
            this.project.tasks[el.moved.oldIndex].priority = el.moved.oldIndex;
            this.project.tasks[el.moved.newIndex].priority = el.moved.newIndex;
        }
    },
    mounted() {
        
    },
    created() {
        this.loadProject();
    }
}
</script>