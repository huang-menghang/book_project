var user_edit_ops = {
    init:function () {
        this.eventBind();
    },
    eventBind:function () {
         $("#save").click(function () {
              var btn_target = $(this);
              if(btn_target.hasClass("disabled")){
                  alert("正在处理,不要重复点击");
                  return false;
              }
              var old_password = $("#old_password").val();
              var new_password = $("#new_password").val();
             if (old_password.length < 1){
                 alert("请输入原密码--");
                 return false;
             }
             if(new_password.length < 6){
                 alert("请输入不少于6位字符的新密码--");
                 return false;
             }
             btn_target.addClass("disabled");
             var data = {
                 old_password:old_password,
                 new_password:new_password
             };
             $.ajax({
                     url:'/web/user/reset-pwd',
                     type:'POST',
                     data:data,
                     dataType:'json',
                     success:function(res){
                         btn_target.removeClass("disabled");
                         if(res.code == 200){
                             window.location.href = window.location.href;
                         }else{
                             alert(res.msg);
                         }
                     }




             }
             );




         });





    }
};
$(document).ready(
    function () {
        user_edit_ops.init();
    }
);