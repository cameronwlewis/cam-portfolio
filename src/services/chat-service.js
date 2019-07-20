// obtain input from user --> maybe i need an event listener of some kind?

// send input from user to window --> not sure I need to worry about
// this; its already happening

// send text to chat, either user 1 or user 2
function getTime() {
  let today = new Date();
  return today.getHours() + ":" + today.getMinutes();
}

export default function buildMessage(usrID, author, message) {
  const newMessage = [
    {
      id: usrID,
      author: author,
      contents: message,
      date: getTime()
    }
  ];
  return { newMessage };
}
