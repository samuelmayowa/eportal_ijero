<div id="layoutSidenav_nav" style="background-color:#000; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="dashboard.php">
                                Student Home DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="courseReg.php?payID=<?php echo $_SESSION['payID']; ?>">Register Courses</a>
                                    <a class="nav-link" href="#myLectures.php">Lectures</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Payments Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="payments.php?msg=SchoolFees" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        School Fees
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="payments.php?msg=SchoolFees">School Fees</a>
                                            <a target="_blank" class="nav-link" href="rrr_validate.php?msg=School Fees">Validate RRR</a>
                                            <a class="nav-link" href="payments.php?msg=CompulsoryFees">Acceptance Fees</a>
                                            <a class="nav-link" href="payments.php?msg=CertificateFees">Certicate Fees</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#checkResults.php">Check Results</a>
                                            <a class="nav-link" href="checkResults.php?id=<?php echo $email; ?>">Print Results</a>
                                            <a class="nav-link" href="#myTranscripts.php">See Grades</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Receipts</div>
                            <?php $payID= $_SESSION['payID']; ?>
                            <a class="nav-link" href="paymentHistories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                RePrint Receipts
                            </a>
                            <a class="nav-link" href="paymentHistories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Payment History
                            </a>
                            <a class="nav-link" href="myResults.php?id=<?php echo $user; ?> && em=<?php echo $email; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Check My Results
                            </a>
                            <a class="nav-link" href="clearanceForm.php?id=<?php echo $user; ?> && stdM=<?php echo $email; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Exam Clearance Form
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="Background-color:#28a745;">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION['userID'])){
                            echo $_SESSION['userID'];
                        }
                        ?>
                    </div>
                </nav>
            </div>