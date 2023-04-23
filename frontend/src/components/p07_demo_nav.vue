<template>
    <div class="demo">
        <h3>DEMO體驗</h3>
        <br>
        <div class="demoBtn p07_demoNav">
            <router-link to="/demoShopping"><button class="medium_button">詐騙網站</button></router-link>
            <router-link to="/demoGame"><button class="medium_button">詐騙知識測驗</button></router-link>
            <router-link to="/demoPhone"><button class="medium_button">電話詐騙</button></router-link>
            <router-link to="/demoLine"><button class="medium_button">愛情交友詐騙</button></router-link>            
        </div>
    </div>
    <router-view></router-view>
</template>

<script setup>
    // import p07_demoShopping from '@/views'

</script>