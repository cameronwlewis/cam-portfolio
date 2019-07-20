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
import axios from "axios";

export default {
  el: "#home",
  name: "home",
  components: {
    BasicVueChat
  },
  created() {
    let text =
      "I hate people! Everybody is rotten to me and I don't have any friends. Even skunks avoid me.";
    axios
      .post(
        "https://language.googleapis.com/v1beta2/documents:analyzeSentiment?key=AIzaSyArHVYdDqaLySgyQ6Md0SUiqJ1X54l_Epk",
        {
          document: {
            content: text,
            type: "PLAIN_TEXT"
          },
          encodingType: "UTF8"
        }
      )
      .then(response => {
        console.log(response.data);
      })
      .catch(error => {
        console.log("There was an error:" + error.response);
      });
  }
};
</script>
