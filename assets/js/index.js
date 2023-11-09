// Loader
$(window).on("ready", function() {
    setInterval(() => {
        $(".page-loader").fadeOut();
    }, 500);
});

// Delete Message Pop Up
let delete_popup = $(".delete-popup");

$(document).on("dblclick", ".chat", function() {
    _this = $(this);
    if(_this.data("type") == "incom") {
        delete_popup.html('<ul><li class="delete-for-me by_receiver">Delete</li><li class="cancel">Cancel</li></ul>');
    } else if(_this.data("status") == "seen") {
        delete_popup.html('<ul><li class="delete-for-me by_sender">Delete</li><li class="cancel">Cancel</li></ul>');
    } else if(_this.data("status") == "received") {
        delete_popup.html('<ul><li class="delete-for-me by_sender">Delete</li><li class="cancel">Cancel</li></ul>');
    } else {
        delete_popup.html('<ul><li class="delete-for-everyone">Delete Everyone</li><li class="delete-for-me by_sender">Delete For Me</li><li class="cancel">Cancel</li></ul>');
    }
    delete_popup.css("display", "grid");
    id = _this.data("msg-id");

    $(document).on("click", ".delete-for-everyone", function(){
        $.ajax({
            url: "php/del-msg-for-everyone.php",
            type: "POST",
            data: {
                msg_id: id
            },
            success: function(data) {
                if(data == 1) {
                    delete_popup.fadeOut("fast");
                }
            }
        });
    });
    // Delete sent message
    $(document).on("click", ".delete-for-me.by_sender", function(){
        $.ajax({
            url: "php/del-msg-for-me.php",
            type: "POST",
            data: {
                msg_id: id
            },
            success: function(data) {
                if(data == 1) {
                    delete_popup.fadeOut("fast");
                } else {
                    alert(data);
                }
            }
        });
    });
    // Delete received message
    $(document).on("click", ".delete-for-me.by_receiver", function(){
        $.ajax({
            url: "php/del-msg-for-me.php",
            type: "POST",
            data: {
                msg_id: id,
                receiver: "yes"
            },
            success: function(data) {
                if(data == 1) {
                    delete_popup.fadeOut("fast");
                } else {
                    alert(data);
                }
            }
        });
    });
    $(document).on("click", ".cancel", function() {
        msg_id = "";
        delete_popup.fadeOut("fast");
        Load_Messages();
    });
});
$(document).on("mouseup", ".chat", function() {
    clearTimeout(delete_popup.data('timer'));
});

// Delete all deleted messages
function Delete_Messages() {
    $.ajax({
        url: "php/del-msg.php",
        type: "POST",
        success: function(data) {
            if(data != 1) {
                console.log(data);
            }
        }
    });
}
setInterval(() => {
    Delete_Messages();
}, 500);


// Profile show animation
let profile_pop = $(".profile-pop");

$(".view-profile").on("click", function() {
    profile_pop.css("display", "grid");
    $(".prof-cancel-btn").on("click", function() {
        profile_pop.fadeOut();
    });
});

// Send IMG show animation
send_img_input = $("#send_img_input");
send_img_input.on("change", function(e) {
    if(e.target.files.length > 0) {
        src = URL.createObjectURL(e.target.files[0]);
        image = $(".send-img-container img");
        image.attr("src", src);
    }
});

let send_img_pop = $(".send-img-pop");

$(".send-btn.img").on("click", function() {
    send_img_pop.css("display", "grid");
    $(".send-img-cancel-btn").on("click", function() {
        send_img_pop.fadeOut();
        image.attr("src", null);
    });
});

// Send Message Button animation
message_input = $(".message-input");
send_btn = $(".send-btn.msg");

message_input.on("keyup", function() {
    if(message_input.val() != "") {
        message = message_input.val();
        send_btn.addClass("active");
    } else {
        send_btn.removeClass("active");
    }
});

$(".send-btn.link").on("click", function() {
    clearTimeout($(".more-actions").data('timer'));
    $(".more-actions").fadeIn();
    $(".more-actions").data('timer', setTimeout(() => {
        $(".more-actions").fadeOut();
    }, 2000));
});


// Users search container
users_cont_searched = $(".users-cont.searched");
search_btn = $(".search-btn");


