<template>

    <div style="margin-right: 25%;margin-left:25%;margin-top: 5%">
        <form
            class="fd-card sap-overflow-hidden sap-padding"
            @submit.prevent="submit"
        >
            <div class="fd-form-header">
                <span class="fd-form-header__text"> {{ $t('edit workspace') }}</span>
            </div>

            <div class="fd-margin--lg">
                <div class="fd-form-item">
                    <label class="fd-form-label">{{ $t('workspace name') }}</label>
                    <input
                        v-model="formData.name"
                        class="fd-input"
                        required
                    >
                    <p style="color: red">
                        {{ createShiftErrors?.name }}
                    </p>
                </div>
                <button
                    type="submit"
                    class="fd-col--12 fd-button fd-button--emphasized fd-margin-top--sm"
                    @click="edit_handler"
                >
                    {{ $t('edit') }}
                </button>

                <router-link
                    class="fd-link fd-margin-top--sm"
                    to="/workspaces"
                    style="font-size: 1em"
                >
                    {{ $t('workspace list') }}
                </router-link>
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
const createShiftErrors = ref();

const formData = ref({
    name: '',
    id: '',
    token: '',

});

function edit_handler() {
    formData.value.token = localStorage.getItem("token");
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .put(`/api/v1/workspaces/update/${route.params.id}`, formData.value)
            .then((response) => {
                router.push({name: 'workspaceList'});
            })
            .catch((errors) => {
                createShiftErrors.value = errors.response.data.errors;
            });
    });
};

readFromDatabase();

async function readFromDatabase() {
    formData.value.token = localStorage.getItem("token");
    await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .put(`/api/v1/workspaces/edit/${route.params.id}`, formData.value)
            .then((response) => {
                formData.value.name = response.data.data.name;
                formData.value.id = response.data.data.id;
            })
            .catch((errors) => {
                if (errors.response.status === 404) {
                    router.push({name: 'page404'});
                }
            });
    });
};

</script>
