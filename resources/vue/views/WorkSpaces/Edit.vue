<template>
    <div>
        <div class="row justify-content-center w-50 m-auto mt-5">
            <div class="col-ml-4">
                <div class="card">
                    <div class="card-header text-center">
                        {{$t('edit workspace')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"> {{$t('workspace name')}}</label>
                            <input
                                v-model="formData.name"
                                type="text"
                                class="form-control"
                                name="name"
                            >
                        </div>


                        <div class="form-group text-center">
                            <button
                                class="btn btn-primary text-center"
                                @click.prevent="edit_handler"
                            >
                                {{$t('edit')}}
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
                id: '',
                token: '',

            },
        };
    },
    methods: {
        edit_handler() {
            this.formData.token = localStorage.getItem("token");
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .put(`/api/workspaces/update/${this.formData.id}`, this.formData)
                    .then((response) => {

                        this.$router.push({name:'workspaceList'});
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });
        },
    },
    mounted() {
        this.formData.token = localStorage.getItem("token");
        axios.get('/sanctum/csrf-cookie').then((response) => {
            axios

                .put(`/api/workspaces/edit/${this.$route.params.id}`,this.formData)
                .then((response) => {
                    this.formData.name = response.data.name;
                    this.formData.id = response.data.id;


                })
                .catch((error) => {
                    console.log(error);
                });
        });
    },
};
</script>
