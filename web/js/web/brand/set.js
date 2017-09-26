;
var brand_set_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        $(".wrap_brand_set .save").click(
            function () {
                var btn_target = $(this);
                if (btn_target.hasClass("disabled")) {
                    common_ops.alert("正在处理,不要重复提交....");
                    return false;
                }

                var name_target = $(".wrap_brand_set input[name=name]");
                var name = name_target.val();

                var mobile_target = $(".wrap_brand_set input[name=mobile]");
                var mobile = mobile_target.val();

                var address_target = $(".wrap_brand_set input[name=address]");
                var address = address_target.val();

                var description_target = $(".wrap_brand_set textarea[name=description]");
                var description = description_target.val();

                if (name.length < 1) {
                    common_ops.tip("请输入符合规范的品牌名称", name_target);
                    return false;
                }

                if (mobile.length < 1) {
                    common_ops.tip("请输入符合规范的手机号码", mobile_target);
                    return false;
                }

                if(address.length < 1){
                    common_ops.tip("请输入符合规范的地址",address_target);
                    return false;
                }

                if(description.length < 1){
                    common_ops.tip("请输入符合规范的品牌介绍",description_target);
                    return false;
                }
                btn_target.addClass("disabled");
                var data = {
                    name:name,
                    mobile:mobile,
                    address:address,
                    description:description
                };
                $.ajax({
                    type:'POST',
                    url:common_ops.buildWebUrl("/brand/set"),
                    data:data,
                    dataType:"json",
                    success:function (res) {
                        btn_target.removeClass("disabled");
                        var callback = null;
                        if(res.code == 200){
                            callback = function () {
                                window.location.href = common_ops.buildWebUrl("/brand/info");
                            }
                        }
                        common_ops.alert(res.msg,callback);
                    }
                })





            }
        );


    }


};

$(document).ready(function () {
    brand_set_ops.init();
});