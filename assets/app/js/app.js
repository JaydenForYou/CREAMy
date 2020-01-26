'use strict';
var loadFiles = {
  js: [],
  css: []
};

window.pivot = {
  'init': init
};
var _prevent_scroll = false;
function init(config) {
  var _touch = (('ontouchstart' in window) || ('onmsgesturechange' in window) || !!(navigator.MaxTouchPoints));
  var _targets;
  var _target;
  var _container;
  var i = 0;
  var j = 0;

  if (typeof config === 'undefined' || typeof config !== 'object') {
    return;
  }
  if ('touch' in config) {
    _touch = config.touch;
  }
  if ('selector' in config) {
    _targets = document.querySelectorAll(config.selector);
  }

  if (_targets.length > 0) {
    i = _targets.length;

    for (; i > j; j++) {
      _target = _targets[j];
      _container = _target.parentNode;
      handleHover(_target, _container, config, _touch);
    }
  }
}
function handleHover(target, container, config, touch) {
  var _shadow;
  var _shine;
  var sensitivity = 0;
  var perspectiveProp = getProp(['perspective', 'webkitPerspective', 'mozPerspective']);
  var transformStyleProp = getProp(['transformStyle', 'webkitTransformStyle', 'mozTransformStyle']);
  var transformProp = getProp(['transform', 'webkitTransform', 'mozTransform']);
  var backfaceVisProp = getProp(['backfaceVisibility', 'webkitBackfaceVisibility', 'mozBackfaceVisibility']);
  var willChangeProp = getProp(['willChange']);
  var boxShadowProp = getProp(['boxShadow', 'webkitBoxShadow', 'mozBoxShadow']);
  var userSelectProp = getProp(['userSelect', 'webkitUserSelect', 'mozUserSelect']);
  var transitionPropertyProp = getProp(['transitionProperty', 'webkitTransitionProperty', 'mozTransitionProperty']);
  var transitionDurationProp = getProp(['transitionDuration', 'webkitTransitionDuration', 'mozTransitionDuration']);
  var transitionDelayProp = getProp(['transitionDelay', 'webkitTransitionDelay', 'mozTransitionDelay']);
  var transitionTimingProp = getProp(['transitionTimingFunction', 'webkitTransitionTimingFunction', 'mozTransitionTimingFunction']);

  if (config.perspective && typeof config.perspective === 'number') {
    container.style[perspectiveProp] = config.perspective + 'px';
    target.style[perspectiveProp] = config.perspective + 'px';

  } else {
    container.style[perspectiveProp] = '1000px';
    target.style[perspectiveProp] = '1000px';
  }

  container.style[transformStyleProp] = 'preserve-3d';
  target.style[transformStyleProp] = 'preserve-3d';
  container.style[userSelectProp] = 'none';
  target.style[userSelectProp] = 'none';
  target.style[transformProp] = 'rotateY(0deg) rotateX(0deg)';

  if (config.sensitivity && typeof config.sensitivity === 'number') {
    sensitivity = config.sensitivity;

  } else {
    sensitivity = 20;
  }

  if (touch) {
    target.style[backfaceVisProp] = 'hidden';
  }

  if (config.position && typeof config.position === 'object') {
    target.style.position = config.position.method;
    target.style.zIndex = config.position.zindex;

  } else {
    target.style.position = 'relative';
  }

  if (config.transition && typeof config.transition === 'object') {
    target.style[willChangeProp] = config.transition.prop;
    target.style[transitionPropertyProp] = config.transition.prop;
    target.style[transitionDurationProp] = getUnit(config.transition.duration);
    target.style[transitionTimingProp] = getTFunc(config.transition.timing);

  } else {
    target.style[willChangeProp] = 'transform';
    target.style[transitionPropertyProp] = 'transform';
    target.style[transitionDurationProp] = '0.2s';
    target.style[transitionTimingProp] = 'cubic-bezier(0.3, 1, 0.2, 1)';
  }

  if (config.shadow) {
    _shadow = document.createElement('div');
    _shadow.className = 'shadow';
    _shadow.style.position = 'absolute';
    _shadow.style.top = '5%';
    _shadow.style.left = '5%';
    _shadow.style.bottom = '5%';
    _shadow.style.right = '5%';
    _shadow.style.zIndex = 1;
    _shadow.style[transformProp] = 'translateZ(-2px)';
    _shadow.style[boxShadowProp] = '0 8px 30px rgba(14, 21, 47, 0.6)';

    if (config.transition && typeof config.transition === 'object') {
      _shadow.style[willChangeProp] = 'box-shadow, transform';
      _shadow.style[transitionPropertyProp] = 'box-shadow';
      _shadow.style[transitionDurationProp] = getUnit(config.transition.duration);
      _shadow.style[transitionTimingProp] = getTFunc(config.transition.timing);

    } else {
      _shadow.style[willChangeProp] = 'box-shadow, transform';
      _shadow.style[transitionPropertyProp] = 'box-shadow';
      _shadow.style[transitionDurationProp] = '0.2s';
      _shadow.style[transitionTimingProp] = 'cubic-bezier(0.3, 1, 0.2, 1)';
    }

    target.appendChild(_shadow);
  }

  if (config.shine) {
    _shine = document.createElement('div');
    _shine.className = 'shine';
    _shine.style.position = 'absolute';
    _shine.style.top = 0;
    _shine.style.left = 0;
    _shine.style.bottom = 0;
    _shine.style.right = 0;
    _shine.style.zIndex = 9;
    _shine.style.opacity = 0;

    if (config.transition && typeof config.transition === 'object') {
      _shine.style[willChangeProp] = 'opacity, transform';
      _shine.style[transitionPropertyProp] = 'opacity';
      _shine.style[transitionDurationProp] = getUnit(config.transition.duration);
      _shine.style[transitionTimingProp] = getTFunc(config.transition.timing);

    } else {
      _shine.style[willChangeProp] = 'box-shadow, transform';
      _shine.style[transitionPropertyProp] = 'box-shadow';
      _shine.style[transitionDurationProp] = '0.2s';
      _shine.style[transitionTimingProp] = 'cubic-bezier(0.3, 1, 0.2, 1)';
    }

    target.appendChild(_shine);
  }

  if (config.child3D && typeof config.child3D === 'number') {
    var p = _target.children.length;
    var q = 0;

    for (; p > q; q++) {
      if (!config.shadow || target.children[q].className !== _shadow.className) {
        if (!config.shine || target.children[q].className !== _shine.className) {
          target.children[q].style[transformProp] = 'translateZ(' + config.child3D + 'px)';
        }
      }
    }
  }

  function enter() {
    if (config.hoverClass && config.hoverInClass) {
      target.className += ' ' + config.hoverClass + ' ' + config.hoverInClass;
      setTimeout(function () {
        target.className = removeClass(target.className, config.hoverInClass);
      }, 1000);

    } else if (config.hoverClass) {
      target.className += ' ' + config.hoverClass;

    } else if (config.hoverInClass) {
      target.className += ' ' + config.hoverInClass;
      setTimeout(function () {
        target.className = removeClass(target.className, config.hoverInClass);
      }, 1000);
    }
  }

  function move(e) {
    var w = container.offsetWidth;
    var h = container.offsetHeight;
    var rect = target.getBoundingClientRect();
    var ox = touch ? e.touches[0].clientX - rect.left : e.offsetX;
    var oy = touch ? e.touches[0].clientY - rect.top : e.offsetY;
    var ax = config.invert ? -((w / 2) - ox) / sensitivity : ((w / 2) - ox) / sensitivity;
    var ay = config.invert ? ((h / 2) - oy) / sensitivity : -((h / 2) - oy) / sensitivity;
    var dy = oy - (h / 2);
    var dx = ox - (w / 2);
    var theta = Math.atan2(dy, dx);
    var ang = (theta * (180 / Math.PI)) - 90;
    var angle = ang < 0 ? ang + 360 : ang;

    if (config.scale) {
      target.style[transformProp] = 'rotateY(' + ax + 'deg) rotateX(' + ay + 'deg) scale3d(1.05, 1.05, 1.05)';

    } else {
      target.style[transformProp] = 'rotateY(' + ax + 'deg) rotateX(' + ay + 'deg)';
    }

    if (config.shadow) {
      _shadow.style[boxShadowProp] = '0 24px 48px rgba(14, 21, 47, 0.4), 0 12px 24px rgba(14, 21, 47, 0.4)';
    }

    if (config.shine) {
      _shine.style.opacity = 1;
      _shine.style.backgroundImage = 'linear-gradient(' + angle + 'deg, rgba(230, 230, 230, ' + oy / h * 0.5 + ') 0%, transparent 80%)';
    }
  }

  function leave() {
    if (config.shadow) {
      _shadow.style[boxShadowProp] = '0 8px 30px rgba(14, 21, 47, 0.6)';
    }

    if (!config.persist) {
      target.style[transformProp] = 'rotateX(0deg) rotateY(0deg)';

      if (config.shine) {
        _shine.style.opacity = 0;
      }
    }

    if (config.hoverClass && config.hoverOutClass) {
      target.className += ' ' + config.hoverOutClass;
      target.className = removeClass(target.className, config.hoverClass);
      setTimeout(function () {
        target.className = removeClass(target.className, config.hoverOutClass);
      }, 1000);

    } else if (config.hoverClass) {
      target.className = removeClass(target.className, config.hoverClass);

    } else if (config.hoverOutClass) {
      target.className += ' ' + config.hoverOutClass;
      setTimeout(function () {
        target.className = removeClass(target.className, config.hoverOutClass);
      }, 1000);
    }
  }

  if (touch) {
    container.addEventListener('touchstart', function () {
      if (!_prevent_scroll) {
        _prevent_scroll = true;
      }
      return enter();
    });

    container.addEventListener('touchmove', function (e) {
      if (!!_prevent_scroll) {
        e.preventDefault();
      }
      return move(e);
    });

    container.addEventListener('touchend', function () {
      if (!!_prevent_scroll) {
        window.preventScroll = false;
      }
      return leave();
    });

  } else {
    container.addEventListener('mouseenter', function () {
      return enter();
    });

    container.addEventListener('mousemove', function (e) {
      return move(e);
    });

    container.addEventListener('mouseleave', function () {
      return leave();
    });
  }
}
function getProp(props) {
  var i = props.length;
  var j = 0;

  for (; i > j; j++) {
    if (typeof document.body.style[props[j]] !== 'undefined') {
      return props[j];
    }
  }

  return null;
}
function getUnit(t) {
  if (typeof t !== 'number') {
    console.warn('Please provide a numeric value');
    return '0.2s';

  } else if (t > 1 && t <= 50) {
    return '0.' + t + 's';

  } else if (t > 50) {
    return t + 'ms';

  } else {
    return t + 's';
  }
}
function getTFunc(tf) {
  var tfl = tf.length;

  if (tf.constructor !== Array) {
    console.warn('Bad input: expected array');
    return 'none';

  } else if (tfl === 4) {

    if (typeof tf[0] === 'number' && typeof tf[1] === 'number' && typeof tf[2] === 'number' && typeof tf[3] === 'number') {
      return 'cubic-bezier(' + tf[0] + ', ' + tf[1] + ', ' + tf[2] + ', ' + tf[3] + ')';

    } else {
      console.warn('Bad input: expected numbers');
      return 'none';
    }

  } else {
    console.warn('Bad input: expected four values');
    return 'none';
  }
}
function removeClass(cssClasses, cssClass) {
  var rxp = new RegExp(cssClass + '\\s*', 'gi');
  return cssClasses.replace(rxp, '').replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
}
function rebounce(func) {
  var scheduled, context, args, i, j;
  return function () {
    context = this;
    args = [];
    i = arguments.length;
    j = 0;

    for (; j < i; ++j) {
      args[j] = arguments[j];
    }

    if (!!scheduled) {
      window.cancelAnimationFrame(scheduled);
    }

    scheduled = window.requestAnimationFrame(function () {
      func.apply(context, args);
      scheduled = null;
    });
  }
}

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

