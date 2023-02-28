<template>
<div style="margin-right: 25%;margin-left:25%;margin-top: 20%;text-align: center">
    <h1 style="font-size:110px">
        404
    </h1>

    <div>
        <h3>{{$t('page not found')}}</h3>
    </div>

        <span style="background-color:black;border-radius: 3px; ">
        <router-link
            class="fd-link fd-margin-top--sm"
            to="/"
            style="font-size: 1em;color: white;"
        >
            {{ $t('home') }}
        </router-link>
            </span>

</div>
</template>
