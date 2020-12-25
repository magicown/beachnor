<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}


?>

<!-- 상단 시작 { -->

<div id="hd">
  <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
  <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
  <div id="hd_wrapper">
    <div id="logo"> <a href="<?php echo G5_URL ?>">비치노아</a> </div>
    
    
    
    <ul id="tnb">
    <li><span class="mb_n"><?=$member['mb_name']?>(<?=$member['mb_id']?>) - <?=level_txt($member['mb_level']);?></span></li>
      <li><a href="/">홈</a></li>
      
      <?  if($member['mb_level']!="8" && $member['mb_level']!="7"){?>      
      <li><a href="/print_a_1.php" target="_blank">파견인력 현황 보고서</a></li>
      <li><a href="/print_a_1_lev7.php" target="_blank">지점 인력파견현황</a></li>
       <li><a href="/print_a_5.php" target="_blank">지점별 정산 현황 보고서</a></li>
       <? }?>
       <li><a href="/bbs/content.php?co_id=provision">이용안내</a></li>
       
      <?
      if($is_member){
	  ?>
      <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
      <? }else{?>
      <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
      
      <? }?>
      <?php /*?><li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li><?php */?>
      
      <?php if ($is_admin || $member['mb_level']==7) {  ?>
      <li><a href="<?php echo G5_ADMIN_URL ?>" target="_blank"><b style="color:#FF0000">회원관리</b></a></li>
      <?php }  ?>
    </ul>
  
  </div>
  <hr>
  
  <?
  if($bo_table=="a_1"){
	  $sty_1 = "menu_on";
	  //if($member['mb_level']!="9" && !$is_admin) alert('접근권한이 없습니다.');
	  
  }
  if($bo_table=="a_2"){
	  $sty_2 = "menu_on";
	  
  }
  
   if($bo_table=="a_3"){
	  $sty_3 = "menu_on";
	  
  }
  
  if(
 // $_SERVER['PHP_SELF']=="/bbs/memo.php" || 
 //// $_SERVER['PHP_SELF']=="/bbs/memo_view.php" ||
 // $_SERVER['PHP_SELF']=="/bbs/memo_form.php"
 $bo_table=="a_8" 
  ){
	   $sty_4 = "menu_on";
	  
  }
 
 
  if($bo_table=="a_6"){
	  $sty_5 = "menu_on";
	  
  }
  
   if($bo_table=="a_7"){
	  $sty_6 = "menu_on";
	  
  }
  
   if($_SERVER['PHP_SELF']=="/lev8_list.php"){
	  $sty_7 = "menu_on";
	  
  }
  
    if($bo_table=="a_5"){
	  $sty_8 = "menu_on";
	  
  }
  ?>
  <div class="container">
    <ul id="nav">
    
      <li><a href="/bbs/board.php?bo_table=a_1" class="<?=$sty_1?>">주문현황</a></li>
     
      <?php /* 서브메뉴필요할때?><li><a href="#s1">상품목록</a>
			<span id="s1"></span>
			<ul class="subs">
				<li><a href="#">Header a</a>
					<ul>
						<li><a href="#">Submenu x</a></li>
						<li><a href="#">Submenu y</a></li>
						<li><a href="#">Submenu z</a></li>
					</ul>
				</li>
				<li><a href="#">Header b</a>
					<ul>
						<li><a href="#">Submenu x</a></li>
						<li><a href="#">Submenu y</a></li>
						<li><a href="#">Submenu z</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li class="active"><a href="#s2">Menu 2</a>
			<span id="s2"></span>
			<ul class="subs">
				<li><a href="#">Header c</a>
					<ul>
						<li><a href="#">Submenu x</a></li>
						<li><a href="#">Submenu y</a></li>
						<li><a href="#">Submenu z</a></li>
					</ul>
				</li>
				<li><a href="#">Header d</a>
					<ul>
						<li><a href="#">Submenu x</a></li>
						<li><a href="#">Submenu y</a></li>
						<li><a href="#">Submenu z</a></li>
					</ul>
				</li>
			</ul>
		</li><?php */?>
        
      <? if($member['mb_level']!="8"){?>
      <li><a href="/bbs/board.php?bo_table=a_3"  class="<?=$sty_3?>">상품</a></li>
      <? }?>
	   
	   <? if($member['mb_level']!="7"){?> 
      <li><a href="/bbs/board.php?bo_table=a_2"  class="<?=$sty_2?>">유통거래처</a></li>
      <? }?>
      
      <? if($member['mb_level']=="7" || $is_admin){?>
      <li><a href="/bbs/board.php?bo_table=a_5"  class="<?=$sty_8?>">공장거래처</a></li>
      <? }?>
      
      <li><a href="/bbs/board.php?bo_table=a_8" class="<?=$sty_4?>">1:1업무게시판</a></li>
      <li><a href="/bbs/board.php?bo_table=a_7" class="<?=$sty_6?>">공지사항</a></li>
      <li><a href="/bbs/board.php?bo_table=a_6" class="<?=$sty_5?>">자료실</a></li>
      <?
      if($member['mb_level']==10){
	  ?>
      <li><a href="/lev8_list.php" class="<?=$sty_7?>">배송업체</a></li>
      <?
	  }
	  ?>
    </ul>
  </div>
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">


<div id="container">
<?php if ((!$bo_table || $w == 's' ) && !defined("_INDEX_")) { ?>

<div id="container_title"><?php echo $g5['title'] ?></div>

<?php } ?>
