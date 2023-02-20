<template>
    <div>
        <div class="row justify-content-center w-50 m-auto mt-5">
            <div class="col-ml-4">
                <div class="card">
                    <div class="card-header text-center">
                        Create Shift
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"> TITLE</label>
                            <input
                                v-model="formData.title"
                                type="text"
                                class="form-control"
                                name="title"
                            >

                        </div>
                        <div class="form-group">
                            <label for="">Select Workspace</label>
                            <select v-model="formData.workspace_id_selected" class="form-select">
                                <option disabled value="">Please Select</option>
                                <option v-for="workspace in workspaces" :value="workspace.id">{{ workspace.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="enter_time"> Enter Time</label>
                            <input
                                v-model="formData.enter_time"
                                type="time"
                                class="form-control"
                                name="enter_time"
                            >

                        </div>
                        <div class="form-group">
                            <label for="max_enter_time">Max Enter Time</label>
                            <input
                                v-model="formData.max_enter_time"
                                type="time"
                                class="form-control"
                                name="max_enter_time"
                            >

                        </div>
                        <div class="form-group">
                            <label for="exit_time"> Exit Time</label>
                            <input
                                v-model="formData.exit_time"
                                type="time"
                                class="form-control"
                                name="exit_time"
                            >

                        </div>


                        <div class="form-group ">
                            <router-link
                                class="float-right"
                                to="/workspaces"
                            >
                                Workspaces list
                            </router-link>
                        </div>

                        <div class="form-group text-center">
                            <button
                                class="btn btn-primary text-center"
                                @click.prevent="edit_handler"
                            >
                                Edit
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
                id: '',
            },


            workspaces: [],
        };
    },
    methods: {
        edit_handler() {
            this.formData.token = localStorage.getItem("token");
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .put(`/api/Shifts/update/${this.formData.id}`, this.formData)
                    .then((response) => {


                        console.log(this.formData);
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
        this.formData.token = localStorage.getItem("token");
        axios.get('/sanctum/csrf-cookie').then((response) => {
            axios

                .put(`/api/Shifts/edit/${this.$route.params.id}`, this.formData)
                .then((response) => {

                    // this.shift = response.data[0];
                    this.formData.title=response.data[0].title;
                    this.formData.enter_time=response.data[0].enter_time;
                    this.formData.max_enter_time=response.data[0].max_enter_time;
                    this.formData.exit_time=response.data[0].exit_time;
                    this.formData.id=response.data[0].id;
                    console.log(this.formData);
                })
                .catch((errors) => {


                    console.log(errors);
                });
            axios
                .post('/api/workspaces', this.formData)
                .then((response) => {
                    this.workspaces = response.data;
                })
                .catch((errors) => {

                    console.log(errors);
                });
        });
    },
};
</script>
