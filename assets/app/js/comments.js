function onClick(id,author) {
  $("textarea").focus();
  let ids = id.replace(/comment-/g,"")
  $("#comment-form").attr("action",self.location.href+"?replyTo="+ids+"#respond-post-1");
  $(function(){
    var inp = $('#textarea');
    inp.focus(function(){
      $(this).attr('placeholder','@'+author)
    })
  })
}