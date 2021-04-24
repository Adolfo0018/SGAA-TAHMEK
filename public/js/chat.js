const PERSON_IMG = "https://image.flaticon.com/icons/svg/145/145867.svg";
const chatId = window.location.pathname.substring(6);
var authUser;
var typingTimer = false;

window.onload = function (){
  
  $.get( "../auth/user", function( data ) {
    authUser = data.authUser;
  });

  $.get( `../chat/${chatId}/get_users`, function( data ) {
    let results = data.users.filter( user => user.id != authUser.id);

    if(results.length > 0){
      $(".chatWith").append(results[0].name);
    }
  });

  $.get( `../chat/${chatId}/get_messages`, function( data ) {
    appendMessages(data.messages);
  });
}

function enviarMensaje (){
  
    var mensaje = $("#mensaje").val();
    if (!mensaje) return;
    $.ajax({
      url: "../message/sent",
      data: {
          "_token" : $("meta[name='csrf-token']").attr("content"),
          'message' : mensaje,
          'chat_id' : chatId
      },
      method: "POST",
      success: function(response) {
        var data = response;
        appendMessage(
          data.user.name,
          PERSON_IMG,
          'right',
          data.content,
          formatDate(new Date(data.created_at))
        );
        $("#mensaje").val("");
      },
      error: function (error) {
          console.log(error);
      }
  });

}

function appendMessages(messages){
  var side = 'left';

  messages.forEach(message => {
    side = (message.user_id == authUser.id) ? 'right' : 'left';

    appendMessage(
      message.user.name,
      PERSON_IMG,
      side,
      message.content,
      formatDate(new Date(message.created_at))
    );
  })
}
 
function appendMessage(name, img, side, text, date) {
  const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-img" style="background-image: url(${img})"></div>
 
      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">${name}</div>
          <div class="msg-info-time">${date}</div>
        </div>
 
        <div class="msg-text">${text}</div>
      </div>
    </div>
  `;
 
  $(".msger-chat").append(msgHTML);
  scrollToBottom();
}
 
function sendTypingEvent (){
  typingTimer = true;
  Echo.join(`chat.${chatId}`)
  .whisper('typing', $(".msger-input").length);
}


//Echo
Echo.join(`chat.${chatId}`).listen('MessageSent', (e) => {
  appendMessage(
    e.message.user.name,
    PERSON_IMG,
    'left',
    e.message.content,
    formatDate(new Date(e.message.created_at))
  );
}).here(users => {
  let result = users.filter(user => user.id != authUser.id);
  if(result.length > 0){
    $(".chatStatus").addClass('chatStatus online');
  }
}).joining(user => {
  if(user.id != authUser.id){
    $(".chatStatus").addClass('chatStatus online');
  }
}).leaving(user => {
  if(user.id != authUser.id){
    $(".chatStatus").addClass('chatStatus offline');
  }
}).listenForWhisper('typing', e => {
  if(e > 0){
    $(".typing").attr("style", "display");

    if(typingTimer){
      clearTimeout(typingTimer);
    }

    typingTimer = setTimeout( () => {
      $(".typing").attr("style", "display:none");
      typingTimer = false;
    }, 3000);
  }
});

// Utils
function get(selector, root = document) {
  return root.querySelector(selector);
}
 
function formatDate(date) {
    const d = date.getDate();
    const mo = date.getMonth() + 1;
    const y = date.getFullYear();
    const h = "0" + date.getHours();
    const m = "0" + date.getMinutes();
    return `${d}/${mo}/${y} ${h.slice(-2)}:${m.slice(-2)}`;
}

function scrollToBottom(){

  $(".msger-chat").animate({ scrollTop: $('.msger-chat')[0].scrollHeight}, 1000);

  //$(".msger-chat").scrollTop = $(".msger-chat").innerHeight;
}