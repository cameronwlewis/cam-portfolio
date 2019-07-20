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
import { makeNlpRequest, getNlpResponseText } from "@/services/nlp-service";
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
      let nlpResponseObj = await makeNlpRequest(message);
      let nlpResponseText = getNlpResponseText(nlpResponseObj);
      this.response = buildMessage(1, "GoogleNLP", nlpResponseText);
    }
  }
};
</script>
