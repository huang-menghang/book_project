;
var upload = {
    error: function (msg) {
        common_ops.alert(msg);
    },
    success: function (file_ley,type) {
        var html = '<img src="'+common_ops.buildPicUrl('brand',file_ley)+'"/>'
            +'<span class="fa fa-times-circle del del_image" data="'+file_ley+'"></span>';

        if( $(".upload_pic_wrap .pic-each").size() > 0 ){
            $(".upload_pic_wrap .pic-each").html( html );
        }else{
            $(".upload_pic_wrap").append('<span class="pic-each">'+ html + '</span>');
        }
        // 绑定删除事件
        brand_image_ops.delete_img();
    }
};
var brand_image_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        $(".set_pic").click(function () {
            $("#brand_image_wrap").modal('show');
        });
        // 提交图片
        $("#brand_image_wrap .upload_pic_wrap input[name='pic']").change(function () {
            $("#brand_image_wrap .upload_pic_wrap").submit();
        });
        // 将图片路径放到
        $("#brand_image_wrap .save").click(function () {
            var btn_target = $(this);
            if (btn_target.hasClass('disabled')) {
                common_ops.alert("正在处理,请不要重复提交...");
                return false;
            }

            if ($("#brand_image_wrap .pic-each").size() < 1) {
                common_ops.alert("请上传图片");
                return false;
            }

            btn_target.addClass('disabled');

            $.ajax({
                url: common_ops.buildWebUrl("/brand/set-images"),
                type: 'POST',
                data: {
                    image_key: $("#brand_image_wrap .pic-each .del_image").attr("data")
                },
                dataType: 'json',
                success: function (res) {
                    btn_target.remove("disabled");
                    var callback = null;
                    if (res.code == 200) {
                        callback = function () {
                            window.location.href = window.location.href;
                        }
                        common_ops.alert(res.msg, callback);
                    }
                }
            })
        });
        $(".remove").click(function () {
           var id = $(this).attr("data");
           var callback = {
               'ok':function () {
                   $.ajax({
                      url:common_ops.buildWebUrl("/brand/image-ops"),
                      type:'POST',
                       data:{
                          id:id
                       },
                       dataType:'json',
                       success:function (res) {
                           var callback = null;
                            if(res.code == 200){
                                callback = function () {
                                    window.location.href = window.location.href;
                                }
                                common_ops.alert(res.msg,callback);
                            }

                      }
                   });


               },
               'cancle':null
           }
            common_ops.confirm("确定要删除?",callback);
        });
    },
    delete_img:function () {
        $("#brand_image_wrap .del_image").unbind().click(function () {
                $(this).parent().remove();
            }
        )
    }
}

$(document).ready(function () {
    brand_image_ops.init();
})
