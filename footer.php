<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
if(!empty($this->options->qiniu)){
  $qurl = str_replace($this->options->siteUrl,$this->options->qiniu.'/',$this->options->themeUrl);
}else{
  $qurl = $this->options->themeUrl;
}
$pivot = $qurl.'/assets/pivot/pivot.js';
$appminjs = $qurl.'/assets/app/js/app.min.js?ver=1153';
$lazyload = $qurl.'/assets/app/js/lazyload.js';
$casper = $qurl.'/assets/app/js/casper.js';
$comments = $qurl.'/assets/app/js/comments.js';
$pjax = $qurl.'/assets/app/js/pjax.js';
?>

<footer class="site-footer">
  <div class="container d-flex justify-content-sm-between justify-content-center text-center">
    <div class="copyright">
      <p><?php if(!null==$this->options->beian):?><a href="http://www.miitbeian.gov.cn" target="_blank" rel="nofollow noopener"><?php echo $this->options->beian ?></a> | <?php endif ?>Powered by TYPECHO. Copyright &copy; 2019. Crafted with <a href="https://github.com/JaydenForYou/CREAMy/" target="_blank" rel="noopener nofollow">CREAMy</a>.</p>
    </div>
    <nav class="social-links d-none d-sm-block">
      <ul>
        <li class="social-link"><a href="<?php echo $this->options->weibo?>"><i class="fab fa-weibo"></i></a></li>
        <li class="social-link"><a href="<?php echo $this->options->twitter?>"><i class="fab fa-twitter"></i></a></li>
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
<script>
  var APPID = '<?php $this->options->APPID()?>';
  var APPKEY = '<?php $this->options->APPKEY()?>';
  var tongji = '<?php $this->options->tongji()?>';
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src='<?=$casper?>'></script>
<?php if(Utils::isEnabled('enablePJAX','JConfig')): ?>
  <?php if(Utils::isEnabled('enableLazyload','JConfig')): ?>
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
  <script src='<?=$pjax?>'></script>
<?php endif ?>
<script src='<?=$comments?>'></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?=$pivot?>"></script>
<script type="text/javascript" src="<?=$appminjs?>"></script>
<?php if(Utils::isEnabled('enableLazyload','JConfig')&&$this->is('index')||$this->is('search')): ?>
  <script src="<?=$lazyload?>"></script>
  <script type="text/javascript">
    $("div.lazyload").lazyload();
  </script>
<?php elseif(Utils::isEnabled('enableLazyload','JConfig')&&$this->is('page')||$this->is('post')): ?>
  <script src="<?=$lazyload?>"></script>
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
