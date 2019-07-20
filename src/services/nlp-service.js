/*
 * 1. make api requests()
 * 2. receive api response()
 */
import axios from "axios";

// api requests are made here
export function makeNlpRequest(message) {
  let endpoint =
    "https://language.googleapis.com/v1beta2/documents:analyzeSentiment?key=";
  let apiKey = "AIzaSyArHVYdDqaLySgyQ6Md0SUiqJ1X54l_Epk";
  let nlpResponse = "";

  axios
    .post(endpoint + apiKey, {
      document: {
        content: message,
        type: "PLAIN_TEXT"
      },
      encodingType: "UTF8"
    })
    .then(response => {
      console.log(response.data);
      console.log("---->>>>NLP Response Success");
    })
    .catch(error => {
      console.log("There was an error:" + error.response);
    });
  // eslint-disable-next-line no-undef,no-unused-vars
  return nlpResponse;
}

export function prettifyNlpResponse(nlpResponseObj) {
  return (
    "Score: " +
    nlpResponseObj.documentSentiment.score +
    " Magnitude: " +
    nlpResponseObj.documentSentiment.magnitude
  );
}
