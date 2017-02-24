<?php /* Smarty version 2.6.26, created on 2012-04-19 11:27:29
         compiled from lay_rss.xml */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	>
<channel>
	<title><?php echo $this->_tpl_vars['tilte']; ?>
</title>
	<atom:link href="<?php echo $this->_tpl_vars['linkhref']; ?>
" rel="self" type="application/rss+xml" />
	<link>http://<?php echo $this->_tpl_vars['hostname']; ?>
</link>
	<description><?php echo $this->_tpl_vars['descript']; ?>
</description>
	<lastBuildDate><?php echo $this->_tpl_vars['lastBuildDate']; ?>
</lastBuildDate>
	<language>en</language>
	<sy:updatePeriod>hourly</sy:updatePeriod>
	<sy:updateFrequency>1</sy:updateFrequency>
	<generator>Rss Generator By <?php echo $this->_tpl_vars['hostname']; ?>
</generator>
	<?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>
		<item>
		<title><![CDATA[<?php echo $this->_tpl_vars['rows']['name']; ?>
]]></title>
		<link>http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
</link>
		<dc:creator><?php echo $this->_tpl_vars['hostname']; ?>
</dc:creator>
		<pubDate><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</pubDate>
		<guid isPermaLink="false">#comment-1</guid>
		<description>
		<![CDATA[
		<a href="http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img  src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0" /></a><br>
		<p><?php echo $this->_tpl_vars['rows']['descript']; ?>
</p>
		]]>
		</description>
	    </item>
		<?php endforeach; endif; unset($_from); ?>
</channel>
</rss>