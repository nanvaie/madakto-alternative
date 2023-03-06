<template>
    <div style="margin-right: 25%;margin-left:25%;margin-top: 5%">
        <form
            class="fd-card sap-overflow-hidden sap-padding"
            @submit.prevent="submit"
        >
            <div class="fd-form-header">
                <span class="fd-form-header__text">{{ $t('edit shift') }}</span>
            </div>

            <div class="fd-margin--lg">
                <div class="fd-form-item">
                    <label class="fd-form-label">{{ $t('title') }}</label>
                    <input
                        v-model="formData.title"
                        class="fd-input"
                        required
                    >
                    <p style="color: red">
                        {{ editShiftErrors?.title }}
                    </p>
                </div>
                <div class="fd-form-item fd-margin-top--sm">
                    <label class="fd-form-label"> {{ $t('select workspace') }}</label>
                    <select
                        v-model="formData.workspace_id_selected"
                        class="fd-input fn-input--select"
                    >
                        <option
                            disabled
                            value=""
                        >
                            {{ $t('select') }}
                        </option>
                        <option
                            v-for="workspace in workspaces"
                            :value="workspace.id"
                        >
                            {{ workspace?.name }}
                        </option>
                    </select>
                </div>

                <div class="fd-form-item fd-margin-top--sm">
                    <label class="fd-form-label">{{ $t('enter time') }}</label>
                    <div class="fd-input-group">
                        <input
                            v-model="formData.enter_time"
                            type="time"
                            class="fd-input fd-input-group__input"
                            required
                        >
                    </div>
                    <p style="color: red">
                        {{ editShiftErrors?.enter_time }}
                    </p>
                </div>
                <div class="fd-form-item fd-margin-top--sm">
                    <label class="fd-form-label">{{ $t('max enter time') }}</label>
                    <div class="fd-input-group">
                        <input
                            v-model="formData.max_enter_time"
                            type="time"
                            class="fd-input fd-input-group__input"
                            required
                        >
                    </div>
                    <p style="color: red">
                        {{ editShiftErrors?.max_enter_time }}
                    </p>
                </div>
                <div class="fd-form-item fd-margin-top--sm">
                    <label class="fd-form-label">{{ $t('exit time') }}</label>
                    <div class="fd-input-group">
                        <input
                            v-model="formData.exit_time"
                            type="time"
                            class="fd-input fd-input-group__input"
                            required
                        >
                    </div>
                    <p style="color: red">
                        {{ editShiftErrors?.exit_time }}
                    </p>
                </div>
                <button
                    type="submit"
                    class="fd-col--12 fd-button fd-button--emphasized fd-margin-top--sm"
                    @click="edit_handler"
                >
                    {{ $t('edit') }}
                </button>
            </div>
        </form>
    </div>

</template>

<script setup>
import axios from 'axios';
import {ref} from 'vue';
import {useRoute, useRouter} from 'vue-router';

const router = useRouter();
const route = useRoute();
const formData = ref({

    title: '',
    enter_time: '',
    max_enter_time: '',
    exit_time: '',
    token: '',
    workspace_id_selected: '',
    id: '',
});


const workspaces = ref([]);
const editShiftErrors = ref();


function edit_handler() {
    formData.value.token = localStorage.getItem("token");
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .put(`/api/v1/shifts/update/${route.params.id}`, formData.value)
            .then((response) => {
                router.push({name: 'shiftList'});
            })
            .catch((errors) => {
                editShiftErrors.value = errors.response.data.errors;

            });
    });
};

readFromDatabase();
async function readFromDatabase() {
    formData.value.token = localStorage.getItem("token");
    await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post(`/api/v1/shifts/edit/${route.params.id}`, formData.value)
            .then((response) => {
                console.log(route.params.id);
                formData.value.title = response.data[0].title;
                formData.value.enter_time = response.data[0].enter_time;
                formData.value.max_enter_time = response.data[0].max_enter_time;
                formData.value.exit_time = response.data[0].exit_time;
                formData.value.id = response.data[0].id;
            })
            .catch((errors) => {
                if (errors.response.status === 404) {
                    router.push({name: 'page404'});
                }
            });
        axios
            .post('/api/v1/workspaces', formData.value)
            .then((response) => {
                workspaces.value = response.data;
            })
            .catch((errors) => {

                console.log(errors);
            });
    });
};

</script>
