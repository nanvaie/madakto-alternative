<template>
    <div>
        <div class="row justify-content-center w-50 m-auto mt-5">
            <div class="col-ml-4">
                <div class="card">
                    <div class="card-header text-center">
                        {{$t('assigment workspace')}}

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="password"> {{$t('select user')}}</label>
                            <select v-model="formData.user_id_selected"  class="form-select" >
                                <option disabled value=""> {{$t('select')}}</option>
                                <option v-for="user in users" :value="user.id">{{user.full_name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""> {{$t('select workspace')}}</label>
                            <select v-model="formData.workspace_id_selected"  class="form-select" >
                                <option disabled value="">{{$t('select')}}</option>
                                <option v-for="workspace in workspaces" :value="workspace.id">{{workspace.name}}</option>
                            </select>
                        </div>



                        <div class="form-group text-center">
                            <div class="fd-has-float-right">

                                <label for="checkbox">{{$t('owner')}}</label>
                                <input type="checkbox" id="checkbox" v-model="formData.owner" />
                            </div>
                        </div>
                        <div class="text-center mt-2 ">
                            <button
                                class="btn btn-primary text-center"
                                @click.prevent="assign_handler"
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
            users:[],
            workspaces:[],
            formData: {

                user_id_selected:'',
                workspace_id_selected:'',
                owner:false,

                token:'',
            },
        };
    },
    methods: {
        assign_handler() {
            this.formData.token = localStorage.getItem("token");
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .post('/api/workspaces/assignmentUserToWorkspace', this.formData)
                    .then((response) => {
                        console.log(response.data);

                        // this.$router.push('/');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });

        },
    },
    mounted() {
        this.formData.token = localStorage.getItem('token');
        axios.get('/sanctum/csrf-cookie').then((response) => {
            axios
                .post('/api/users',this.formData)
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            axios
                .post('/api/workspaces', this.formData)
                .then((response) => {
                    this.workspaces = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        });
    },
};
</script>
