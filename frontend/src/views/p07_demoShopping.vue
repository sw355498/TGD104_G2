<template>
    <body class="body_p07_demoShopping">
    <div class="main_p07_demoShopping">
        <!-- demo nav -->
        <p07_demo_nav />
        <!-- 瀏覽器 -->
        <section class="browser_p07_demoShopping">
            <div class="browser_container">
                <div class="toolbar_top_demoShopping">
                    <div class="circles_demoShopping"></div>
                    <div class="tab_demoShopping">
                        <i class="fa-solid fa-globe"></i>
                        <span>詐騙網站</span>
                    </div>
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="toolbar_down_demoShopping">
                    <i class="fa-solid fa-arrow-left"></i>
                    <i class="fa-solid fa-arrow-right"></i>
                    <i class="fa-solid fa-rotate-right"></i>
                    <div class="address_demoShopping">
                        <i class="fa-solid fa-lock"></i>
                        <span>http://shopee.rip/te9</span>
                    </div>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
            </div>
            <!-- 假購物網站 -->
            <article class="scamWeb_p07_demoShopping_container">
                

            </article>
        </section>
    </div>
    </body>
</template>


<script>
import p07_demo_nav from "@/components/p07_demo_nav.vue";
export default {
    components: {
    p07_demo_nav,

    }
}
</script>