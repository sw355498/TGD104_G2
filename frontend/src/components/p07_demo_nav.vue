<template>
    <div class="demo">
        <h1>DEMO 體驗</h1>
        <br>
        <div class="demoBtn p07_demoNav">
            <router-link to="/p07demoShopping"><button class="big_button">詐騙網站</button></router-link>
            <router-link to="/p07demoGame"><button class="big_button">詐騙知識測驗</button></router-link>
            <router-link to="/p07demoPhone"><button class="big_button">電話詐騙</button></router-link>
            <router-link to="/p07demoLine"><button class="big_button">愛情交友詐騙</button></router-link>            
        </div>
    </div>
    <router-view></router-view>
</template>

<script setup>
    // import p07_demoShopping from '@/views'

</script>