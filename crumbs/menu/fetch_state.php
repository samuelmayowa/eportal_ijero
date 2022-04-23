<?php


require("configure.php");
/*$country_id = ($_REQUEST["CourseCode"] != "") ? trim($_REQUEST["CourseCode"]) : "";
if ($country_id != "") {
    $sql = "SELECT CourseID, CourseTitle FROM Courses WHERE CourseCode =". $_REQUEST["CourseCode"]." ORDER BY CourseTitle";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":CourseCodes", trim($country_id));
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo($ex->getMessage());
    }
    if (count($results) > 1) {
        ?>
        <label>State: 
            <select name="state" onchange="showCity(this);">
                <option value="">Please Select</option>
                <?php foreach ($results as $rs) { ?>
                    <option value="<?php echo $rs["CourseCode"]; ?>"><?php echo $rs["CourseTitle"]; ?></option>
                <?php } ?>
            </select>
        </label>
        <?php
    }
}*/
?>
<?php
/*requre(connection.php);*/
$DB="";

	if(isset($_POST['CourseCode']) && !empty($_POST['CourseCode'])){
		//Get All Data 
$query = $db->query("SELECT CourseID,  CourseTitle FROM Courses  WHERE CourseCode=" . $_POST['CourseID']."ORDERBY CourseTitle ASC");

// Count Total Rows
$rowCount = $query->num_rows;
//Dislay Course Name 
	if($rowCount >0){
echo '<option value="">Select CourseCode</option>';
while($row=$query->fetch_assoc()){
echo '<option value="'.$row['CourseID']. '">'.$row['CourseTitle']. '</option>';
		}
	} else {
	echo '<option value=""> CourseName Not Selected </option>';
	    
	}
		}
	
// get Course Units

if(isset($_POST['CourseID']) && !empty($_POST['CourseID'])){
		//Get All Data 
$query = $db->query($con,"SELECT CourseID, CourseUnits FROM Courses  WHERE CourseCode=" . $_POST['CourseCode']."ORDERBY CourseTitle ASC");

// Count Total Rows
$rowCount = $query->num_rows;
//Dislay Course Name 
	if($rowCount >0){
echo '<option value="">Select CourseCode</option>';
while($row=$query->fetch_assoc()){
echo '<option value="'.$row['CourseCodes']. '">'.$row['CourseUnits']. '</option>';
		}
	}
	    else {
	echo '<option value=""> CourseName Not Selected </option>';
	        
	    }
		}
	
?>