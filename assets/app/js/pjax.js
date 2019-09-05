(function ($) {
	var loadFiles = {
    js: [],
    css: []
  };
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

function navSwitch(){
  $("html").attr("class","");
  $("nav").attr("class","navbar navbar-expand-md navbar-dark top-nav");
  $("#bswtich").attr("class","navbar-toggler collapsed");
  $("#bswtich").attr("aria-expanded","false");
  $("#navbarSupportedContent").attr("class","navbar-collapse collapse");
}

function loadscript(url, callback) {

  var script = document.createElement("script")

  script.type = "text/javascript";

  if (script.readyState) {

    script.onreadystatechange = function () {

      if (script.readyState == "loaded" || script.readyState == "complete") {

        script.onreadystatechange = null;

        callback();

      }

    };

  } else {

    script.onload = function () {

      callback();

    };

  }

  script.src = url;

  document.getElementsByTagName("head")[0].appendChild(script);

}

function BaiduPUSH() {
  var bp = document.createElement('script');
  var curProtocol = window.location.protocol.split(':')[0];
  if (curProtocol === 'https') {
    bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
  } else {
    bp.src = 'http://push.zhanzhang.baidu.com/push.js';
  }
  var bdPush = document.getElementsByTagName('script')[0];
  bdPush.parentNode.insertBefore(bp, bdPush);

//百度统计
  var hm = document.createElement('script');
  hm.src = tongji;
  var bdhmt = document.getElementsByTagName('script')[0];
  bdhmt.parentNode.insertBefore(hm, bdhmt);
}

$(document).ready(function () {
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
  loadscript('/usr/themes/CREAMy/assets/app/js/app.min.js?ver=1153', function () {
  });
  loadscript('//cdn.jsdelivr.net/npm/leancloud-storage/dist/av-min.js', function () {
  });
  loadscript('https://cdn.jsdelivr.net/npm/valine/dist/Valine.min.js', function () {
  });
  if (document.getElementById('vcomments') !== null) {
    new Valine({
      el: '#vcomments',
      appId: APPID,
      appKey: APPKEY,
      notify: true,
      verify: true,
      avatar: 'mm',
      visitor: true, // 文章访问量统计
      highlight: true, // 代码高亮
      recordIP: true, // 是否记录评论者IP
      placeholder: '请您理智发言，共建美好社会！'
    });
  }
  BaiduPUSH();
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
})
})(jQuery);

window.onload = function () {
  console.log('加载PJAX资源完毕：', loadFiles);
};


