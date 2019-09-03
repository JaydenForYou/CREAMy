var imglist=$("img");
var lz='medium-zoom-image lazyload';
for(var i=0;i<imglist.length;i++){
  $(imglist[i]).attr("data-src",imglist[i].src);
  $(imglist[i]).attr("class",lz);
}