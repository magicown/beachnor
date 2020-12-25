<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');


if(!$is_admin && $member['mb_level']!=9 && $member['mb_level']!=8 && $member['mb_level']!=7) alert('권한부족');

if($_POST['wr_subject']){

    $sql = " SELECT * FROM  `g5_write_a_10` WHERE `wr_subject` LIKE  '%".$_POST['wr_subject']."%'";
    echo $sql;
    $list = sql_query($sql);
    $board = sql_fetch($sql);

}


?>


    <div class="name_ss_box">
        <h1>주문처</h1>

        <div>
            <?

            if($_GET['input']){ $input_h=$_GET['input'];}else{  $input_h=$_POST['input']; }
            if($_GET['input_1']){ $input_1_h=$_GET['input_1'];}else{  $input_1_h=$_POST['input_1']; }
            if($_GET['input_2']){ $input_2_h=$_GET['input_2'];}else{  $input_2_h=$_POST['input_2']; }
            if($_GET['input_3']){ $input_3_h=$_GET['input_3'];}else{  $input_3_h=$_POST['input_3']; }
            if($_GET['input_4']){ $input_4_h=$_GET['input_4'];}else{  $input_4_h=$_POST['input_4']; }
            if($_GET['input_5']){ $input_5_h=$_GET['input_5'];}else{  $input_5_h=$_POST['input_5']; }
            if($_GET['input_6']){ $input_6_h=$_GET['input_6'];}else{  $input_6_h=$_POST['input_6']; }

            ?>


            <form id="name_ss" action="?" method="post">
                <input type="hidden" name="input" value="<?=$input_h?>">
                <input type="hidden" name="input_1" value="<?=$input_1_h?>">
                <input type="hidden" name="input_2" value="<?=$input_2_h?>">
                <input type="hidden" name="input_3" value="<?=$input_3_h?>">
                <input type="hidden" name="input_4" value="<?=$input_4_h?>">
                <input type="hidden" name="input_5" value="<?=$input_5_h?>">
                <input type="hidden" name="input_6" value="<?=$input_6_h?>">
                <input type="text" name="wr_subject" required value="<?=$_POST['wr_subject']?>" class="frm_input required">
                <input type="submit" value="검색" class="button blue">
            </form>
        </div>
        <p>회원 이름으로 검색하세요</p>


        <div class="ss_list">

            <table>
                <?
                for ($i=0; $row = sql_fetch_array($list); $i++) {

                    ?>

                    <tr><td><a href="javascript:;" onclick="find_zip('<?=$row['wr_subject']?>')"><?=$row['wr_subject']?></a></td></tr>
                <? }?>

                <?
                if(!$board['wr_subject']){
                    ?>

                    <td>검색된 주문처가 없습니다.</td>
                <? }?>

            </table>
        </div>
    </div>

    <script type="text/javascript">
        function find_zip(a)
        {
            var of = opener.document.fwrite;

            of.wr_subject.value  = a;
            window.close();
            return false;
        }
    </script>



<?
include_once(G5_PATH.'/tail.sub.php');
?>