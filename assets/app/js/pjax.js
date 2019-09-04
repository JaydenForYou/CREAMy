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

function loadScript(fileName, callback, into) {
  into = into || 'body';
  callback = callback || function () {
  };
  var script = null;
  script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = fileName;
  script.onload = function () {
    loadFiles.js.push(fileName);
    callback();
  };
  if (into === 'head') {
    document.getElementsByTagName('head')[0].appendChild(script);
  } else {
    document.body.appendChild(script);
  }
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
  loadScript('/usr/themes/CREAMy/assets/app/js/app.min.js?ver=1153', function () {
  });
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
}else{
  console.log('lazyload is closed');
}



