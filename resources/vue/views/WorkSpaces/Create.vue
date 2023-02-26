<template>
    <!--    <div>-->
    <!--        <div class="row justify-content-center w-50 m-auto mt-5">-->
    <!--            <div class="col-ml-4">-->
    <!--                <div class="card">-->
    <!--                    <div class="card-header text-center">-->
    <!--                        {{$t('create workspace')}}-->

    <!--                    </div>-->
    <!--                    <div class="card-body">-->
    <!--                        <div class="form-group">-->
    <!--                            <label for="name">  {{$t('workspace name')}}</label>-->
    <!--                            <input-->
    <!--                                v-model="formData.name"-->
    <!--                                type="text"-->
    <!--                                class="form-control"-->
    <!--                                name="name"-->
    <!--                            >-->
    <!--                            <p class="text-danger mt-1" v-text="errors.name"></p>-->
    <!--                        </div>-->


    <!--                        <div class="form-group ">-->
    <!--                            <router-link-->
    <!--                                class="float-right"-->
    <!--                                to="/workspaces"-->
    <!--                            >-->
    <!--                                {{$t('workspace list')}}-->
    <!--                            </router-link>-->
    <!--                        </div>-->

    <!--                        <div class="form-group text-center">-->
    <!--                            <button-->
    <!--                                class="btn btn-primary text-center"-->
    <!--                                @click.prevent="create_handler"-->
    <!--                            >-->
    <!--                                {{$t('create')}}-->
    <!--                            </button>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <div style="margin-right: 25%;margin-left:25%;margin-top: 5%">
        <form
            class="fd-card sap-overflow-hidden sap-padding"
            @submit.prevent="submit"
        >
            <div class="fd-form-header">
                <span class="fd-form-header__text"> {{ $t('create workspace') }}</span>
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
                    @click="create_handler"
                >
                    {{ $t('create') }}
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
import {useRouter} from 'vue-router';

const router = useRouter();
const createWorkspaceErrors = ref();


const formData = ref({
    name: '',
    token: '',
});


function create_handler() {
    formData.value.token = localStorage.getItem("token");
    axios.get('/sanctum/csrf-cookie').then((response) => {
        axios
            .post('/api/workspaces/create', formData.value)
            .then((response) => {
                console.log('you make work space  successfully');
                router.push({name: 'workspaceList'});
            })
            .catch((errors) => {
                createWorkspaceErrors.value = errors.response.data.errors;
                console.log(errors);
            });
    });
};

</script>
