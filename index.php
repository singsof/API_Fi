<!DOCTYPE html>
<html lang="en">
<?php
include("./config/connectdb.php");
?>

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>แสดงข้อมูลจากฐานข้อมูล</title>


    <link rel="stylesheet" href="./bootstrap.css">
</head>

<body>

    <?php

    $key = isset($_GET["key"]) ? $_GET["key"] : null;

    if ($key == "lGE85ehip") {
        $start = isset($_GET["start"]) ? $_GET["start"] : null;
        $end = isset($_GET["end"]) ? $_GET["end"] : null;

        $sql_search = "SELECT *,
                            DATE_FORMAT(rt.day, '%d') as Dd ,
                            DATE_FORMAT(rt.day, '%c') as month ,
                            DATE_FORMAT(rt.day, '%Y') as year, 
                            DATE_FORMAT(rt.day, '%H : %i ') as time
                        FROM `esp8266` as rt INNER JOIN ir  ON ir.id_ir = rt.id_ir WHERE  rt.day BETWEEN '{$start}' AND '{$end}' ";
    } else {

        $sql_search = "SELECT *,
                            DATE_FORMAT(rt.day, '%d') as Dd ,
                            DATE_FORMAT(rt.day, '%c') as month ,
                            DATE_FORMAT(rt.day, '%Y') as year, 
                            DATE_FORMAT(rt.day, '%H : %i ') as time
                        FROM `esp8266` as rt INNER JOIN ir  ON ir.id_ir = rt.id_ir";
    }
    ?>

    <div class="container" style="margin-top: 100px;">
        <h1>ดึงข้อมูลจากฐานข้อมูล มาแสดงเว็บ</h1>
        <div class="row">
            <div class="col-md-6">
                <h4 class="control-label">วันที่เริ่มต้น</h4>
            </div>
            <div class="col-md-6">
                <h4 class="control-label">ถึงวันที่</h4>
            </div>
        </div>
        <form name="form-date" action="./index.php" method="GET">
            <div class="input-group mb-3">

                <input type="date" class="form-control" name="start" value="<?php echo $key != null ? $start :  "" ?>" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <input type="date" class="form-control" name="end" value="<?php echo $key != null? $end :  date("Y-m-d") ?>" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" name="key" value="lGE85ehip" type="submit">ค้นหา</button>
                </div>



            </div>
        </form>
        <table id="mg_table" class="table  table-borderless " style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center">ค่า PH</th>
                    <th class="text-center">วันที่</th>
                </tr>
            </thead>
            <tbody>
                <?php




                $thaiweek = array("วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์");
                $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];


                $i_r = 1;
                foreach (DB::query($sql_search, PDO::FETCH_OBJ) as $row) :
                    // $date = 'วันที่ '.$row->Dd.' เดือน'.$thaimonth[$row->month-1].' พ.ศ.'.$row->year+543;
                    $date = '' . $row->Dd . ' ' . $thaimonth[$row->month - 1] . ' ' . (543 + intval($row->year));;
                    $timeStart_reserv = $date . "</br> " . $row->time . ' น.';
                ?>
                    <tr>
                        <td class="text-center"><?php echo $i_r++ ?></td>
                        <td class="text-center"><?php echo $row->ir?></td>
                        <td class="text-center">
                            <?php

                            if ($row->pH > 7) {
                                echo "เบสหรือด่าง";
                            } elseif ($row->pH == 7) {
                                echo "เป็นกลาง";
                            } else {
                                echo "กรด";
                            }

                            ?>
                        </td>
                        <td class="text-center">
                            <?php echo $timeStart_reserv ?>
                        </td>
                    </tr>

                <?php
                endforeach;
                ?>
            </tbody>
        </table>

    </div>


</body>

</html>