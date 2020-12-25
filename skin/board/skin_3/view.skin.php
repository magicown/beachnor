<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<style>
#box_view{ width:980px; margin:0 auto;  position: relative;}
.tbl_wrap{ margin-top:20px}
</style>


<!-- 게시물 읽기 시작 { -->

<div id="box_view">
<!--<div id="bo_v_table">--><?php //echo $board['bo_subject']; ?><!--</div>-->


<div class="tbl_frm01 tbl_wrap">
 
 
 
   <table>
        <tbody>
          <tr>
            <th scope="row">상품코드</th>
            <td><?php echo $view['wr_1'] ?></td>
          </tr>
          
           <tr>
            <th scope="row">상품분류</th>
            <td class="wr_content"><?php echo $view['wr_subject'] ?></td>
          </tr>
          
          
        
          <tr>
            <th scope="row">상품명</th>
            <td><?php echo $view['wr_2'] ?></td>
          </tr>
          
            <tr>
            <th scope="row">가격</th>
            <td class="wr_content">
         <?php echo $view['wr_3'] ?>
            
         
         </td>
          </tr>
          
          
          <tr>
            <th scope="row">공장거래처</th>
            <td>
			 
            <?php echo $view['wr_5'] ?>
            
            </td>
          </tr>
          <tr>
            <th scope="row">상태</th>
            <td>
        <?php echo $view['ca_name'] ?>
        
            
            </td>
          </tr>
          
          
 
 
          
          
          
           
        </tbody>
      </table>
 
</div>

<div id="bo_v_top">
 <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01 button black">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01 button black" onclick="del(this.href); return false;">삭제</a></li><?php } ?> 
 
            <li><a href="<?php echo $list_href ?>" class="btn_b01 button black">목록</a></li>
           
            <?php if ($write_href&&$member['mb_level']!=7) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 button black">등록하기</a></li><?php } ?>
        </ul>
        </div>
</div>