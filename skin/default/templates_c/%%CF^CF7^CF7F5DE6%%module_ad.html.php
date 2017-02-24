<?php /* Smarty version 2.6.26, created on 2013-01-30 18:03:40
         compiled from module_ad.html */ ?>
 <script type="text/javascript" src="../pic/jquery.KinSlideshow-1.2.min.js"></script><script type="text/javascript"> 

$(function(){

	$("#KinSlideshow").KinSlideshow({

			moveStyle:"left",

			intervalTime:8,

			mouseEvent:"mouseover",

			titleBar:{titleBar_height:30,titleBar_bgColor:"#08355c",titleBar_alpha:0.9,TitleFont_weight:"bold"},

			titleFont:{TitleFont_size:14,TitleFont_color:"#666668",TitleFont_weight:"bold"},

			btn:{btn_bgColor:"#393939",btn_bgHoverColor:"#CF1010",btn_fontColor:"#FFF",btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#DADEDD",btn_borderHoverColor:"#DADEDD",btn_borderWidth:0,btn_bgAlpha:1}

	});

})

</script>

<style type="text/css">

.KinSlideshow_titleBar{display:none;}

</style>

<div class="w772">

    <div style="height:280px; width:772px; float:left; overflow:hidden; margin-bottom:10px;">

        <div id="KinSlideshow" style="z-index:0;">

            <?php unset($this->_sections['flash']);
$this->_sections['flash']['name'] = 'flash';
$this->_sections['flash']['start'] = (int)0;
$this->_sections['flash']['loop'] = is_array($_loop=$this->_tpl_vars['rs_ad'][1]['pic']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['flash']['show'] = true;
$this->_sections['flash']['max'] = $this->_sections['flash']['loop'];
$this->_sections['flash']['step'] = 1;
if ($this->_sections['flash']['start'] < 0)
    $this->_sections['flash']['start'] = max($this->_sections['flash']['step'] > 0 ? 0 : -1, $this->_sections['flash']['loop'] + $this->_sections['flash']['start']);
else
    $this->_sections['flash']['start'] = min($this->_sections['flash']['start'], $this->_sections['flash']['step'] > 0 ? $this->_sections['flash']['loop'] : $this->_sections['flash']['loop']-1);
if ($this->_sections['flash']['show']) {
    $this->_sections['flash']['total'] = min(ceil(($this->_sections['flash']['step'] > 0 ? $this->_sections['flash']['loop'] - $this->_sections['flash']['start'] : $this->_sections['flash']['start']+1)/abs($this->_sections['flash']['step'])), $this->_sections['flash']['max']);
    if ($this->_sections['flash']['total'] == 0)
        $this->_sections['flash']['show'] = false;
} else
    $this->_sections['flash']['total'] = 0;
if ($this->_sections['flash']['show']):

            for ($this->_sections['flash']['index'] = $this->_sections['flash']['start'], $this->_sections['flash']['iteration'] = 1;
                 $this->_sections['flash']['iteration'] <= $this->_sections['flash']['total'];
                 $this->_sections['flash']['index'] += $this->_sections['flash']['step'], $this->_sections['flash']['iteration']++):
$this->_sections['flash']['rownum'] = $this->_sections['flash']['iteration'];
$this->_sections['flash']['index_prev'] = $this->_sections['flash']['index'] - $this->_sections['flash']['step'];
$this->_sections['flash']['index_next'] = $this->_sections['flash']['index'] + $this->_sections['flash']['step'];
$this->_sections['flash']['first']      = ($this->_sections['flash']['iteration'] == 1);
$this->_sections['flash']['last']       = ($this->_sections['flash']['iteration'] == $this->_sections['flash']['total']);
?><a href="<?php echo $this->_tpl_vars['rs_ad'][1]['url'][$this->_sections['flash']['index']]; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['rs_ad'][1]['pic'][$this->_sections['flash']['index']]; ?>
" width="772" height="280" /></a><?php endfor; endif; ?>

        </div>

    </div>

<div style="padding:0px;font-family:Arial;font-size:13px;color:#FF0000;font-weight:bold;">
<marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrollamount="4"><?php echo $this->_tpl_vars['content_225']; ?>
</marquee>
</div>
    <div class="clear1"></div>

</div>