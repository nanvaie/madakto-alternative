<template>
    <div class="fd-margin-begin-end--lg">
    <div class="fd-toolbar fd-toolbar--solid fd-toolbar--title fd-toolbar-active">
        <h4 style="margin: 0;">{{ $t('workspace list') }}</h4>
        <span class="fd-toolbar__spacer fd-toolbar__spacer--auto"></span>
    </div>
    <table class="fd-table fd-table--no-horizontal-borders fd-table--no-vertical-borders">
        <thead class="fd-table__header">
        <tr class="fd-table__row">
            <th class="fd-table__cell" scope="col">{{ $t('id') }}</th>
            <th class="fd-table__cell" scope="col">{{ $t('create by') }}</th>
            <th class="fd-table__cell" scope="col">{{ $t('workspace name') }}</th>
            <th class="fd-table__cell" scope="col">{{ $t('action') }}</th>
        </tr>
        </thead>
        <tbody class="fd-table__body">
        <tr class="fd-table__row" v-for="list in lists" :key="list.id">
            <td class="fd-table__cell">{{ list.id }}</td>
            <td class="fd-table__cell">{{ list.user.full_name }}</td>
            <td class="fd-table__cell">{{ list.name }}</td>
            <td class="fd-table__cell">
                <button class="fd-button fd-button--negative" @click="edit_handler(list.id)">{{ $t('edit') }}</button>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script setup>

import axios from 'axios';
import {ref} from 'vue';
import {useRouter} from "vue-router";

const router = useRouter();

const lists = ref([]);
const formData = ref({

    token: '',

})
show_list();
async function show_list() {
    formData.value.token = localStorage.getItem("token");
   await axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/v1/workspaces', formData.value)
            .then((response) => {
                lists.value = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    });
};

function edit_handler($id) {
    router.push({name: 'editWorkspace', params: {id: $id}});
};

</script>
