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
    <script src="./jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./dataTable/datatables.css" />
    <script type="text/javascript" src="./dataTable/datatables.js"></script>
    <script type="text/javascript" src="./dataTable/vfs_fonts.js"></script>
</head>

<body>

    <div class="container" style="margin-top: 100px;">
        <h1>ดึงข้อมูลจากฐานข้อมูล มาแสดงเว็บ</h1>
        <table id="mg_table" class="table  table-borderless " style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">รหัส ID</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center">ค่า PH</th>
                    <th class="text-center">วันที่</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $thaiweek = array("วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัส", "วันศุกร์", "วันเสาร์");
                $thaimonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

                $sql_search = "SELECT *,
                                                    DATE_FORMAT(rt.day, '%d') as Dd ,
                                                    DATE_FORMAT(rt.day, '%c') as month ,
                                                    DATE_FORMAT(rt.day, '%Y') as year, 
                                                    DATE_FORMAT(rt.day, '%H : %i ') as time
                                            FROM `esp8266` as rt ;";
                $i_r = 1;
                foreach (DB::query($sql_search, PDO::FETCH_OBJ) as $row) :
                    // $date = 'วันที่ '.$row->Dd.' เดือน'.$thaimonth[$row->month-1].' พ.ศ.'.$row->year+543;
                    $date = '' . $row->Dd . ' ' . $thaimonth[$row->month - 1] . ' ' . (543 + intval($row->year));;
                    $timeStart_reserv = $date . "</br> " . $row->time . ' น.';
                ?>
                    <tr>
                        <td class="text-center"><?php echo $i_r++ ?></td>
                        <td class="text-center">PH<?php echo $row->id ?></td>
                        <td class="text-center"><?php echo $row->ir == 0 ? "เติมอาหารแล้ว" : "เติมอาหารแล้ว" ?></td>
                        <td class="text-center">
                            <?php

                                if($row->pH > 7 ){
                                    echo "เบสหรือด่าง";
                                }elseif($row->pH == 7){
                                    echo "เป็นกลาง";
                                }else{
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




    <script>
        function update_mg_table() {
            $('#mg_table').DataTable({
                dom: 'lBfrtip',
                // select: true,
                lengthMenu: [
                    [10, 25, 50, 60, -1],
                    [10, 25, 50, 60, "All"]
                ],
                language: {
                    sProcessing: "กำลังดำเนินการ...",
                    sLengthMenu: "แสดง  _MENU_  แถว",
                    sZeroRecords: "ไม่พบข้อมูล",
                    sInfo: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    sInfoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
                    sInfoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
                    sInfoPostFix: "",
                    sSearch: "ค้นหา: ",
                    sUrl: "",
                    oPaginate: {
                        "sFirst": "เริ่มต้น",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "สุดท้าย"
                    }
                }, // sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                processing: true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
                //serverSide: true, // ใช้งานในโหมด Server-side processing
                // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
                retrieve: true,
                buttons: [{
                    extend: 'print',
                    text: 'พิมพ์',
                    messageTop: '',

                    filename: function() {
                        return "ประวัติการจอง "; //+hour+'-'+minutes + '-'+days +'-'+month +'-'+years
                    },
                    // title: 'รายชื่อสิทเข้าห้อง',
                    exportOptions: {
                        pageSize: 'LEGAL'
                    }
                }]
            });
        }

        update_mg_table();
    </script>
</body>

</html>