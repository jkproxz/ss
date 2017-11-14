<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="avatar"/>
        <input type="submit" name="uploadclick" value="Upload"/>
    </form>
    <?php // Xử Lý Upload
  
    // Nếu người dùng click Upload
    if (isset($_POST['uploadclick']))
    {
        // Nếu người dùng có chọn file để upload
        if (isset($_FILES['avatar']))
        {
            // Nếu file upload không bị lỗi,
            // Tức là thuộc tính error > 0
            if ($_FILES['avatar']['error'] > 0)
            {
                echo 'File Upload Bị Lỗi';
            }
            else{

                move_uploaded_file($_FILES['avatar']['tmp_name'], $_FILES['avatar']['name']);
                echo 'File Uploaded';
				$q = end(explode('.',$_FILES['avatar']['name']));
				if ($q == 'zip') {
$zip = new ZipArchive;
$res= $zip->open($_FILES['avatar']['name']);
if ($res==TRUE) { 
$zip->extractTo('../src/');
$zip->close();

echo 'Thành Công';
} else {
echo 'không thành công';
}
}
            }
        }
        else{
            echo 'Bạn chưa chọn file upload';
        }
    }
	echo '<br>';
	$files_and_folder = glob('../src/*');
print_r($files_and_folder);
?>
</body>
</html>
