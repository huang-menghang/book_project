;
var user_bind_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        var that = this;
        // 点击登录
        $(".login_form_wrap .dologin").click(function () {
            var btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                alert("请不要重复提交");
                return false;
            }

            // 获取前段信息
            var mobile = $(".login_form_wrap input[name=mobile]").val();
            var img_captcha = $(".login_form_wrap input[name=img_captcha]").val();
            var captcha_code = $(".login_form_wrap input[name=captcha_code]").val();

            if (mobile.length < 1 || !/^[1-9]\d{10}$/.test(mobile)) {
                alert("请输入符合要求的手机号码");
                return false;
            }

            if (img_captcha.length < 1) {
                alert("请输入正确的图形验证码");
                return false;
            }

            if (captcha_code.length < 1) {
                alert("请输入正确的手机验证码");
                return false;
            }

            btn_target.addClass("disabled");

            var data = {
                mobile: mobile,
                img_captcha: img_captcha,
                captcha_code: captcha_code,
                referer: $(".hide_wrap input[name=referer]").val()
            };
            $.ajax({
                url: common_ops.buildMUrl("/user/bind"),
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (res) {
                    btn_target.removeClass("disabled");
                    alert(res.msg);
                    if (res.code != 200) {
                        $("#img_captcha").click();
                        return;
                    }
                   // window.location.href = res.data.url;

                }
            });
        })
       $(".login_form_wrap .get_captcha").click(function () {
         var btn_target = $(this);
         if(btn_target.hasClass("disabled")){
             alert("正在提交不要重复提交");
             return false;
         }

           var mobile = $(".login_form_wrap input[name=mobile]").val();
           var img_captcha = $(".login_form_wrap input[name=img_captcha]").val();

           if (mobile.length < 1 || !/^[1-9]\d{10}$/.test(mobile)) {
               alert("请输入符合要求的手机号码");
               return false;
           }

           if (img_captcha.length < 1) {
               alert("请输入正确的图形验证码");
               return false;
           }

           btn_target.addClass("disabled");

           $.ajax({
               url: "/default/get_captcha",
               type:'POST',
               data:{
                   'mobile':mobile,
                   'img_captcha':img_captcha,
                   'source':'wechat'
               },
               dataType:'json',
               success:function(res){
                   btn_target.removeClass("disabled");
                   //由于是验证，没有短信通道，直接告知验证码多少了
                   alert( res.msg );
                   if( res.code != 200 ){
                       $("#img_captcha").click();
                       return;
                   }
               }
           });

       });

    }


};
$(document).ready(function () {
    user_bind_ops.init();

});