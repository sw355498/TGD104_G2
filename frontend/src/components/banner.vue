<template>
  <!-- Banner -->
  <h2>prevent</h2>
  <div id="banner_index_dynamicText">
    <div class="text-animation">不</div>
    <div class="text-animation">明</div>
    <div class="text-animation">網</div>
    <div class="text-animation">站</div>
    <br />
    <div class="text-animation">購</div>
    <div class="text-animation">物</div>
    <div class="text-animation">要</div>
    <div class="text-animation">當</div>
    <div class="text-animation">心</div>
  </div>
  <router-link to="/demoShopping" class="demolink_index_btn">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    DEMO體驗
  </router-link>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
let timer = ref("");
onMounted(() => {
  const decodeText = () => {
    let text = document.getElementById("banner_index_dynamicText");
    let state = [];
    for (let i = 0, j = text.children.length; i < j; i++) {
      text.children[i].classList.remove("state-1", "state-2", "state-3");
      state[i] = i;
    }
    // shuffle the array to get new sequences each time
    let shuffled = shuffle(state);

    for (let i = 0, j = shuffled.length; i < j; i++) {
      let child = text.children[shuffled[i]];
      let classes = child.classList;

      // fire the first one at random times
      let state1Time = Math.round(Math.random() * (2000 - 300)) + 50;
      if (classes.contains("text-animation")) {
        setTimeout(firstStages.bind(null, child), state1Time);
      }
    }
  };

  // send the node for later .state changes
  const firstStages = (child) => {
    if (child.classList.contains("state-2")) {
      child.classList.add("state-3");
    } else if (child.classList.contains("state-1")) {
      child.classList.add("state-2");
    } else if (!child.classList.contains("state-1")) {
      child.classList.add("state-1");
      setTimeout(secondStages.bind(null, child), 100);
    }
  };
  const secondStages = (child) => {
    if (child.classList.contains("state-1")) {
      child.classList.add("state-2");
      setTimeout(thirdStages.bind(null, child), 100);
    } else if (!child.classList.contains("state-1")) {
      child.classList.add("state-1");
    }
  };
  const thirdStages = (child) => {
    if (child.classList.contains("state-2")) {
      child.classList.add("state-3");
    }
  };

  const shuffle = (array) => {
    let currentIndex = array.length,
      temporaryValue,
      randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }
    return array;
  };
  // Demo only stuff
  decodeText();

  // beware: refresh button can overlap this timer and cause state mixups
  timer = setInterval(() => {
    decodeText();
  }, 5000);
});

onUnmounted(() => {
  if (timer) clearInterval(timer);
});
</script>