search_btn.on("click", function() {
    $(".users-cont.friends").css("transform", "scale(0.9)");
    users_cont_searched.addClass("active");
});

right_cont = $(".right-cont");
right_cont.on("click", function() {
    $(".users-cont.friends").css("transform", "scale(1)");
    users_cont_searched.removeClass("active");
});



// MAIN IS HERE

error_text = $(".error-text");

// signup.php code is here
signup_form = $("#signup-form");

signup_form.on("submit", function (e) {
    e.preventDefault();
    let form_data = new FormData(this);
    $.ajax({
        url: "php/signup.php",
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                let url = "http://localhost/ichat/chatarea.php";
                $(location).attr("href", url);
            } else {
                error_text.html(data).show();
            }
        }
    });
});

// Log in code i here
login_form = $("#login-form");

login_form.on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        url: "php/login.php",
        type: "POST",
        data: { email: $("#email").val(), password: $("#password").val() },
        success: function (data) {
            if (data == 1) {
                let url = "http://localhost/ichat/chatarea.php";
                $(location).attr("href", url);
            } else {
                error_text.html(data).fadeIn("fast");
            }
        }
    });
});

// Logout Code is here
log_out_btn = $(".log-out");
log_out_btn.on("click", function() {
    $.ajax({
        url: "php/logout.php",
        type: "POST",
        success: function (data) {
            if(data == 1) {
                let url = "http://localhost/ichat/index.php";
                $(location).attr("href", url);
            } else {
                alert("Cannot Log out!");
            }
        }
    });
});


// Load users in search container
users_list = $(".users-cont.searched .users-list");

function LoadUsers_Search() {
    $.ajax({
        url: "php/load-users.php",
        type: "POST",
        success: function(data) {
            users_list.html(data);
        }
    });
}

search_btn.on("click", function() {
    LoadUsers_Search();
});

setInterval(() => {
    LoadUsers_Search();
}, 60000);

// user click code is here

user_id_holder = $(".user_id_holder");

user = $(".user")
right_cont_user = $(".right-cont-user");

$(document).on("click", ".user", function() {
    user_id = $(this).data("id");
    Set_Seen_Staus(user_id);

    user_id_holder.val(user_id);
    load_user_chatbox(user_id);
    Load_Messages();
});

setTimeout(() => {
    user_id = $(".users-cont .users-list .user:nth-child(1)").data("id");
    Set_Seen_Staus(user_id);

    user_id_holder.val(user_id);

    load_user_chatbox(user_id);
    Load_Messages();
}, 500);

nothing_cont = $(".nothing");
function load_user_chatbox(user_id) {
    user_id = user_id;
    if(user_id == null) {
        nothing_cont.css("display", "grid");
    } else {
        nothing_cont.css("display", "none");
        $.ajax({
            url: "php/load-user-chatbox.php",
            type: "POST",
            data: {user_id: user_id},
            success: function(data) {
                right_cont_user.html(data);
            }
        });
    }
}
function Set_Seen_Staus(id) {
    user_id = id;
    if(user_id != null) {
        $.ajax({
            url: "php/set-seen-status.php",
            type: "POST",
            data: {
                sender: user_id
            },
            success: function(data) {
                if(data == 1) {
                    console.log("You have seen the messages!");
                } else {
                    alert(data);
                }
            }
        });
    }
}



// Sending message
function MessageSend() {
    clearTimeout($(".type").data('timer'));
    $.ajax({
        url: "php/send-message.php",
        type: "POST",
        data: {
            receiver: user_id_holder.val(),
            message: message
        },
        success: function(data) {
            if(data == 1) {
                message_input.val("");
                message_input.focus();
            } else {
                $(".type").html(data).fadeIn();
                $(".type").data('timer', setInterval(() => {
                    $(".type").fadeOut();
                }, 1000));
            }
        }
    });
}
send_btn.on("click", function() {
    MessageSend();
    Load_Messages();
});

$(".search-user").on("keyup", function() {
    search_term = $(this).val();
    $.ajax({
        url: "php/search-users.php",
        type: "POST",
        data: {
            search_term: search_term
        },
        success: function(data) {
            users_list.html(data);
        }
    });
});

