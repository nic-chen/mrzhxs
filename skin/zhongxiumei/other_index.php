<div class="hy_body_frame">
    <div class="hualang_body_frame">
        <ul class="top"> <li class="top_left"></li><li class="top_center"></li><li class="top_right"></li> </ul>
            <div class="body">
            <?php
            $class = $_GET["classs"];
            
                $Customer = new Customer;
                $class = $_GET["classs"];
                if ($class=="合作画廊")
                {
                    $type = "hualang";
                    include("other_hualang.php");
                }
                else if ($class=="合作拍卖")
                {
                    $type = "paimai";
                    include("other_paimai.php");
                }
				else if ($class=="会员展厅")
                {
                    $type = "huiyuan";
                    include("other_huiyuan.php");
                }
                else
                    $type = "";
            ?>
            </div>
        <ul class="bottom"> <li class="bottom_left"></li><li class="bottom_center"></li><li class="bottom_right"></li> </ul>
    </div>
</div>
