<template>
    <div>
        <div class="row justify-content-center w-50 m-auto mt-5">
            <div class="col-ml-4">
                <div class="card">
                    <div class="card-header text-center">
                        {{$t('create workspace')}}

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">  {{$t('workspace name')}}</label>
                            <input
                                v-model="formData.name"
                                type="text"
                                class="form-control"
                                name="name"
                            >
                            <p class="text-danger mt-1" v-text="errors.name"></p>
                        </div>


                        <div class="form-group ">
                            <router-link
                                class="float-right"
                                to="/workspaces"
                            >
                                {{$t('workspace list')}}
                            </router-link>
                        </div>

                        <div class="form-group text-center">
                            <button
                                class="btn btn-primary text-center"
                                @click.prevent="create_handler"
                            >
                                {{$t('create')}}
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
                name: '',
                token: '',

            },
            errors: {},
        };
    },
    methods: {
        create_handler() {
            this.formData.token = localStorage.getItem("token");
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .post('/api/workspaces/create', this.formData)
                    .then((response) => {

                        console.log('you make work space  successfully');


                        this.$router.push({name: 'workspaceList'});
                    })
                    .catch((errors) => {
                        this.errors = errors.response.data.errors;
                        console.log(errors);
                    });
            });
        },
    },
};
</script>
