import axios from "axios";

// api requests are made here
export async function makeNlpRequest(message) {
  let endpoint =
    "https://language.googleapis.com/v1beta2/documents:analyzeSentiment?key=";
  let apiKey = "NLP_API_KEY";
  let resp = "";
  await axios
    .post(endpoint + apiKey, {
      document: {
        content: message,
        type: "PLAIN_TEXT"
      },
      encodingType: "UTF8"
    })
    .then(response => {
      console.log(response.data);
      console.log("NLP request successful.");
      resp = response.data;
    })
    .catch(error => {
      console.log("There was an error:" + error.response);
    });
  return resp;
}

export function getNlpResponseText(nlpResponseObj) {
  return (
    "Score: " +
    nlpResponseObj.documentSentiment.score +
    " Magnitude: " +
    nlpResponseObj.documentSentiment.magnitude
  );
}
