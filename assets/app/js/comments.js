function onClick(id,author) {
  $("textarea").focus();
  let ids = id.replace(/comment-/g,"");
  $("form").attr("parentid",ids);
  $(function(){
    var inp = $('#textarea');
    inp.focus(function(){
      $(this).attr('placeholder','@'+author)
    })
  })
}

// 依赖jquery,请自行加载
$(function(){
  // 监听评论表单提交
  $('#comment-form').submit(function(){
    var form = $(this), params = form.serialize();
    // 添加functions.php中定义的判断参数
    params += '&Ajax=comment';

    // 解析新评论并附加到评论列表
    var appendComment = function(comment){
      // 评论列表
      var el = $('#comments > .comment-list');
      if(0 != comment.parent){
        // 子评论则重新定位评论列表
        var el = $('#comment-'+comment.parent);
        // 父评论不存在子评论时
        if(el.find('.comment-children').length < 1){
          $('<div class="comment-children"><ol class="comment-list"></ol></div>').appendTo(el);
        }else if(el.find('.comment-children > .comment-list').length <1){
          $('<ol class="comment-list"></ol>').appendTo(el.find('.comment-children'));
        }
        el = $('#comment-'+comment.parent).find('.comment-children').find('.comment-list');
      }
      if(0 == el.length){
        $('<ol class="comment-list"></ol>').appendTo($('#comments'));
        el = $('#comments > .comment-list');
      }
      // 评论html模板，根据具体主题定制
      var html = '<li id="comment-{coid}" class="comment-body comment-ajax"><div class="vcard" id="{coid}"><img class="vimg" src="{avatar}"><div class="vh" id="{coid}"><div class="vhead"><a class="vnick" rel="nofollow" href="{url}" target="_blank">{author}</a>{agent}</div> <div class="vmeta"><span class="vtime">{datetime}</span><span class="vat"><button class="vsubmit vbtn" onclick="onClick({coid},{author})">回复</button></span></div><div class="vcontent"><p>{content}</p></div></div></div></li>';
      $.each(comment,function(k,v){
        regExp = new RegExp('{'+k+'}', 'g');
        html = html.replace(regExp, v);
      });
      $(html).appendTo(el);
    }
    // ajax提交评论
    let parenid = $("form").attr("parentid");
    if(parenid.length==0){
      var req = "";
    }else{
      var req = "comment?parent="+parentid;
    }
    $.ajax({
      url: $("form").attr("action")+req,
      type: 'POST',
      data: params,
      dataType: 'json',
      beforeSend: function() { form.find('.vsubmit').addClass('loading').html('<i class="icon icon-loading icon-pulse"></i> 提交中...').attr('disabled','disabled');},
      complete: function() { form.find('.vsubmit').removeClass('loading').html('提交评论').removeAttr('disabled');},
      success: function(result){
        if(1 == result.status){
          // 新评论附加到评论列表
          appendComment(result.comment);
          form.find('textarea').val('');
        }else{
          // 提醒错误消息
          alert(undefined === result.msg ? '评论出错' : result.msg);
        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        alert('评论失败，请重试');
      }
    });
    return false;
  });
});

