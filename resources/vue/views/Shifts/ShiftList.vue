<template>



    <div class="container mt-5">

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>workspace</th>
                <th>Entery Time</th>
                <th>MAX Entery Time</th>
                <th>Exit Time</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="list in lists" :key="list.id">
                <td>{{ list.id }}</td>
                <td>{{ list.title }}</td>
                <td>{{ list.workspace.name}}</td>
                <td>{{ list.enter_time }}</td>
                <td>{{ list.max_enter_time }}</td>
                <td>{{ list.exit_time }}</td>
                <td class="form-group text-center">
                    <button
                        class="btn btn-danger text-center"
                        @click.prevent="edit_handler(list.id)"
                    >
                        edit
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";


export default {


    data() {
        return {

            lists: [],
            formData: {

                token: '',

            },
        };
    },
    created() {
        this.show_list();
    },
    methods: {
        show_list() {
            this.formData.token = localStorage.getItem("token");
            axios.get('/sanctum/csrf-cookie').then((response) => {
                axios
                    .post('/api/shifts', this.formData)
                    .then((response) => {


                        this.lists = response.data;

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            });
        },
        edit_handler($id) {
            this.$router.push({ name: 'editShift' , params: { id: $id } });
        }
    },

}

</script>

<style scoped>

</style>
