/**
 * Created by 17395 on 2017/7/18.
 */

/**
 * 添加按钮操作
 */
$('#button-add').click(function(){
    var url = SCOPE.add_url;
    window.location.href = url;
});

/**
 * 提交form表单操作
 */
$('#singcms-button-submit').click(function(){
    var data = $('#singcms-form').serializeArray();
    var postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    //将获取到的数据post给服务器
    var url =SCOPE.save_url;    //服务器地址添加
    var jump_url = SCOPE.jump_url;  //成功跳转地址
    $.post(url,postData,function(result){
        if(result.status == 1)
        {
            //成功
            return dialog.success(result.message,jump_url)
            //return dialog.success(result.message,'/index.php?m=admin&c=index');
        }
        else if(result.status == 0){
            //失败
            return dialog.error(result.message);
        }
        else
        {

        }
    },'JSON')
});

/**
 * 菜单编辑
 */
$('.singcms-table #singcms-edit').on('click',function(){
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '&id=' + id;
    window.location.href = url;
});

/**
 * 菜单删除
 */
$('.singcms-table #singcms-delete').on('click',function(){
    var id = $(this).attr('attr-id');
    var a = $(this).attr('attr-a');
    var message = $(this).attr('attr-message');
    var url = SCOPE.set_status_url;

    data = {};
    data['id'] = id;
    data['status'] = -1;
    layer.open({
        type:0,
        title:'菜单删除',
        btn:['确认','取消'],
        icon:3,
        closeBtn:2,
        content:'是否确定' + message+'?',
        scrollbar:true,
        yes:function(){
            //执行相关跳转
            todelete(url,data);
        },
    });
});
/**
 * 执行删除
 * @param url
 * @param data
 */
function todelete(url,data){
    $.post(
        url,
        data,
        function(s){
            if(s.status == 1)
            {
               return dialog.success(s.message,'');
            }
            else
            {
                return dialog.success(s.message);
            }
        }
    ,'JSON');
}
/**
 * 菜单排序
 */
$('#button-listorder').on('click',function(){
    //获取listorder内容
    var data = $('#singcms-listorder').serializeArray();
    var postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    var url = SCOPE.listorder_url;
    $.post(
        url,
        postData,
        function(result){
            if(result.status == 1)
            {
                return dialog.success(result.message,result['data']['jump_url']);
            }
            else if(result.status == 0)
            {
                return dialog.error(result.message,result['data']['jump_url']);
            }

        },'JSON');
});