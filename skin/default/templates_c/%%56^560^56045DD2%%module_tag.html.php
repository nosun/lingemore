<?php /* Smarty version 2.6.26, created on 2012-04-29 10:42:12
         compiled from module_tag.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<script type="text/javascript">
function showitem(id,acur)
{
var obj=document.getElementById(id);
if (obj.style.display=="none")
 {$(obj).slideDown("slow");$(acur).removeClass("updown_d");}
else
 {$(obj).slideUp("slow");$(acur).addClass("updown_d");}
}
</script>
<style type="text/css">
.w190{width:190px;}
.w188{width:190px;}
.boxboxder{border:1px #DDDDDD solid; border-top:0px;}
.tag_narrowby{height:33px; background:url(../pic/tag_narrowby_bg.jpg) repeat-x;}
.tag_narrowby_left{float:left; height:33px; line-height:33px; display:inline; padding-left:10px; color:#FFF; font-weight:bold; font-family:Verdana;}
.tag_narrowby_right{float:right; height:33px; line-height:33px; display:inline; padding-right:5px;}
a.cleartag{color:#FFF; font-weight:bold;font-family:Verdana;}
.tag_type{height:21px; padding-top:6px; background:url(../pic/tag_type_bg.jpg) repeat-x; position:relative;}
.tag_type span{font-weight:bold; color:#333; text-transform:uppercase; padding-left:12px; font:bold 10px/14px Verdana;}
.tag_type a.updown{width:13px; height:8px; display:block; position:absolute; right:5px; top:8px; background:url(../pic/tag_type_up.gif) no-repeat;}
.tag_type a.updown:hover{width:13px; height:8px; display:block; position:absolute; right:5px; top:8px; background:url(../pic/tag_type_up_cur.gif) no-repeat;}
.tag_type a.updown_d{width:13px; height:8px; display:block; position:absolute; right:5px; top:8px; background:url(../pic/tag_type_down.gif) no-repeat;}
.tag_type a.updown_d:hover{width:13px; height:8px; display:block; position:absolute; right:5px; top:8px; background:url(../pic/tag_type_down_cur.gif) no-repeat;}
.tag_item{line-height:27px;}
.tag_item a.item{display:block; padding-left:30px; padding-top:5px; padding-bottom:5px; background:url(../pic/tag_item_off.gif) 12px center no-repeat; font-family:Verdana; font:10px/12px Verdana; color:#000000;}
.tag_item a.item:hover{display:block; padding-left:30px; padding-top:5px; padding-bottom:5px; background:url(../pic/tag_item_on.gif) 12px center no-repeat #F4F4F4; font-family:Verdana; text-decoration:none; color:#B40200;}
.tag_item a.item_cur{ display:block; padding-left:30px; background:url(../pic/tag_item_on.gif) 12px center no-repeat; font-family:Verdana;}
.tag_item a.item_cur:hover{ display:block; padding-left:30px; background:url(../pic/tag_item_on.gif) 12px center no-repeat #F4F4F4; font-family:Verdana; text-decoration:none;}
.tag_count{font-size:10px; color:#999999;}
</style>

<div class="w188 boxboxder">
  <div class="tag_narrowby">
     <div class="tag_narrowby_left">Narrow by</div>
  </div>
  <div class="w188">
        <?php $_from = $this->_tpl_vars['rs_leftfilter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
          <div class="w188 tag_type"><span><?php echo $this->_tpl_vars['rows']['name']; ?>
</span><a class="updown" href="javascript:;" onclick="showitem('tag_type<?php echo $this->_tpl_vars['key1']; ?>
',this)" rel="nofollow"></a></div>
        <div id="tag_type<?php echo $this->_tpl_vars['key1']; ?>
">
        <?php $_from = $this->_tpl_vars['rows']['son']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['srows']):
?>
          <div class="tag_item"><a class="item <?php if ($this->_tpl_vars['srows']['checked']): ?>item_cur<?php endif; ?>" href="<?php echo $this->_tpl_vars['srows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['srows']['name']; ?>
&nbsp;<span class="tag_count">(<?php echo $this->_tpl_vars['srows']['num']; ?>
)</span></a>
          </div>
        <?php endforeach; endif; unset($_from); ?>
        </div>
        <?php endforeach; endif; unset($_from); ?>
  </div>
</div>

<div class="clear"></div>