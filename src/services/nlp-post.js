function retrieveSentiment(line) {
  const express = require("express");
  const app = express();

  const apiKey = "GOOGLE_APPLICATION_CREDENTIALS";
  const apiEndpoint =
    "https://language.googleapis.com/v1/documents:analyzeSentiment?key=" +
    apiKey;

  const reviewData = {
    language: "en-us",
    type: "PLAIN_TEXT",
    content: line
  };

  let nlAPIData = {
    document: reviewData,
    encodingType: "UTF8"
  };

  const nlCallOptions = {
    method: "post",
    contentType: "application/json",
    payload: JSON.stringify(nlAPIData)
  };

  //const response = UrlFetchApp.fetch(apiEndpoint, nlCallOptions);
  let response = app.post(apiEndpoint, function(req, res) {
    res.send("Hello World");
  });

  const data = JSON.parse(response);

  let sentiment = 0.0;
  if (data && data.documentSentiment && data.documentSentiment.score) {
    sentiment = data.documentSentiment.score;
  }

  return sentiment;
}
