<form enctype="multipart/form-data" method="post" role="form" action="getBioData.php">
                        <div class="form-group">
                                 <label for="exampleInputFile">File Upload</label>
                                 <input type="file" name="file" id="file" size="150">
                                <p class="help-block">
                                        Only Excel/CSV File Import.
                                </p>
                        </div>
                         <button type="submit" class="btn btn-default" name="Import" value="Import">Upload</button>
                    </form>
                    
                    <?php 
if(isset($_POST["Import"]))
{
//First we need to make a connection with the database
$host='localhost'; // Host Name.
$db_user= 'escohsti_portalAdmin'; //User Name
$db_password= 'IT;manager';
$db= 'escohsti_studentPortal'; // Database Name.

$conn=mysqli_connect($host,$db_user,$db_password) or die (mysqli_error($conn));
mysqli_select_db($conn,$db) or die (mysqli_error($conn));

echo $filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
{

$file = fopen($filename, "r");
//$sql_data = "SELECT * FROM students";
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)

{
//print_r($emapData);
//exit();

$sql = "INSERT into students(matricNumber, firstName, lastname,faculty, department) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]')";
mysqli_query($sql,$conn) or die(mysqli_eror($conn));
}
fclose($file);
echo 'CSV File has been successfully Imported';
header('Location: index.php');
}
else
echo 'Invalid File:Please Upload CSV File';

}
?>