function getTime() {
  let today = new Date();
  return today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
}

export default function buildMessage(usrID, author, message) {
  return {
    id: usrID,
    author: author,
    contents: message,
    date: getTime()
  };
}
