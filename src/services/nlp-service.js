import axios from "axios";

// api requests are made here
export async function makeNlpRequest(message) {
  const endpoint =
    "https://language.googleapis.com/v1beta2/documents:analyzeSentiment?key=";
  const apiKey = process.env.NLP_API_KEY;
  try {
    const response = await axios.post(`${endpoint}${apiKey}`, {
      document: {
        content: message,
        type: "PLAIN_TEXT"
      },
      encodingType: "UTF8"
    });
    console.log(response.data);
    console.log("NLP request successful.");
    return response.data;
  } catch (error) {
    console.log("There was an error:" + error.response);
  }
}

export function getNlpResponseText(nlpResponseObj) {
  return (
    "Score: " +
    nlpResponseObj.documentSentiment.score +
    " Magnitude: " +
    nlpResponseObj.documentSentiment.magnitude
  );
}
