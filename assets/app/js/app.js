'use strict';
var loadFiles = {
  js: [],
  css: []
};

(function ($, pivot) {
  $(function () {
    //初始化顶栏透明
    isScrollTop() ? addTopNav() : removeTopNav();
    //滚动顶栏透明
    $(window).scroll(function () {
      isScrollTop() ? addTopNav() : removeTopNav();
    });
    // 移动端点击菜单按钮添加样式
    $('.navbar-toggler').click(function (event) {
      if ($(this).attr('aria-expanded') === 'false') {
        if (isScrollTop()) {
          $('nav.navbar').removeClass(['navbar-dark', 'top-nav']).addClass('navbar-light');
        }
        $('html').addClass('overflow-hidden');
      } else {
        if (isScrollTop()) {
          $('nav.navbar').addClass(['navbar-dark', 'top-nav']).removeClass('navbar-light');
        }
        $('html').removeClass('overflow-hidden');
      }
    });
    // 回到顶部
    var returnTop = $('#return-to-top');
    $(window).scroll(function () {
      if ($(this).scrollTop() >= 50) {
        returnTop.addClass('bounceInRight').removeClass('bounceOutDown')
      } else {
        returnTop.removeClass('bounceInRight').addClass('bounceOutDown');
      }
    });
    returnTop.click(function () {
      $('body,html').animate(
        {
          scrollTop: 0
        },
        500
      );
    });

  });

  // 文章列表动效
  pivot.init({
    selector: '.post-card-image-link',
    sensitivity: 80,
    touch: false
  });

  //Prism高亮支持
  loadCSS('//cdn.jsdelivr.net/npm/prismjs@1.15.0/themes/prism-tomorrow.min.css');
  loadScript('//cdn.jsdelivr.net/npm/prismjs/components/prism-core.min.js', function () {
    loadScript('//cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js', function () {
        //将html代码块支持高亮
        $('.post-content pre code').attr('class', function (i, clazz) {
          if (clazz !== undefined) {
            return clazz.replace(/language-html/g, 'language-markup');
          }
        });
        //设置高亮语言样式文件地址
        if (window.Prism !== 'undefined') {
          Prism.plugins.autoloader.languages_path = '//cdn.jsdelivr.net/npm/prismjs/components/';
          Prism.highlightAll();
        }
      }
    );
  });
  //行号
  loadCSS('//cdn.jsdelivr.net/npm/prismjs/plugins/line-numbers/prism-line-numbers.min.css');
  loadScript('//cdn.jsdelivr.net/npm/prismjs/plugins/line-numbers/prism-line-numbers.min.js');
  //支持行号显示
  $('.post-content pre').addClass('line-numbers');
  //显示语言或者粘贴
  loadCSS('//cdn.jsdelivr.net/npm/prismjs/plugins/toolbar/prism-toolbar.min.css');
  loadScript('//cdn.jsdelivr.net/npm/prismjs/plugins/toolbar/prism-toolbar.min.js');
  loadScript('//cdn.jsdelivr.net/npm/prismjs/plugins/show-language/prism-show-language.min.js');
  loadScript('//cdn.jsdelivr.net/npm/clipboard/dist/clipboard.min.js');
  loadScript('//cdn.jsdelivr.net/npm/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js');

  //图箱支持
  loadScript('//cdn.jsdelivr.net/npm/medium-zoom/dist/medium-zoom.min.js', function () {
    var zoom = mediumZoom(document.querySelectorAll('.post-content img'));
    zoom.on('open', function (event) {
    })
  });

  /**
   * 添加导航样式
   */
  function addTopNav() {
    $('nav.navbar').addClass('top-nav').addClass('navbar-dark').removeClass('navbar-light');
  }

  /**
   * 移除导航样式
   */
  function removeTopNav() {
    $('nav.navbar').removeClass('top-nav').removeClass('navbar-dark').addClass('navbar-light');
  }

  /**
   * 是否在页面最顶部
   * @returns {boolean} true = 是在页面顶部
   */
  function isScrollTop() {
    return $(document).scrollTop() <= 0
  }
})(window.jQuery, window.pivot);

/**
 * 动态加载JS文件的方法
 * Load javascript file method
 *
 * @param {String}   fileName              JS文件名
 * @param {Function} [callback=function()] 加载成功后执行的回调函数
 * @param {String}   [into='head']         嵌入页面的位置
 */
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

/**
 * 动态加载CSS文件的方法
 * Load css file method
 *
 * @param {String}   fileName              CSS文件名
 * @param {Function} [callback=function()] 加载成功后执行的回调函数
 * @param {String}   [into='head']         嵌入页面的位置
 */
function loadCSS(fileName, callback, into) {
  into = into || 'head';
  callback = callback || function () {
  };

  var css = document.createElement('link');
  css.type = 'text/css';
  css.rel = 'stylesheet';
  css.onload = css.onreadystatechange = function () {
    loadFiles.css.push(fileName);
    callback();
  };
  css.href = fileName;
  if (into === 'head') {
    document.getElementsByTagName('head')[0].appendChild(css);
  } else {
    document.body.appendChild(css);
  }
}

window.onload = function () {
  console.log('已经动态加载资源：', loadFiles);
};
