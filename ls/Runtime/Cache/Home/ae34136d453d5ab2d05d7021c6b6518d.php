<?php if (!defined('THINK_PATH')) exit();?><div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo ($wig_title); ?></div>
  <div class="panel-body">
     <!-- List group -->
  <ul class="list-group">
	<?php if(is_array($news)): foreach($news as $key=>$new): ?><li class="list-group-item"><?php echo ($new['info_title']); ?></li><?php endforeach; endif; ?>
  </ul>
  </div>


</div>