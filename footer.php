<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!empty($this->options->cdn) && $this->options->cdn) {
  define('__TYPECHO_THEME_URL__', Typecho_Common::url(__TYPECHO_THEME_DIR__ . '/' . basename(dirname(__FILE__)), $this->options->cdn));
}
?>
<footer class="site-footer">
  <div class="container d-flex justify-content-sm-between justify-content-center text-center">
    <div class="copyright">
      <p><?php if (!null == $this->options->beian): ?><a href="http://www.miitbeian.gov.cn" target="_blank"
                                                         rel="nofollow noopener"><?php echo $this->options->beian ?></a> | <?php endif ?>
        Powered by TYPECHO. Copyright &copy; 2019. Crafted with <a href="https://github.com/JaydenForYou/CREAMy/"
                                                                   target="_blank" rel="noopener nofollow">CREAMy</a>.
      </p>
    </div>
    <nav class="social-links d-none d-sm-block">
      <ul>
        <li class="social-link"><a href="<?php echo $this->options->weibo ?>"><i class="fab fa-weibo"></i></a></li>
        <li class="social-link"><a href="<?php echo $this->options->twitter ?>"><i class="fab fa-twitter"></i></a></li>
      </ul>
    </nav>
  </div>
</footer>
</div><!-- end #pjax-container -->
<style>
  .app-toasts {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9999;
  }
</style>
<div id="toast" class="app-toasts toast animated bounceInRight" role="alert" aria-live="assertive"
     aria-atomic="true" <?php if (null == $this->options->tips) {
  echo 'hidden';
} ?>>
  <div class="toast-header">
    <strong class="mr-auto"><?php $this->options->title(); ?></strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    <?php $this->options->tips() ?>
  </div>
</div>
<div id="return-to-top" class="fixed-tools animated"><i class="fas fa-angle-double-up"></i></div>
</div>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script>
  //ajax加载文章
  /*  var current_page = 1;

    function load_more_post() {
      current_page++;
      var load_post_url = window.location.href + "index.php/page/" + current_page + "/?load_type=ajax";
      $.get(load_post_url, function (html) {
        console.log('加载：' + load_post_url);
        $('#blockGroup').append($(html));
      })
    }*/

  var APPID = '<?php $this->options->APPID()?>';
  var APPKEY = '<?php $this->options->APPKEY()?>';
  var tongji = '<?php $this->options->tongji()?>';
</script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/app/js/loadmore.js'); ?>"></script>
<script src='<?php $this->options->themeUrl('assets/app/js/casper.js'); ?>'></script>
<?php if (Utils::isEnabled('enablePJAX', 'JConfig')): ?>
  <?php if (Utils::isEnabled('enableLazyload', 'JConfig')): ?>
    <script>
      var isLZ = true;
    </script>
  <?php else: ?>
    <script>
      var isLZ = false;
    </script>
  <?php endif ?>
  <script src="//cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.js"></script>
  <script src='//unpkg.com/nprogress@0.2.0/nprogress.js'></script>
  <script>
    var iSPJAX = true;
  </script>
<?php else: ?>
  <script>
    var iSPJAX = false;
  </script>
<?php endif ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/app/js/app.min.js'); ?>"></script>
<?php if (Utils::isEnabled('enableLazyload', 'JConfig') && $this->is('index') || $this->is('search')): ?>
  <script src="<?php $this->options->themeUrl('assets/app/js/lazyload.js'); ?>"></script>
  <script type="text/javascript">
    $("div.lazyload").lazyload();
  </script>
<?php elseif (Utils::isEnabled('enableLazyload', 'JConfig') && $this->is('page') || $this->is('post')): ?>
  <script src="<?php $this->options->themeUrl('assets/app/js/lazyload.js'); ?>"></script>
  <script type="text/javascript">
    $("img.lazyload").lazyload();
  </script>
<?php endif; ?>
<script>
  $('#toast').toast({
    autohide: false
  }).toast('show');
</script>
<?php $this->footer(); ?>
</body>
</html>
