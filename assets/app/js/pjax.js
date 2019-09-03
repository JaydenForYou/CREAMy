function getBaseUrl() {
  var ishttps = 'https:' == document.location.protocol ? true : false;
  var url = window.location.host;
  if (ishttps) {
    url = 'https://' + url;
  } else {
    url = 'http://' + url;
  }
  return url;
}

function Active(){
    let url = getBaseUrl()+'/';
    if(url!=window.location.href) {
      $(this).attr("class", "nav-link active");
      console.log(window.location.href);
    }else{
      $('#home').attr("class", "nav-link");
      $(this).attr("class", "nav-link");
      console.log(window.location.href);
    }
}

function navSwitch(){
  $("html").attr("class","");
  $("nav").attr("class","navbar navbar-expand-md navbar-dark top-nav");
  $("#bswtich").attr("class","navbar-toggler collapsed");
  $("#bswtich").attr("aria-expanded","false");
  $("#navbarSupportedContent").attr("class","navbar-collapse collapse");
}

let url = '"'+getBaseUrl()+'"';
$(document).pjax('a[href^='+ url +']:not(a[target="_blank"], a[no-pjax])', {
  container: '#pjax',
  fragment: '#pjax',
  timeout: 8000
})
$(document).on('pjax:start',function() {
  NProgress.start();
  navSwitch();
});
$(document).on('pjax:end',function() {
  NProgress.done();
});
if(isLZ==true) {
  $(document).on('pjax:complete', function () {
    jQuery(function () {
      jQuery("div").lazyload({effect: "fadeIn"});
    });
    jQuery(function () {
      jQuery("img").lazyload({effect: "fadeIn"});
    });
  });
  console.log('lazyload is opened');
}else{
  console.log('lazyload is closed');
}


