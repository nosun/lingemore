<?php /* Smarty version 2.6.26, created on 2012-06-05 17:20:06
         compiled from lay_sitemap.xml */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
<loc>http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['folder']; ?>
</loc>
<lastmod><?php echo $this->_tpl_vars['lastmod']; ?>
</lastmod>
<changefreq>daily</changefreq>
</url>
<?php $_from = $this->_tpl_vars['rs_disp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_disp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_disp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_disp']['iteration']++;
?>
<url>
<loc>http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
</loc>
<lastmod><?php echo $this->_tpl_vars['lastmod']; ?>
</lastmod>
<changefreq>weekly</changefreq>
</url>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['rs_map']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_map'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_map']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_map']['iteration']++;
?>
<url>
<loc>http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
</loc>
<lastmod><?php echo $this->_tpl_vars['lastmod']; ?>
</lastmod>
<changefreq>weekly</changefreq>
</url>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>
<url>
<loc>http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
</loc>
<lastmod><?php echo $this->_tpl_vars['lastmod']; ?>
</lastmod>
<changefreq>weekly</changefreq>
</url>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['rs_n']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_n']['iteration']++;
?>
<url>
<loc>http://<?php echo $this->_tpl_vars['hostname']; ?>
<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
</loc>
<lastmod><?php echo $this->_tpl_vars['lastmod']; ?>
</lastmod>
<changefreq>weekly</changefreq>
</url>
<?php endforeach; endif; unset($_from); ?>
</urlset>