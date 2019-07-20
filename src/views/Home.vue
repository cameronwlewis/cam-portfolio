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
import { makeNlpRequest, prettifyNlpResponse } from "@/services/nlp-service";
import buildMessage from "@/services/chat-service";

export default {
  el: "#home",
  name: "home",
  components: {
    BasicVueChat
  },
  data: function() {
    return {
      response: ""
    };
  },
  methods: {
    updateFeed(newFeed) {
      return newFeed;
    },
    onNewUserMessage(message) {
      let nlpResponseObj = makeNlpRequest(message);
      let prettyNlpResponse = prettifyNlpResponse(nlpResponseObj);
      this.response = buildMessage(1, "GoogleNLP", prettyNlpResponse);
    }
  }
};
</script>
