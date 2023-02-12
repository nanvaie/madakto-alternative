<template>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <H4 class="navbar-brand" href="#">{{ $t('well come') }} {{name}}</H4>


            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $t('log out') }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #e3f2fd;">
                    <router-link

                        class="dropdown-item"
                        to="/logout"
                        @click="logout_handler"
                    >
                        {{ $t('log out') }}

                    </router-link>

                </ul>
            </div>

        </div>

    </nav>
    <Dashboard/>
</template>
<script>
import Dashboard from './DashBoard.vue';

export default {
    data() {
        return {

            name: '',

        };
    },
    components: {
        Dashboard
    },
    methods:{
        logout_handler(){
            localStorage.setItem('token', null);
            localStorage.setItem('name', null);
            localStorage.setItem('user_id', null);
            this.$router.push({ name: 'login' });
        },
    },
    mounted() {
        this.name =localStorage.getItem('name');

    }
};
</script>
