import axios from "axios";

// api requests are made here
export async function makeNlpRequest(message) {
  const endpoint =
    "https://language.googleapis.com/v1beta2/documents:analyzeSentiment?key=";
  const apiKey = "AIzaSyArHVYdDqaLySgyQ6Md0SUiqJ1X54l_Epk";
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
    return response.data.documentSentiment;
  } catch (error) {
    console.log("There was an error:" + error.response);
  }
}
