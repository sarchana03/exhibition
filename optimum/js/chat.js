$('.chat-left-inner > .chatonline').slimScroll({
    height: '100%',
    position: 'right',
    size: "0px",
    color: '#dcdcdc',

});
 $(function(){
            $(window).load(function(){ // On load
                $('.chat-list').css({'height':(($(window).height())-470)+'px'});
            });
            $(window).resize(function(){ // On resize
                $('.chat-list').css({'height':(($(window).height())-470)+'px'});
            });
    });

// this is for the left-aside-fix in content area with scroll

$(function() {
    $(window).load(function() { // On load
        $('.chat-left-inner').css({
            'height': (($(window).height()) - 240) + 'px'
        });
    });
    $(window).resize(function() { // On resize
        $('.chat-left-inner').css({
            'height': (($(window).height()) - 240) + 'px'
        });
    });
});


$(".open-panel").click(function() {
    $(".chat-left-aside").toggleClass("open-pnl");
    $(".open-panel i").toggleClass("ti-angle-left");
});


// const form = document.querySelector(".typing-area"),
// inputField = form.querySelector(".input-field"),
// sendBtn = form.querySelector("button");

// sendBtn.onclick = ()=>{

//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "<?php echo base_url(); ?>chat.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState == XMLHttpRequest.DONE) {
//             if (xhr.status == 200) {
//                 let data = xhr.response;
//                 console.log(data);
//                 if (data == "success") {
//                     location.href = "my_chat.php";
//                 } else {
//                     errorText.style.display = "block";
//                     errorText.textcontent = data;

//                 }
//             }
//         }
//     }
// }

// setInterval()=>{

//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "<?php echo base_url(); ?>chat.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//                 if (data == "success") {
//                     location.href = "my_chat.php";
//                 } 
//             }
//         }
//     }
// }