/**
 * 日夜模式 - 加载
 */
function initTheme() {
  var darkThemeSelected =
    localStorage.getItem("darkSwitch") !== null &&
    localStorage.getItem("darkSwitch") === "dark";
  darkSwitch.checked = darkThemeSelected;
  if (darkThemeSelected) {
    document.body.setAttribute("data-theme", "dark");
    document.querySelector('.dark-switch-label-span').innerHTML = '<i class="fas fa-sun"></i>';
  } else {
    document.body.removeAttribute("data-theme");
    document.querySelector('.dark-switch-label-span').innerHTML = '<i class="fas fa-moon"></i>';
  }
}

/**
 * 日夜模式 - 重置
 */
function resetTheme() {
  if (darkSwitch.checked) {
    document.body.setAttribute("data-theme", "dark");
    document.querySelector('.dark-switch-label-span').innerHTML = '<i class="fas fa-sun"></i>';
    localStorage.setItem("darkSwitch", "dark");
  } else {
    document.body.removeAttribute("data-theme");
    document.querySelector('.dark-switch-label-span').innerHTML = '<i class="fas fa-moon"></i>';
    localStorage.removeItem("darkSwitch");
  }
}

/**
 * 是否在页面最顶部
 * @returns {boolean} true = 是在页面顶部
 */
