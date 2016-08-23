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
		.pcontent{line-height: 18pt;padding: 10px;}
		.price li{border: 0;background: #F5F5F5;padding: 0;}
		.pmeta{border-top:dashed 1px #DDDDDD ;border-bottom: dashed 1px #DDDDDD;}
		.pmeta li{border: 0;}
		.1pmeta li:hover{background: #F5F5F5;cursor: pointer;}
		.pbtn button{width: 160px;}
		.pmetalist{margin-bottom: 30px;display: inline-block;}
		.pmetalist a{text-decoration: none;}
		.pmetalist .pname{float: left;border: 0;}
		.pmetalist li{float: left;margin-right: 8px;padding: 6px 15px;}
		.pmetalist li:hover{background: #F5F5F5;cursor: pointer;}
		.pmetalist .pname:hover{background: none;}
		.choselis{border-color: orangered;}
	</style>
	<script type="text/html" id="tpl_ptype">
		<li class="list-group-item "><span ><a href="#" im_id='{im_id}' class='ptype'>{pkey}</a></span></li>
	</script>

	<script >
		var detail_data=[
	
				<?php if(is_array($detail_data)): foreach($detail_data as $key=>$info): ?>[<?php echo ($info["info_id"]); ?>,'<?php echo ($info["im_key"]); ?>','<?php echo ($info["im_value"]); ?>',<?php echo ($info["im_pid"]); ?>,<?php echo ($info["im_id"]); ?>],<?php endforeach; endif; ?>
				[-1,"",""]
				];
				
	function getMeta(info_id,im_key,defaultvalue)
    {
    	
        for(var i=0;i<detail_data.length;i++)
        {
            
            if(detail_data[i][0]==info_id && detail_data[i][1]==im_key && parseInt(detail_data[i][3])==0)
                  
                    return detail_data[i][2];
        }
        if(defaultvalue)
        return defaultvalue;
        else
              return 0;
    }
    	function getMetaByPid(im_id,im_key)//
    {
        for(var i=0;i<detail_data.length;i++)
        {
            if(detail_data[i][3]==im_id&&detail_data[i][1]==im_key)
           {
           	
              var im_relatioin=getMeta(<?php echo ($info["info_id"]); ?>,detail_data[i][4],0);	
      
                    if(im_relatioin>0)//要去判断 im_id=im_relatioin的 规格是否被选中
                    {
                    	
                        if($(".ptype[im_id='"+im_relatioin.toString()+"']").parents("li").hasClass("choselis"))
                        {
                            
                            return detail_data[i][2];
                        }
                    }
                    else
                    return detail_data[i][2];
       		}	 
        }
     	 return 0;
    }

    	function getMetaList(info_id,im_key,tpl_id)
    {
    	var result="";
    	var tpl_content=$("#"+tpl_id).html();//模板内容，根据tpl_id加载不同模板
    	tpl_content=tpl_content.replace("{pkey}","{"+im_key+"}");
        for(var i=0;i<detail_data.length;i++)
        {
        	
            if(detail_data[i][0]==info_id && detail_data[i][1]==im_key )
                   result+=tpl_content.replace("{"+im_key+"}",detail_data[i][2]).replace("{im_id}",detail_data[i][4]);
        	
        }
        return result;
 
    }
        $(document).ready(function(){
    	$(".ptype").click(function(){
    		if($(this).parents('ul').attr("primary")==1)
    		{
 
    			$("ul[primary='0']").find("li").removeClass("choselis")==0;//选中为主规格，清空子规格
    		}
    		$(this).parents("ul").find('li').removeClass("choselis");
    		$(this).parents("li").addClass("choselis");
    		//点击规格时切换价格
    		var im_id=$(this).attr("im_id");//属性主键ID
    		var get_meta=getMetaByPid(im_id,'price2');
    		if(parseFloat(get_meta)>0)
    		{
    			$("#meta_price").html("￥"+get_meta);
    		}
    		else
    		{
    			$("#meta_price").html("￥"+getMeta(<?php echo ($info["info_id"]); ?>,'price2',0));
    		}
    		return false;
    	})
    	
    	
    })
		
	</script>
	<div class="container clearfix ">
		<div class="col-md-8 column">
			<?php if(is_array($main_data)): foreach($main_data as $key=>$info): ?><div class="row">
					<div class="page-header">
						<h4 class="media-heading"><?php echo ($info["info_title"]); ?></h4>
					</div>
						<div class="col-md-4">
							<a href="#">
							<script>document.write("<img class='p_img' src='"+getMeta(<?php echo ($info["info_id"]); ?>,'pimg','/tp/Public/prod/3.jpg')+"'/>");</script>
							</a>
						</div>
						
						<div class="col-md-8">
							<ul class=" well list-group price">
							  <li class="list-group-item">
							  	<span  class="text-muted">市场价:</span><span><del>￥<script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'price1',0));</script></del></span>
							  </li>
							  <li class="list-group-item">
								<span  class="text-muted">优惠价:</span><span class="text-danger" style="font-size: 30px;" id='meta_price'>￥<script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'price2',0));</script></span>
							  </li>
							</ul>	
							<ul class="col-md-10 col-md-offset-1 list-group list-inline text-center pmeta">
								<li class="list-group-item"><span class="text-danger">月销量:</span><span>1000</span></li>
								<li class="list-group-item"><span class="text-danger">人气数:</span><span><script>document.write(getMeta(<?php echo ($info["info_id"]); ?>,'views'))</script></span></li>
							</ul>
							<ul class=" list-group list-inline text-center pmetalist" primary="1">
								<li class="list-group-item pname"><span class="text-danger">规格:</span></li>
								<script>document.write(getMetaList(<?php echo ($info["info_id"]); ?>,'ptype','tpl_ptype'));</script>
							</ul>
							<ul class=" list-group list-inline text-center pmetalist" primary="0">
								<li class="list-group-item pname"><span class="text-danger">颜色:</span></li>
								<script>document.write(getMetaList(<?php echo ($info["info_id"]); ?>,'ptype-color','tpl_ptype'));</script>
							</ul>
							<p class="text-center pbtn">
								<button class="btn btn-warning" id="cmdAddToCart"><span class="glyphicon glyphicon-shopping-cart"></span>加入购物车</button>
								<button class="btn btn-danger"><span class="glyphicon glyphicon-usd"></span>立即购买</button>			
							</p>
	
						</div>
					
				</div><?php endforeach; endif; ?>
			<script>
			function trim(str)
			{
				return str.replace("/^\s|\s*$*/g","");
			}
			function AddToCart_Animate(obj,e)
			{
									var ex=e||event;
					var img=$(".p_img").clone();
					$(img).css({position:"fixed",width:"50px",height:"50px",top:ex.clientY,left:ex.clientX,'z-index':10000})
					$(obj).parent().append(img);
					
					$(img).animate({
						top:$("#cart_set")[0].getBoundingClientRect().top,//jq获取原生对象为第一个[0]
						left:$("#cart_set")[0].getBoundingClientRect().left
					},'slow',function(){
						$(img).remove();
						var oldnum=$("#cart_num").html();
						if(oldnum=="")
						{
							oldnum=1
						}
						else
						{
							oldnum=parseInt(oldnum)+1;
						}
						$("#cart_num").html(oldnum);
					})
			}
				$("#cmdAddToCart").click(function(e){
					
					var validate=true;
					var pmeta="";
					var btn=$(this);
					$(".pmetalist").each(function(){
						if($(this).find(".choselis").length>0)
						{
							
							pmeta+=$(this).find(".choselis").find("a").attr("im_id")+'_';
							
							
						}
						else{
							validate=false;
							
						}
					})
					if(!validate)
					{
						alert("请选择完整规格");
						return false;
					}
					else
					{
						var post_data={
							pid:<?php echo ($info["info_id"]); ?>,
							pmeta:pmeta,
						}
						$.post("/tp/Home/cart/add_cart",post_data,function(result){
							if(trim(result)==-1)
							{
								self.location="/tp/Home/login?from="+encodeURIComponent(self.location);
								
							}
							else
							{
								if(trim(result)=='ok')
								{
									AddToCart_Animate(btn);
								}
								else
								{
									alert(result);
								}
							}
							
						})
					}
					

				})
			</script>
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">商品详细介绍</a></li>
		  <li role="presentation"><a href="#">商品评价</a></li>
		</ul>
		<p class="pcontent"><?php echo ($info["info_content"]); ?></p>

		</div>
			<div class="col-md-4 column">
				<?php echo W('Info/load',array(1));?>
			</div>
	</div>
	<script>
		$(".nav-tabs li").click(function(){
			$(".nav-tabs li").removeClass("active");
			$(this).addClass("active");
			return false;
		})
	</script>

<hr />
<div id="footer">
	icp备 123
</div>
	</body>
</html>