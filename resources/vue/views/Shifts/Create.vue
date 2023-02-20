<template>
    <div>
        <div class="row justify-content-center w-50 m-auto mt-5">
            <div class="col-ml-4">
                <div class="card">
                    <div class="card-header text-center">
                        {{ $t('create shift') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        <label for="title"> {{ $t('title') }}</label>
                        <input
                            v-model="formData.title"
                            type="text"
                            class="form-control"
                            name="title"
                        >
                            <p class="text-danger mt-1" v-text="errors.title"></p>
                    </div>
                        <div class="form-group">
                            <label for=""> {{ $t('select workspace') }}</label>
                            <select v-model="formData.workspace_id_selected"  class="form-select" >
                                <option disabled value="">{{ $t('select') }}</option>
                                <option v-for="workspace in workspaces" :value="workspace.id">{{workspace.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="enter_time"> {{ $t('enter time') }}</label>
                            <input
                                v-model="formData.enter_time"
                                type="time"
                                class="form-control"
                                name="enter_time"
                            >
                            <p class="text-danger mt-1" v-text="errors.enter_time"></p>
                        </div>
                        <div class="form-group">
                            <label for="max_enter_time">{{ $t('max enter time') }}</label>
                            <input
                                v-model="formData.max_enter_time"
                                type="time"
                                class="form-control"
                                name="max_enter_time"
                            >
                            <p class="text-danger mt-1" v-text="errors.max_enter_time"></p>
                        </div>
                        <div class="form-group">
                            <label for="exit_time">{{ $t('exit time') }}</label>
                            <input
                                v-model="formData.exit_time"
                                type="time"
                                class="form-control"
                                name="exit_time"
                            >
                            <p class="text-danger mt-1" v-text="errors.exit_time"></p>
                        </div>


                        <div class="form-group ">
                            <router-link
                                class="float-right"
                                to="/workspaces"
                            >
                                {{ $t('workspace list') }}
                            </router-link>
                        </div>

                        <div class="form-group text-center">
                            <button
                                class="btn btn-primary text-center"
                                @click.prevent="create_handler"
                            >
                                {{ $t('create') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                title: '',
                enter_time: '',
                max_enter_time: '',
                exit_time: '',
                token: '',
                workspace_id_selected: '',


            },
            workspaces: [],
            errors:{},
        };
    },
    methods: {
        create_handler() {
            this.formData.token = localStorage.getItem("token");
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .post('/api/shifts/create', this.formData)
                    .then((response) => {

                        console.log('you make work Shift  successfully');


                        this.$router.push({name: 'shiftList'});
                    })
                    .catch((errors) => {
                        this.errors = errors.response.data.errors;
                        console.log(errors);
                    });
            });
        },
    },
    mounted() {
        this.formData.token = localStorage.getItem('token');
        axios.get('/sanctum/csrf-cookie').then((response) => {

            axios
                .post('/api/workspaces', this.formData)
                .then((response) => {
                    this.workspaces = response.data;
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors);
                });
        });
    },
};
</script>
