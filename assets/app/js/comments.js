function onClick(id,author) {
  $("textarea").focus();
  let ids = id.replace(/comment-/g,"")
  let action = $("form").attr("action");
  $("#comment-form").attr(action,"comment?parent="+ids);
  $(function(){
    var inp = $('#textarea');
    inp.focus(function(){
      $(this).attr('placeholder','@'+author)
    })
  })
}