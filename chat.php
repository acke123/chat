<!DOCTYPE html>
<html>
<head>
<title>Live Chat - Group chat</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script> 
<link rel="stylesheet">
</head>
<body>

<div data-role="page" style="background:#40E0D0;">
<div data-role="header">
        <p class="text-center">LIVE CHAT</p>
    </div>
    
    <div data-role="content">
        <div class="main-content">
            <p>Your Name: <span id="name" class="nickname"></span></p>
            <div id="chat"></div>
            <br>
            <input type="text" data-clear-btn="true" id="msg">
        </div>
    </div>
</div>
</body>
<script>

$(document).ready(function() { 
    chatname = prompt("Enter your chat name", "Guest:");
    if(chatname == null) { chatname = "Guest"; }
    $("#name").text(chatname);
    poll();
});

$('#msg').on("keyup", function(e) {           
    if (e.keyCode == 13) send();
});

function send() {
    msg = $("#msg").val();
    if(msg.trim() == "") { $("#msg").val(""); return; }
    $.ajax({
        url: "ajax-server.php",
        type: "POST",
        data: { action: "send", name: $("#name").text(), msg: msg },
        success: function(r) {
            $("#chat").html(r).scrollTop($('#chat')[0].scrollHeight);
            $("#msg").val("");
        },
    });
}

function poll() {
    $.ajax({
        url: "ajax-server.php",
        type: "POST",
        data: { action: "poll" },
        success: function(r) {
            $("#chat").html(r);
        },
    });
    setTimeout(poll, 1000);
}
</script>