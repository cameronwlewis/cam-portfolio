<template>
  <div class="home">
    <b-container>
      <basic-vue-chat
        :title="'Text Sentiment'"
        v-bind:new-message="response"
        @newOwnMessage="onNewUserMessage"
      />
    </b-container>
  </div>
</template>

<script>
import BasicVueChat from "basic-vue-chat";
import { makeNlpRequest } from "@/services/nlp-service";
import buildMessage from "@/services/chat-service";

export default {
  el: "#home",
  name: "home",
  components: {
    BasicVueChat
  },
  data: function() {
    return {
      response: {}
    };
  },
  methods: {
    async onNewUserMessage(message) {
      const { score, magnitude } = await makeNlpRequest(message);
      this.response = buildMessage(
        1,
        "GoogleNLP",
        `The score was ${score} and magnitude was ${magnitude}`
      );
    }
  }
};
</script>
