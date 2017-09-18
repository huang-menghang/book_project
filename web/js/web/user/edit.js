;
var user_edit_ops = {
    init:function () {
        this.eventBind();
    },
    eventBind:function () {
        $(".save").click( function() {
            var btn_target = $(this);
            if(btn_target.hasClass("disabled")){
                common_ops.alert("正在处理,请不要重复点击--");
                 return false;
            }
            var nickname = $(".user_edit_wrap input[name='nickname']").val();
            var email = $(".user_edit_wrap input[name='email']").val();
            if( nickname.length < 1){
                common_ops.tip("请输入合法的姓名--",$(".user_edit_wrap input[name='nickname']"));
                return false;
            }
            if(email.length < 1){
                common_ops.tip("请输入合法的邮箱地址--",$(".user_edit_wrap input[name='email']"));
                return false;
            }
            var data = {
                nickname:nickname,
                email:email
            };
            btn_target.addClass("disabled");
            $.ajax({
                url:common_ops.buildWebUrl('/user/edit'),
                type:'POST',
                data:data,
                dataType:'json',
                success:function(res){
                    callback = null;
                    btn_target.removeClass("disabled");
                    if(res.code == 200) {
                        callback = function () {
                            window.location.href = window.location.href;
                        };
                    }
                    common_ops.alert(res.msg,callback);

                }
            });

        });


    }
};
$(document).ready(
    function () {
        user_edit_ops.init();
    }
);