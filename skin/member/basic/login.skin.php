<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 로그인 시작 { -->



<style>


 
  	#wrap{width:100%; padding-top:100px;}
  	.content{width:497px; height:300px; margin:0 auto;}
  	.content h1{margin-bottom:10px; text-align:center;}
  	.content .login_box{width:330px; height:141px; padding:50px 0 0 165px; margin-bottom:10px; background:#eee url(../img/login_bg.png) 13px 17px no-repeat; border:1px solid #dbdbdb;}
  	.content .login_inner{overflow:hidden; width:300px; padding:10px 0; border-top:2px solid #c9c9c9; border-bottom:2px solid #c9c9c9;}
  	.content .login_inner .input{float:left; width:210px; padding-top:15px;}
  	.content .login_inner .input span{display:block; overflow:hidden; width:100%; margin-bottom:5px;}
  	.content .login_inner .input span label{float:left; display:block; width:60px;}
  	.content .login_inner .input span input{width:120px;}
  	.content .login_inner .btn_area{float:right; width:76px; margin-left:10px;}


</style>
<div id="wrap">
  <div class="content">
    <h1><img src="/img/login_h1.jpg" alt="" /></h1>
   <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
     <input type="hidden" name="url" value='<?php echo $login_url ?>'>
      <div class="login_box">
        <div class="login_inner">
          <div class="input"> <span>
            <label for="login_id">아이디</label>
            <input type="text" name="mb_id" id="mb_id" vlaue="">
            </span> <span>
            <label for="login_pw">비밀번호</label>
            <input type="password" name="mb_password" id="mb_password" vlaue="">
            </span> </div>
          <div class="btn_area">
            <input type="image"  src="/img/login_btn.png">
          </div>
        </div>
      </div>
    </form>
    <!--  			<p><img src="/img/login_logo.jpg" alt="" /></p> --> 
  </div>
</div>



<!-- } 로그인 끝 -->