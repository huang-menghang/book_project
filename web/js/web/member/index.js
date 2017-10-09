;
var member_index_ops = {
    init:function () {
      this.eventBind();
    },
    eventBind:function () {
     // 会员搜索...
     $(".wrap_search .search").click(function () {
            $(".wrap_search").submit();
        })
    }
};
$(function () {
    member_index_ops.init();
});