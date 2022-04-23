<script src="jquery.min.js"></script>                                                
<script src="jquery.js" type="text/javascript"></script>                                           
                                           <?php
include_once('../functions.php');
//require_once('../connection.php');
$MatricNumber = "";
?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Matric Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Course Title" name="MatricNumber" value=" <?php if(isset($_SESSION['userID'])){ echo $_SESSION['userID']; }  ?>"  readonly required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6"><?php echo $userPayID; ?>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="CourseCode">Courses Code</label>
                                                        <!--<input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />-->
                                                        <select name="CourseCode" class="form-control py-4" id="CourseCode" size="1">
                                                            <option value="">....Select Course Code...</option>
                                                            <?php 
                                                // Fetch Department
                                                $cc="";
                                                $sql_department = "SELECT * FROM CourseCodes";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $courseId = $row['Id'];
                                                    $cId = $row['CourseCode'];
                                                    //$cT=$row['CourseTitle'];
                                                    //$cU = $row['CourseUnits'];
                                                     $cc .="<option value='$courseId'>$cId</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $cc;
                                                ?>
                                                             </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="CourseName">Courses Name</label>
                                                 <select name="CourseName" class="form-control py-4" id="CourseName" size="1"></select></div>
                                            </div>
                                           
                                       
                                            <!--<div class="form-row">-->
                                                
                                                
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Number Of Units(</label><span style="color:red; font-size:12px;">Note: **Course Units Is The Number Before The CourseName In Bracket</span>)
                                                        <select name="courseUnits" class="form-control py-4" id="subcatsSelect" size="1" required>
                                                            <option value="0">....Select Course Unit(s)...</option>
                                                           <?php 
                                                            //getCourseCode();
                                                                        $schlID ='';

                                                            $query = "SELECT CourseUnits, CourseTitle FROM Courses";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $schlID = $schl ['CourseUnits'];
                                                               $schools = $schl ['CourseTitle'];
                                                               echo $schools .= "<option value='$schlID'>$schlID ". '  '. "($schools)</option>";}  ?>     
                                                            </select>
                                                        <!--<input class="form-control py-4" id="inputFirstName" name="CourseUnits" type="text" placeholder="Course Units"  required/>-->
                                                    </div>
                                                </div>


                                                