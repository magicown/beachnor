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
<!--<div id="bo_v_table"><?php /*echo $board['bo_subject']; */?></div>-->

    <!-- 게시판 목록 시작 { -->
    <div id="bo_list" style="width:<?php echo $width; ?>">

        <!-- 게시판 카테고리 시작 { -->
        <?php if ($is_category) { ?>
            <nav id="bo_cate">
                <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
                <ul id="bo_cate_ul">
                    <?php echo $category_option ?>
                </ul>
            </nav>
        <?php } ?>
        <!-- } 게시판 카테고리 끝 -->

        <div class="sso">
            <a href="javascript:;" onclick="dis('bo_fx');">검색</a>
        </div>
<div class="tbl_frm01 tbl_wrap">
 
 
 
   <table>
        <tbody>
          <tr>
            <th scope="row"><label for="wr_subject">거래처명<strong class="sound_only">필수</strong></label></th>
            <td><?php echo $view['wr_subject'] ?></td>
          </tr>
          
           <tr>
            <th scope="row">대표자명</th>
            <td class="wr_content"><?php echo $view['wr_1'] ?></td>
          </tr>


          <tr>
              <th scope="row"><label for="wr_link1">사업자등록번호</label></th>
              <td><?php echo $view['wr_3'] ?></td>
          </tr>
          <tr>
            <th scope="row"><label for="wr_link1">담당자명</label></th>
            <td><?php echo $view['wr_2'] ?></td>
          </tr>
          
            <tr>
            <th scope="row">전화번호</th>
            <td class="wr_content">
         <?php echo $view['wr_4'] ?>
            
         
         </td>
          </tr>
          
          
          <tr>
            <th scope="row">휴대폰번호</th>
            <td>
			 
            <?php echo $view['wr_5'] ?>
            
            </td>
          </tr>
          <tr>
            <th scope="row">주소</th>
            <td>
        <?php echo $view['wr_14']." ".$view['wr_15'] ?>
        
            
            </td>
          </tr>

          <tr>
            <th scope="row">계약일</th>
            <td>
        <?php echo $view['wr_5'] ?>
        
            
            </td>
          </tr>

          <tr>
            <th scope="row">비고</th>
            <td>
        <?php echo $view['wr_6'] ?>
        
            
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
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01  button black">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01 button black" onclick="del(this.href); return false;">삭제</a></li><?php } ?> 
 
            <li><a href="<?php echo $list_href ?>" class="btn_b01 button black">목록</a></li>
           
            <?php if ($write_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 button black">등록하기</a></li><?php } ?>
        </ul>
        </div>
</div>