function Load_Friends() {
    $.ajax({
        url: "php/load-friends.php",
        type: "POST",
        success: function(data) {
            $(".users-cont.friends .users-list").html(data);
        }
    });
}
Load_Friends();

setInterval(() => {
    Load_Friends();
}, 1000);


// Function to update that all messages to me are received
function set_msg_received_status() {
    $.ajax({
        url: "php/set-msg-received-status.php",
        type: "POST",
        success: function(data) {
            if(data == 1) {
                console.log("All resources loaded");
            }
        }
    });
}
setInterval(() => {
    set_msg_received_status();
}, 500);

// Message load function is here
messages = $(".messages");

function Load_Messages() {
    $.ajax({
        url: "php/load-messages.php",
        type: "POST",
        data: {
            receiver: user_id_holder.val()
        },
        success: function(data) {
            if(data != 0) {
                messages.html(data);
            }
        }
    });
}
// setInterval(() => {
//     Load_Messages();
//     const msg_cont = document.querySelector(".messages");
//     msg_cont.scrollBy(0, msg_cont.scrollHeight);
// }, 500);

$(document).on("mousedown", ".outgoing-chat", function() {
    $(this).data('timer', setTimeout(() => {
        $(this).css("backgournd", "#000");
    }, 1000));
});

// settings.php

// load settings data
function Load_Settings_Data() {
    i = 0;
    $.ajax({
        url: "php/load-settings-data.php",
        type: "POST",
        success: function(data) {
            a = data.split(",");
            if(a[0] == 1) {
                $("#cur_img").val(a[4]);
                $("#name").val(a[1]);
                $("#email").val(a[2]);
                $("#changed_pass").val(a[3]);
                src = "uploaded-images/"+a[4];
                $(".img-cont img").attr("src", src);
            }
        }
    });
}
Load_Settings_Data();

$(".change-btn").on("click", function() {
    $(".change-password").addClass("shown");
    $(".back-btn").on("click", function() {
        $(".change-password").removeClass("shown");
    });
});

// Checking password correctness
function CheckPassword() {
    $.ajax({
        url: "php/check-password.php",
        type: "POST",
        data: {
            new_pass: $("#new_pass").val(),
            cur_pass: $("#cur_pass").val()
        },
        success: function(data) {
            data = data.split(",");
            if(data[0] == 1) {
                $(".change-password").removeClass("shown");
                $("#changed_pass").val(data[1]);
                $("#new_pass").val("");
                $("#cur_pass").val("");
            } 
            else {
                error_text = $(".pass-cont .error-text");
                error_text.html(data).animate({
                    opacity: "1"
                }, 500);
                error_text.data('timer', setTimeout(() => {
                    error_text.html(data).animate({
                        opacity: "0"
                    }, 500);
                }, 3000));
            }
        }
    });
}
$(".pass-change-btn").on("click", function() {
    clearTimeout(error_text.data('timer'));
    CheckPassword();
});

update_form = $("#update_form");

update_form.on("submit", function(e) {
    clearTimeout(error_text.data('timer'));
    error_text = $(".password ~ .error-text");
    e.preventDefault();
    let  user_updated_data = new FormData(this);
    $.ajax({
        url: "php/update-user.php",
        type: "POST",
        data: user_updated_data,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                Load_Settings_Data();
                console.log("Changes saved");
                error_text.html("Changes Saved").fadeIn().css("color","#333");
                error_text.data('timer', setTimeout(() => {
                    error_text.fadeOut();
                }, 2000));
            } else {
                error_text.html(data).fadeIn();
                error_text.data('timer', setTimeout(() => {
                    error_text.fadeOut();
                }, 2000));
            }
        }
    });
});


// send img code is here
send_img_form = $("#send_img");

send_img_form.on("submit", function (e) {
    error_text = $(".send-img-pop .error-text");
    clearInterval(error_text.data('timer'));
    e.preventDefault();
    let form_data = new FormData(this);
    $.ajax({
        url: "php/send-img.php",
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        success: function (data) {
            if(data == 1) {
                send_img_pop.fadeOut();
                image.attr("src", null);
            } else {
                error_text.html(data).fadeIn("fast");
                error_text.data('timer', setTimeout(() => {
                    error_text.fadeOut();
                }, 2000));
            }
        }
    });
});