function isScrollTop() {
  return $(document).scrollTop() <= 0
}

function log() {
  console.log('已经动态加载资源：', loadFiles);
}

/**
 * 页面初始化要执行的事件
 */
function initPage() {
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
      $('body,html').animate({
        scrollTop: 0
      }, 500);
    });
  });

  /**
   * 文章列表动效
   */
  pivot.init({
    selector: '.site-post-list .post-card-image-link',
    sensitivity: 80,
    touch: false
  });

  if (document.querySelector('.post-content pre code') !== null) {
    //Prism高亮支持
    if (typeof window.Prism === 'undefined') {
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
    } else {
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
      //支持行号显示
      $('.post-content pre').addClass('line-numbers');
    }
  }

  /**
   * 图箱支持
   */
  if ($('.post-content img').length !== 0) {
    var initConfig = function() {
      var zoom = mediumZoom(document.querySelectorAll('.post-content img'), {
        background: '#fff',
      });
      zoom.on('open', function (event) {
      });
      zoom.detach('img.kg-bookmark-icon', '.kg-bookmark-thumbnail img')
    };
    if (typeof window.mediumZoom === 'undefined') {
      loadScript('//cdn.jsdelivr.net/npm/medium-zoom/dist/medium-zoom.min.js', function () {
        initConfig();
      });
    } else {
      initConfig();
    }
  }

  /**
   * 日夜切换
   */
  var darkSwitch = document.getElementById("darkSwitch");
  if (darkSwitch) {
    initTheme();
    darkSwitch.addEventListener("change", function (event) {
      resetTheme();
    });
  }

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
   * 弹窗提醒
   */
  if(!Boolean(localStorage.noPopUp)) {
    $('#toast').toast({
      autohide: true,
      delay: 5000
    }).toast('show');
    $('#toast .close').click(function () {
      localStorage.setItem('noPopUp', true)
    });
  } else {
    $('#toast').toast('hide');
  }
}

// 页面初始化执行
$(document).ready(function () {
  initPage();
})

window.onload = function () {
  log();
};
