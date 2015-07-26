<meta charset='utf8' />
<?php
//$ch = curl_init();
////$page = $_GET['p'];
////$departmentID = $_GET['department_id'];
////$positionID = $_GET['position_id'];
//$file_path = realpath('./api.docx');
////$s = $_GET['s'];
//$postData = array(
//    'key' => 'MTQzMDcyMTM5M1BFUlNPTk5FT',
//    'type' => 'location',
//    'action' => 'add',
//    'job_code' => '473',
//    'phone' => '123456',
//    'name'=>'abc',
//    'position_id' => $positionID,
//    'department_id' => $departmentID,
//    'file_contents' => "@" . $file_path
//);
//curl_setopt_array($ch, array(
//    CURLOPT_URL => 'http://cellphones.1office.vn/Api/Recruiment/Candidate/Index',
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_POST => true,
//    CURLOPT_POSTFIELDS => $postData,
//    CURLOPT_FOLLOWLOCATION => true
//));
//$output = curl_exec($ch);
//$data = json_decode($output, 1);
//$posts = $data['posts'];
?>
<html>
<body>
<form action="http://localhost/Offices/Test/index.php" method="GET" style="margin-left: 550px;">
    <input type="text" name="s">
    <input type="submit" value="Tìm kiếm">
</form>
<table>
    <tr>
        <th>
            Mã TD
        </th>
        <th>
            Tiêu đề
        </th>
        <th>
            Vị trí
        </th>
        <th>
            Phòng ban
        </th>
        <th>
            Số điện thoại
        </th>
    </tr>
    <?php foreach ($posts as $key => $v): ?>
        <tr>
            <td>
                <?php echo $v['code']; ?>
            </td>
            <td>
                <?php echo $v['title']; ?>
            </td>
            <td>
                <?php echo "<a href='http://localhost/Offices/Test/index.php?position_id=" . $v['position_id'] . "'>" . $v['position_title'] . "</a>"; ?>
            </td>
            <td>
                <?php echo "<a href='http://localhost/Offices/Test/index.php?department_id=" . $v['department_id'] . "'>" . $v['department_title'] . "</a>"; ?>
            </td>
            <td>
                <?php echo $v['phone']; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="http://localhost/Offices/Test/index.php?p=1" style="margin-right: 50px;" id="page">Pre</a><a href="http://localhost/Offices/Test/index.php?p=2">Next</a>
</body>
<style>
    td{border: solid 1px}
    table{width: 800px;margin: 0 auto}
    #page{margin-left: 600px;}
</style>
</html>

