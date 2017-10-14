;
var user_bind_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        var that = this;
        // 点击登录
        $(".login_form_wrap .dologin").click(function () {
            var target_btn = $(this);
            if (target_btn.hasClass("disabled")) {
                alert("请不要重复提交");
                return false;
            }

            // 获取前段信息
            var mobile = $(".login_form_wrap .mobile").val();
            var img_captcha = $(".login_form_wrap .img_captcha").val();
            var captcha_code = $(".login_form_wrap .captcha_code").val();

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

            target_btn.addClass("disabled");

            var data={

            }


        })


    }


};
$(document).ready(function () {
    user_bind_ops.init();

});