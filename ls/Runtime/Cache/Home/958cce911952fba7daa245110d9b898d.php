<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		
		<link href="/tp/Public/bs/css/bootstrap.min.css" rel="stylesheet"/>
		<script src="/tp/Public/bs/js/jquery.js"></script>
		<script src="/tp/Public/bs/js/bootstrap.min.js"></script>
	</head>
	<style>
		body{ padding-top: 70px;}
	</style>
	<body>

	

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	
      	
      	<?php $navbar=W('Nav/def');?>
 		<?php if(is_array($navbar)): foreach($navbar as $key=>$nav): ?><li><a href="<?php echo ($nav["nav_href"]); ?>"><?php echo ($nav["nav_title"]); ?></a></li><?php endforeach; endif; ?>
			<!--<?php $nav = M("navbar"); $ret=$nav->where("nav_isshow=1")->order("nav_index")->select(); foreach($ret as $r) { echo "<li><a href=".$r["nav_href"].">".$r["nav_title"]."</a></li>"; }; ?>-->
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      	<li><a id="cart_set"><span class="glyphicon glyphicon-shopping-cart"></span>购物车<span class="badge" id="cart_num"></span></a> </li>
	<?php if($user_login): ?>
<li><a href="#"><?php echo ($user_login->user_name); ?></a></li>

<li><a href="?do=logout">注销</a></li>
<?php else: ?>
<li><a href="/tp/Home/login">登录</a></li>

<li><a href="/tp/Home/reg">注册</a></li>

<?php endif ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

		

	<style>
		.media{margin-bottom: 30px;boder-bottom:solid 10px #ddd;}
	</style>
	<script >
		var detail_data=[
	
				<?php if(is_array($detail_data)): foreach($detail_data as $key=>$info): ?>[<?php echo ($info["info_id"]); ?>,'<?php echo ($info["im_key"]); ?>','<?php echo ($info["im_value"]); ?>'],<?php endforeach; endif; ?>
				[-1,"",""]
				];
				
	function getMeta(info_id,im_key,defaultvalue)
    {
        for(var i=0;i<detail_data.length;i++)
        {
            if(detail_data[i][0]==info_id && detail_data[i][1]==im_key )
                    return detail_data[i][2];
        }
        if(defaultvalue)
        return defaultvalue;
        else
              return 0;
    }
		
	</script>
	<div class="container clearfix">
		<div class="col-md-8 column">
			<?php if(is_array($main_data)): foreach($main_data as $key=>$info): ?><div class="row">
					<div class="page-header">
						<h4 class="media-heading"><?php echo ($info["info_title"]); ?></h4>
					</div>
						<div class="col-md-4">
							<a href="#">
							<script>document.write("<img src='"+getMeta(<?php echo ($info["info_id"]); ?>,'pimg','/tp/Public/prod/3.jpg')+"'/>");</script>
							</a>
						</div>
						
						<div class="col-md-8">
														<blockquote><?php echo ($info["info_des"]); ?></blockquote>
							<!--<?php $meta_data=R('Info/loadDetail',array($md['info_id'],$detail_data),'API');?>//在API写传入-->
							<p><small>点击量:<script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'views'));</script> </small>
                              <small>评论数:<script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'review'));</script></span>
							</p>
	
						</div>
					
				</div><?php endforeach; endif; ?>
			<div class="pagination">
				<?php echo ($pagebar); ?>
			</div>
		

		</div>
			<div class="col-md-4 column">
				<?php echo W('Info/load',array(1));?>
			</div>
	</div>

<hr />
<div id="footer">
	icp备 123
</div>
	</body>
</html>