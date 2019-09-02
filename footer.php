<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
if(!empty($this->options->qiniu)){
  $qurl = str_replace($this->options->siteUrl,$this->options->qiniu.'/',$this->options->themeUrl);
}else{
  $qurl = $this->options->themeUrl;
}
$jquery = $qurl.'/assets/jquery/jquery.js';
$bootstrapjs = $qurl.'/assets/bootstrap/bootstrap.js';
$pivot = $qurl.'/assets/pivot/pivot.js';
$appminjs = $qurl.'/assets/app/js/app.min.js?ver=1153';
$demo = $qurl.'/demo.js';
$lazyload = $qurl.'/assets/app/js/lazyload.js';
?>
<footer class="site-footer">
  <div class="container d-flex justify-content-sm-between justify-content-center text-center">
    <div class="copyright">
      <p><?php if(!null==$this->options->beian):?><a href="http://www.miitbeian.gov.cn/"><?php echo $this->options->beian ?></a><?php endif ?> | Powered by TYPECHO. Copyright &copy; 2019. Crafted with <a href='https://github.com/JaydenForYou/JaydenForU/' >JaydenForU</a>.</p>
    </div>
    <nav class="social-links d-none d-sm-block">
      <ul>
        <li class="social-link"><a href="<?php $this->options->weibo()?>"><i class="fab fa-weibo"></i></a></li>
        <li class="social-link"><a href="<?php $this->options->twitter()?>"><i class="fab fa-twitter"></i></a></li>
      </ul>
    </nav>
  </div>
</footer>
<style>
  .app-toasts {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9999;
  }
</style>
<div id="toast" class="app-toasts toast animated bounceInRight" role="alert" aria-live="assertive"
     aria-atomic="true" <?php if (null == $this->options->tips()) {
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
<div id="return-to-top" class="animated"><i class="fas fa-angle-double-up"></i></div>
</div>
<script>
    var APPID = '<?php $this->options->APPID()?>';
    var APPKEY = '<?php $this->options->APPKEY()?>';
    var tongji = '<?php $this->options->tongji()?>';
</script>
<script type="text/javascript" src="<?=$jquery?>"></script>
<script src='//cdn.iobiji.com/usr/themes/JaydenForU/assets/app/js/casper.js'></script>
<script type="text/javascript" src="<?=$bootstrapjs?>"></script>
<script type="text/javascript" src="<?=$pivot?>"></script>
<script type="text/javascript" src="<?=$appminjs?>"></script>
<script type="text/javascript" src="<?=$demo?>"></script>
<?php if(Utils::isEnabled('enableLazyload','JConfig')): ?>
  <script src="<?=$lazyload?>"></script>
<script>
  $("div.lazyload").lazyload();
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
