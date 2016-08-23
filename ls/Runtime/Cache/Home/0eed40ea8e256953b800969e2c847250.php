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

		

	<div class="container">
	<form method="post">
  <div class="form-group">
    <label >用户名</label>
    <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="填入用户名">
  </div>
  <div class="form-group">
    <label >密码</label>
    <input type="password" class="form-control" id="txtPwd" name="txtPwd" placeholder="填入密码">
  </div>
    <div class="form-inline">
    <label >验证码</label>
    <input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="请输入验证码">
    <img src="/tp/Home/temp/verify" style="width: 100px;height: 50px;cursor: pointer;" onclick="this.src='/tp/Home/temp/verify?aa='+Math.random()"/>
  </div>

  <div class="checkbox">
    <label>
      <input type="checkbox" name="saveUser" id="saveUser"> 保存一周
    </label>
  </div>
  <button type="submit" class="btn btn-default">登录</button>
  <span style="color: red;"><?php echo ($errorinfo); ?></span>
</form>
</div>

<hr />
<div id="footer">
	icp备 123
</div>
	</body>
</html>