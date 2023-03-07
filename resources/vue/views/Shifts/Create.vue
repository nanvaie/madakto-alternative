<template>
    <div style="margin-right: 25%;margin-left:25%;margin-top: 5%">
        <form
            class="fd-card sap-overflow-hidden sap-padding"
            @submit.prevent="submit"
        >
            <div class="fd-form-header">
                <span class="fd-form-header__text">{{ $t('create shift') }}</span>
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
                        {{ createShiftErrors?.title }}
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
                            {{ workspace.name }}
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
                        {{ createShiftErrors?.enter_time }}
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
                        {{ createShiftErrors?.max_enter_time }}
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
                        {{ createShiftErrors?.exit_time }}
                    </p>
                </div>
                <button
                    type="submit"
                    class="fd-col--12 fd-button fd-button--emphasized fd-margin-top--sm"
                    @click="create_handler"
                >
                    {{ $t('create') }}
                </button>

                <router-link
                    class="fd-link fd-margin-top--sm"
                    to="/shiftList"
                    style="font-size: 1em"
                >
                    {{ $t('shift list') }}
                </router-link>
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const formData = ref({
    title: '',
    enter_time: '',
    max_enter_time: '',
    exit_time: '',
    token: '',
    workspace_id_selected: '',

});
const workspaces = ref([]);
const createShiftErrors = ref();
const readDatabaseErrors = ref();

function create_handler() {
    const token = localStorage.getItem('bearerToken');
    const headers = { Authorization: `Bearer ${token}` };
    formData.value.token = localStorage.getItem('token');
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/v1/shifts/create', formData.value,{ headers })
            .then((response) => {
                router.push({ name: 'shiftList' });
            })
            .catch((errors) => {
                createShiftErrors.value = errors.response.data.errors;
                console.log(createShiftErrors.value);
            });
    });
}

async function readFromDatabase() {
    const token = localStorage.getItem('bearerToken');
    const headers = { Authorization: `Bearer ${token}` };
    formData.value.token = localStorage.getItem('token');
    await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/v1/workspaces', formData.value, { headers })
            .then((response) => {
                workspaces.value = response.data.data;
            })
            .catch((errors) => {
                readDatabaseErrors.value = errors.response.data.errors;
                console.log(readDatabaseErrors.value);
            });
    });
}
readFromDatabase();
</script>
