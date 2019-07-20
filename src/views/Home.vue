<template>
  <div class="home">
    <b-container>
      <basic-vue-chat
        :title="'Text Sentiment'"
        v-bind:initial-feed="this.initialFeed"
        v-bind:new-message="message"
      />
    </b-container>
  </div>
</template>

<script>
import BasicVueChat from "basic-vue-chat";

export default {
  el: "#home",
  name: "home",
  components: {
    BasicVueChat
  }
};
</script>
