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
<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>



<div class="tbl_frm01 tbl_wrap">
      <table>
        <tbody>
          
            <tr>
            <th scope="row">성명</th>
            <td class="wr_content">
            <?=$view['wr_subject']?>
         </td>
          </tr>
          
             <tr>
            <th scope="row">성별</th>
            <td>
            
            <?php
			
			if($view['wr_content']=="M"){
				echo "남";
			}else{
				
				echo "여";
			}
			
			
			 ?>
            
            </td>
          </tr>
          
          
          
          
            <tr>
            <th scope="row">연령</th>
            <td>
            
            <?=$view['wr_link1']?>
            
            </td>
          </tr>
          
          
          
          
          
          
          
           <tr>
            <th scope="row">기관(업체)</th>
            <td class="wr_content">
            <?=$view['wr_1']?>
            
            </td>
          </tr>
          
          
          
       
          
          
          
           <tr>
            <th scope="row">지역</th>
            <td>
            <?=$view['wr_homepage']?>
           </td>
          </tr>
          
          
          
        
          <tr>
            <th scope="row">업무</th>
            <td>
             <?=$view['wr_2']?>
            
           
           </td>
          </tr>
          
          
          
          
          <tr>
            <th scope="row">파견일</th>
            <td>
            
             <?=$view['wr_3']?>
			
            
            
            </td>
          </tr>
          
          
           <tr>
            <th scope="row">파견종료일</th>
            <td>
            
            <?=$view['wr_4']?>
            
      
      
            
            </td>
          </tr>
          
          
          
     
          
          
          
          <tr>
            <th scope="row">상태</th>
            <td>
            
            
            <?=$view['ca_name']?>
            
    
    
            
            </td>
          </tr>
           
        </tbody>
      </table>
    </div>
    
    

<div id="bo_v_top">
 <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?> 
 
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
           
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        </div>
</div>