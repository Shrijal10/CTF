<div class="row hackerFont">
            <div class="col-md-12">
                    <h4>Welcome</h4>
</div>
                    <div class="col-md-4 mb-3">
    <div class="card category">
        <div class="card-header <?php echo getchallengeColor($conn, 33, $userprofile);?>" id="challenge_id33" data-challenge-id="33" data-target="#problem_id_33" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_33">
            welcome<br><span class="badge align-self-end"><?php echo dalpoints($conn, 50, 33); ?></span>
        </div>
        <div id="problem_id_33" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                    <h6 class="solvers challenge_<?php echo $challengeId33; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 33, $flag,$teamName); ?></span><br><span class="color_blue challenge_<?php echo $challengeId33; ?>"> </span></h6>
                </div>
                <p>Some where in about, Read carefully and submit the flag.</p>
                <form action="" method="POST" autocomplete="off">
                    <div class="input-group mt-3">
                        <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge33_solved']) || strpos(getchallengeColor($conn, 33, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="33">
                            <input type="submit" class="btn btn-outline-secondary" value="Go!" name="login" id="submit"<?php echo (isset($_COOKIE['challenge33_solved']) || strpos(getchallengeColor($conn, 33, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 33) {
            $pointsToAdd = 50;
            $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
            $resultCount = mysqli_query($conn, $queryCount);
            
    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    
    handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
?>
                </form>          
                         </blockquote>
                    </div>
                </div>
            </div>
                <div class="col-md-12">
                    <h4>Web</h4>
</div>
<div class="col-md-4 mb-3">
    <div class="card category_web">
        <div class="card-header <?php echo getchallengeColor($conn, 1, $userprofile);?>" id="challenge_id1" data-challenge-id="1" data-target="#problem_id_1" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_1">
            src<br><span class="badge align-self-end"><?php echo getpoints($conn, 100, 1, 'Easy'); ?></span>
        </div>
        <div id="problem_id_1" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                    <h6 class="solvers challenge_<?php echo $challengeId1; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 1, $flag,$teamName); ?></span><br><span class="color_blue challenge_<?php echo $challengeId1; ?>">Difficulty:<?php echo getDifficulty($conn, 1); ?></span></h6>
                </div>
                <p>Find the Flag
                    <!-- <span id="dots">...</span><span id="more" style="display: none;">erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span>
                <button onclick="openPopup()" id="myBtn" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
            </p>
<div id="popup" class="popup">
    <span id="popupContent"></span>
    <button onclick="closePopup()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
<script>
    function openPopup() {
        var moreText = document.getElementById("more");
        var popup = document.getElementById("popup");
        var popupContent = document.getElementById("popupContent");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }

    function closePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }
</script>
                <a target="_blank" href="http://192.168.174.1:2000/" class="btn btn-outline-secondary"><span class="mr-2"></span>Link</a>
                <form action="" method="POST" autocomplete="off">
                    <div class="input-group mt-3">
                        <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge1_solved']) || strpos(getchallengeColor($conn, 1, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="1">
                            <input type="submit" class="btn btn-outline-secondary" value="Go!" name="login" id="submit"<?php echo (isset($_COOKIE['challenge1_solved']) || strpos(getchallengeColor($conn, 1, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 1) {
            $pointsToAdd = 100;
            $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
            $resultCount = mysqli_query($conn, $queryCount);
            if ($resultCount) {
            $row = mysqli_fetch_assoc($resultCount);
            $numTeamsSolved = $row['num_teams_solved'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }
    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    
    handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
?>
                </form>          
                         </blockquote>
                    </div>
                </div>
            </div>
            <!-- 2nd -->
            <div class="col-md-4 mb-3">
    <div class="card category_web">
        <div class="card-header <?php echo getchallengeColor($conn, 2, $userprofile);?>" id="challenge_id2" data-challenge-id="2" data-target="#problem_id_2" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_2">
        Obfuscation<br><span class="badge align-self-end"><?php echo getpoints($conn,150,2,'Medium'); ?></span>
        </div>
        <div id="problem_id_2" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                <h6 class="solvers challenge_<?php echo $challengeId2; ?>">Solvers: <span class="solver_num" id="solvers">
                <?php
                solvers($conn, 2, $flag,$teamName); 
    ?>
</span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId2; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 2); ?></span></h6>
                </div>
                <p> Find the Flag
                <!-- <span id="dots">...</span><span id="more1" style="display: none;">ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span>
                <button onclick="openPopup1()" id="myBtn1" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button></p> -->
            </p>
<div id="popup1" class="popup">
    <span id="popupContent1"></span>
    <button onclick="closePopup1()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup1() {
        var moreText = document.getElementById("more1");
        var popup = document.getElementById("popup1");
        var popupContent = document.getElementById("popupContent1");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup1() {
        var popup = document.getElementById("popup1");
        popup.style.display = "none";
    }
</script>
                <a target="_blank" href="http://192.168.174.1:3000/" class="btn btn-outline-secondary"><span class="mr-2"></span>Link</a>
                <div class="input-group mt-3">
                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge2_solved']) || strpos(getchallengeColor($conn, 2, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="2">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge2_solved']) || strpos(getchallengeColor($conn,2, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 2) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']);
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                </form>
            </blockquote>
        </div>
    </div>
</div>              
                 <div class="col-md-4 mb-3">
                    <div class="card category_web">
                        <div class="card-header <?php echo getchallengeColor($conn, 3, $userprofile);?>" id="challenge_id3" data-target="#problem_id_3" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_3">
                        Agent's Request <br><span class="badge align-self-end"><?php echo getpoints($conn,150,3,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_3" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId3; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 3, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId3; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 3); ?></span></h6>
                                </div>
                                <p> Chase the agent to find the flag 
                                    <!-- <span id="dots">...</span><span id="more2" style="display: none;">Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span>
                <button onclick="openPopup2()" id="myBtn2" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button></p> -->
            </p>
<div id="popup2" class="popup">
    <span id="popupContent2"></span>
    <button onclick="closePopup2()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup2() {
        var moreText = document.getElementById("more2");
        var popup = document.getElementById("popup2");
        var popupContent = document.getElementById("popupContent2");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup2() {
        var popup = document.getElementById("popup2");
        popup.style.display = "none";
    }
</script>
                        <a target="_blank" href="http://192.168.174.1:4000/" class="btn btn-outline-secondary"><span class="mr-2"></span>Link</a>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge3_solved']) || strpos(getchallengeColor($conn, 3, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="3">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge3_solved']) || strpos(getchallengeColor($conn, 3, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 3) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_web">
                        <div class="card-header <?php echo getchallengeColor($conn, 4, $userprofile);?>" id="challenge_id4" data-target="#problem_id_4" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_4">
                        Tuff JWT <br><span class="badge align-self-end"><?php echo getpoints($conn,200,4,'Hard'); ?></span>
                        </div>
                        <div id="problem_id_4" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId4; ?>">Solvers: <span class="solver_num"><?php
                solvers($conn, 4, $flag,$teamName); 
    ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId4; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 4); ?></span></h6>
                                </div>
                                <p> Find the Flag
                                <!-- <span id="dots">...</span><span id="more3" style="display: none;">sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span>
                <button onclick="openPopup3()" id="myBtn3" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button></p> -->
            </p>
<div id="popup3" class="popup">
    <span id="popupContent3"></span>
    <button onclick="closePopup3()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup3() {
        var moreText = document.getElementById("more3");
        var popup = document.getElementById("popup3");
        var popupContent = document.getElementById("popupContent3");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup3() {
        var popup = document.getElementById("popup3");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="http://192.168.174.1:5000/" class="btn btn-outline-secondary"><span class="mr-2"></span>Link</a>
                                </p>
                                <script type="text/javascript">
                    document.getElementById("readmore2").onclick = function() {
                        var popup = window.open('','popUpWindow', 'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');
                        popup.document.write("<p>This password is the password of the admin of the Talakunchi CTF server.<br>Please use this password with caution2.</p>");
                        popup.document.close();
                    };
                </script>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge4_solved']) || strpos(getchallengeColor($conn, 4, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="4">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge4_solved']) || strpos(getchallengeColor($conn, 4, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 4) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                                </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <!-- <div class="row hackerFont"> -->
                <div class="col-md-12">
                    <h4>Cryptography</h4>
</div>
                <div class="col-md-4 mb-3">
                    <div class="card category_crypt">
                        <div class="card-header <?php echo getchallengeColor($conn, 5, $userprofile);?>" id="challenge_id5" data-target="#problem_id_5" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_5">
                            Symbolic Decimals <br><span class="badge align-self-end"><?php echo getpoints($conn,100,5,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_5" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId5; ?>">Solvers: <span class="solver_num"><?php
                solvers($conn, 5, $flag, $teamName); 
    ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId4; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 5); ?></span></h6>
                                </div>
                                <p> Did you know that you can hide messages with symbols? For example, "!@#$%^&*(" is "123456789"
                                <!-- <span id="dots">...</span><span id="more4" style="display: none;">In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span>
                <button onclick="openPopup4()" id="myBtn4" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup4" class="popup">
    <span id="popupContent4"></span>
    <button onclick="closePopup4()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup4() {
        var moreText = document.getElementById("more4");
        var popup = document.getElementById("popup4");
        var popupContent = document.getElementById("popupContent4");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup4() {
        var popup = document.getElementById("popup4");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/Symbolic%20Decimal.zip?csf=1&web=1&e=TWYaMh" class="btn btn-outline-secondary"><span class="fa fa-download mr-4"></span>Download</a>
                                </p>
                                <script type="text/javascript">
                    document.getElementById("readmore3").onclick = function() {
                        var popup = window.open('','popUpWindow', 'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');
                        popup.document.write("<p>This password is the password of the admin of the Talakunchi CTF server.<br>Please use this password with caution3.</p>");
                        popup.document.close();
                    };
                </script>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge5_solved']) || strpos(getchallengeColor($conn, 5, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="5">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge5_solved']) || strpos(getchallengeColor($conn, 5, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 5) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                                </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_crypt">
                        <div class="card-header <?php echo getchallengeColor($conn,6, $userprofile);?>" id="challenge_id6" data-target="#problem_id_6" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_6">
                        1992 born <br> <span class="badge align-self-end"><?php echo getpoints($conn,100,6,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_6" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId6; ?>">Solvers: <span class="solver_num"><?php
                solvers($conn, 6, $flag,$teamName); 
    ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId6; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 6); ?></span></h6>
                                </div>
                                <p> I Was born in 1992 .. ! Can you decode me?
                                    <!-- <span id="dots">...</span><span id="more5" style="display: none;">In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup5()" id="myBtn5" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup5" class="popup">
    <span id="popupContent5"></span>
    <button onclick="closePopup5()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup5() {
        var moreText = document.getElementById("more5");
        var popup = document.getElementById("popup5");
        var popupContent = document.getElementById("popupContent5");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup5() {
        var popup = document.getElementById("popup5");
        popup.style.display = "none";
    }
</script>
<a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/1992%20Born.zip?csf=1&web=1&e=hLMEQ5" class="btn btn-outline-secondary"><span class="fa fa-download mr-4"></span>Download</a>    
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge6_solved']) || strpos(getchallengeColor($conn, 6, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="6">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge6_solved']) || strpos(getchallengeColor($conn, 6, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 6) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                                </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
            <div class="col-md-4 mb-3">
    <div class="card category_crypt">
        <div class="card-header <?php echo getchallengeColor($conn, 7, $userprofile);?>" id="challenge_id7" data-challenge-id="7" data-target="#problem_id_7" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_7">
        BrainF <br><span class="badge align-self-end"><?php echo getpoints($conn, 100, 7, 'Easy'); ?></span>
        </div>
        <div id="problem_id_7" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                    <h6 class="solvers challenge_<?php echo $challengeId7; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 7, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId7; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 7); ?></span></h6>
                </div>
                <p>I don't know why but number 47 is getting into my brain.
                    <!-- <span id="dots">...</span><span id="more6" style="display: none;"> at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup6()" id="myBtn6" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup6" class="popup">
    <span id="popupContent6"></span>
    <button onclick="closePopup6()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup6() {
        var moreText = document.getElementById("more6");
        var popup = document.getElementById("popup6");
        var popupContent = document.getElementById("popupContent6");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup6() {
        var popup = document.getElementById("popup6");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/BrainF.zip?csf=1&web=1&e=RXCroe" class="btn btn-outline-secondary"><span class="fa fa-download mr-4"></span>Download</a>
                                </p>
                <form action="" method="POST" autocomplete="off">
                    <div class="input-group mt-3">
                    <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge7_solved']) || strpos(getchallengeColor($conn, 7, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="7">
                            <input type="submit" class="btn btn-outline-secondary" value="Go!" name="login" id="submit"<?php echo (isset($_COOKIE['challenge1_solved']) || strpos(getchallengeColor($conn, 7, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 7) {
            $pointsToAdd = 100;
            $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
            $resultCount = mysqli_query($conn, $queryCount);
            if ($resultCount) {
            $row = mysqli_fetch_assoc($resultCount);
            $numTeamsSolved = $row['num_teams_solved'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }
    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    
    handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
?>
                </form>          
                         </blockquote>
                    </div>
                </div>
            </div>
                <div class="col-md-4 mb-3">
    <div class="card category_crypt">
        <div class="card-header <?php echo getchallengeColor($conn, 8, $userprofile);?>" id="challenge_id8" data-challenge-id="8" data-target="#problem_id_8" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_8">
        Hexagon<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,8,'Easy'); ?></span>
        </div>
        <div id="problem_id_8" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                <h6 class="solvers challenge_<?php echo $challengeId8; ?>">Solvers: <span class="solver_num" id="solvers">
                <?php
                solvers($conn, 8, $flag,$teamName); 
    ?>
</span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId8; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 8); ?></span></h6>
                </div>
                <p> Decode and you will come to know how easy it was.....
                    <!-- <span id="dots">...</span><span id="more7" style="display: none;">In at \libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup7()" id="myBtn7" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup7" class="popup">
    <span id="popupContent7"></span>
    <button onclick="closePopup7()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup7() {
        var moreText = document.getElementById("more7");
        var popup = document.getElementById("popup7");
        var popupContent = document.getElementById("popupContent7");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup7() {
        var popup = document.getElementById("popup7");
        popup.style.display = "none";
    }
</script>
                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/hexagon.zip?csf=1&web=1&e=NTVkJX" class="btn btn-outline-secondary"><span class="fa fa-download mr-8"></span>Download</a>
                </p>
                <form action="" method="POST" autocomplete="off">
                <div class="input-group mt-3">
                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge8_solved']) || strpos(getchallengeColor($conn, 8, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="8">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge8_solved']) || strpos(getchallengeColor($conn,8, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 8) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']);
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                </form>
            </blockquote>
        </div>
    </div>
</div>              
                 <div class="col-md-4 mb-3">
                    <div class="card category_crypt">
                        <div class="card-header <?php echo getchallengeColor($conn, 9, $userprofile);?>" id="challenge_id9" data-target="#problem_id_9" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_9">
                        Fictional character<br> <span class="badge align-self-end"><?php echo getpoints($conn,150,9,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_9" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId9; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 9, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId9; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 9); ?></span></h6>
                                </div>
                                <p> I am an ancient cipher, decode me?
                                    <!-- <span id="dots">...</span><span id="more8" style="display: none;">In at //libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup8()" id="myBtn8" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup8" class="popup">
    <span id="popupContent8"></span>
    <button onclick="closePopup8()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup8() {
        var moreText = document.getElementById("more8");
        var popup = document.getElementById("popup8");
        var popupContent = document.getElementById("popupContent8");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup8() {
        var popup = document.getElementById("popup8");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/Fictional%20Chipher.zip?csf=1&web=1&e=CErl7F" class="btn btn-outline-secondary"><span class="fa fa-download mr-9"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 9, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="9">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 9, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 9) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
        
            
            <div class="col-md-4 mb-3">
                <div class="card category_crypt">
        <div class="card-header <?php echo getchallengeColor($conn, 10, $userprofile);?>" id="challenge_id10" data-challenge-id="10" data-target="#problem_id_10" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_10">
        Unique_code<br> <span class="badge align-self-end"><?php echo getpoints($conn, 150, 10, 'Medium'); ?></span>
        </div>
        <div id="problem_id_10" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                    <h6 class="solvers challenge_<?php echo $challengeId10; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 10, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId10; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 10); ?></span></h6>
                </div>
                <p> Everything you need is in between begining & end.
                    <!-- <span id="dots">...</span><span id="more9" style="display: none;">In at @libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup9()" id="myBtn9" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup9" class="popup">
    <span id="popupContent9"></span>
    <button onclick="closePopup9()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup9() {
        var moreText = document.getElementById("more9");
        var popup = document.getElementById("popup9");
        var popupContent = document.getElementById("popupContent9");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup9() {
        var popup = document.getElementById("popup9");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/Unique_Code.zip?csf=1&web=1&e=VsaL20" class="btn btn-outline-secondary"><span class="fa fa-download mr-10"></span>Download</a>
                                </p>
                <form action="" method="POST" autocomplete="off">
                    <div class="input-group mt-3">
                        <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge10_solved']) || strpos(getchallengeColor($conn, 10, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="10">
                            <input type="submit" class="btn btn-outline-secondary" value="Go!" name="login" id="submit"<?php echo (isset($_COOKIE['challenge10_solved']) || strpos(getchallengeColor($conn, 10, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 10) {
            $pointsToAdd = 150;
            $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
            $resultCount = mysqli_query($conn, $queryCount);
            if ($resultCount) {
            $row = mysqli_fetch_assoc($resultCount);
            $numTeamsSolved = $row['num_teams_solved'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }
    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    
    handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
?>
                </form>          
                         </blockquote>
                    </div>
                </div>
            </div>

                <div class="col-md-4 mb-3">
    <div class="card category_crypt">
        <div class="card-header <?php echo getchallengeColor($conn, 11, $userprofile);?>" id="challenge_id11" data-challenge-id="11" data-target="#problem_id_11" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_11">
        Hungry Chipher <br><span class="badge align-self-end"><?php echo getpoints($conn,200,11,'Hard'); ?></span>
        </div>
        <div id="problem_id_11" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                <h6 class="solvers challenge_<?php echo $challengeId11; ?>">Solvers: <span class="solver_num" id="solvers">
                <?php
                solvers($conn, 11, $flag,$teamName); 
    ?>
</span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId11; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 11); ?></span></h6>
                </div>
                <p> I am the person who knows many languages but i can't decode this, can you?
                <!-- <span id="dots">...</span><span id="more10" style="display: none;">In at ()libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup10()" id="myBtn10" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup10" class="popup">
    <span id="popupContent10"></span>
    <button onclick="closePopup10()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup10() {
        var moreText = document.getElementById("more10");
        var popup = document.getElementById("popup10");
        var popupContent = document.getElementById("popupContent10");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup10() {
        var popup = document.getElementById("popup10");
        popup.style.display = "none";
    }
</script>
                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Cryptography/Hungary%20Chipher.zip?csf=1&web=1&e=0dheBu" class="btn btn-outline-secondary"><span class="fa fa-download mr-11"></span>Download</a>
                </p>
                <form action="" method="POST" autocomplete="off">
                <div class="input-group mt-3">
                    <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon8" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge11_solved']) || strpos(getchallengeColor($conn, 11, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="11">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge11_solved']) || strpos(getchallengeColor($conn,11, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 11) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']);
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                </form>
            </blockquote>
        </div>
    </div>
</div>     
                <!-- <div class="row hackerFont"> -->
                    <div class="col-md-12">
                     <h4>Network</h4>
                </div>         
        <div class="col-md-4 mb-3">
        <div class="card category_network">
            <div class="card-header <?php echo getchallengeColor($conn, 12, $userprofile);?>" id="challenge_id12" data-target="#problem_id_12" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_12">
            Simple Shark<br><span class="badge align-self-end"><?php echo getpoints($conn,100,12,'Easy'); ?></span>
            </div>
            <div id="problem_id_12" class="collapse card-body">
        <blockquote class="card-blockquote">
            <div style="display: flex;">
            <h6 class="solvers challenge_<?php echo $challengeId12; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 12, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId12; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 12); ?></span></h6>
            </div>
            <p> The flag has been divided into 3-5 parts and scattered across the network. Your task is to locate and assemble these fragments to reveal the complete flag.
            <!-- <span id="dots">...</span><span id="more11" style="display: none;">In at -libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup11()" id="myBtn11" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup11" class="popup">
    <span id="popupContent11"></span>
    <button onclick="closePopup11()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup11() {
        var moreText = document.getElementById("more11");
        var popup = document.getElementById("popup11");
        var popupContent = document.getElementById("popupContent11");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup11() {
        var popup = document.getElementById("popup11");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Networking/Simple%20Shark.zip?csf=1&web=1&e=nePXeN" class="btn btn-outline-secondary"><span class="fa fa-download mr-12"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 12, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="12">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge12_solved']) || strpos(getchallengeColor($conn, 12, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                        </div>
                        </div>
                            <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 12) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
            <div class="col-md-4 mb-3">
                <div class="card category_network">
        <div class="card-header <?php echo getchallengeColor($conn, 13, $userprofile);?>" id="challenge_id13" data-challenge-id="13" data-target="#problem_id_13" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_13">
        Lost in wire<br> <span class="badge align-self-end"><?php echo getpoints($conn, 150, 13, 'Medium'); ?></span>
        </div>
        <div id="problem_id_13" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                    <h6 class="solvers challenge_<?php echo $challengeId13; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 13, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId13; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 13); ?></span></h6>
                </div>
                <p> The flag has been lost in a sea of network traffic. You'll need to carefully examine each packet to uncover it.
                    <!-- <span id="dots">...</span><span id="more12" style="display: none;">In at =libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup12()" id="myBtn12" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup12" class="popup">
    <span id="popupContent12"></span>
    <button onclick="closePopup12()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup12() {
        var moreText = document.getElementById("more12");
        var popup = document.getElementById("popup12");
        var popupContent = document.getElementById("popupContent12");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup12() {
        var popup = document.getElementById("popup12");
        popup.style.display = "none";
    }
</script>
                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Networking/Lost%20in%20wire.zip?csf=1&web=1&e=tyvWP8" class="btn btn-outline-secondary"><span class="fa fa-download mr-13"></span>Download</a>
                </p>
                <form action="" method="POST" autocomplete="off">
                    <div class="input-group mt-3">
                        <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge13_solved']) || strpos(getchallengeColor($conn, 13, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="13">
                            <input type="submit" class="btn btn-outline-secondary" value="Go!" name="login" id="submit"<?php echo (isset($_COOKIE['challenge13_solved']) || strpos(getchallengeColor($conn, 13, $userprofile), 'solved') !== false) ? 'disabled' : ''; ?>>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 13) {
            $pointsToAdd = 150;
            $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
            $resultCount = mysqli_query($conn, $queryCount);
            if ($resultCount) {
            $row = mysqli_fetch_assoc($resultCount);
            $numTeamsSolved = $row['num_teams_solved'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }
    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    
    handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
?>
                </form>          
                         </blockquote>
                    </div>
                </div>
            </div>
                <div class="col-md-4 mb-3">
    <div class="card category_network">
        <div class="card-header <?php echo getchallengeColor($conn, 14, $userprofile);?>" id="challenge_id14" data-challenge-id="14" data-target="#problem_id_14" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_14">
        Wire Detective <br> <span class="badge align-self-end"><?php echo getpoints($conn,150,14,'Medium'); ?></span>
        </div>
        <div id="problem_id_14" class="collapse card-body">
            <blockquote class="card-blockquote">
                <div style="display: flex;">
                <h6 class="solvers challenge_<?php echo $challengeId14; ?>">Solvers: <span class="solver_num" id="solvers">
                <?php
                solvers($conn, 14, $flag,$teamName); 
    ?>
</span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId14; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 14); ?></span></h6>
                </div>
                <p> Someone conducted an Nmap scan within the internal environment. Your mission is to identify the individual responsible for this action.
                <!-- <span id="dots">...</span><span id="more13" style="display: none;">In at +libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup13()" id="myBtn13" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup13" class="popup">
    <span id="popupContent13"></span>
    <button onclick="closePopup13()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup13() {
        var moreText = document.getElementById("more13");
        var popup = document.getElementById("popup13");
        var popupContent = document.getElementById("popupContent13");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup13() {
        var popup = document.getElementById("popup13");
        popup.style.display = "none";
    }
</script>
                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Networking/Wire%20Detective.zip?csf=1&web=1&e=mdTy48" class="btn btn-outline-secondary"><span class="fa fa-download mr-14"></span>Download</a>
                </p>
                <form action="" method="POST" autocomplete="off">
                <div class="input-group mt-3">
                    <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon8" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge14_solved']) || strpos(getchallengeColor($conn, 14, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                        <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="14">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge14_solved']) || strpos(getchallengeColor($conn,14, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                        </div>
                    </div>
                    <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 14) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -= 10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']);
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                </form>
            </blockquote>
        </div>
    </div>
</div>              
<!-- <div class="row hackerFont"> -->
                <div class="col-md-12">
                    <h4>OSINT</h4>
</div>
                 <div class="col-md-4 mb-3">
                    <div class="card category_operating">
                        <div class="card-header <?php echo getchallengeColor($conn, 15, $userprofile);?>" id="challenge_id15" data-target="#problem_id_15" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_15">
                            Teams Work<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,15,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_15" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId15; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 15, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId15; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 15); ?></span></h6>
                                </div>
                                <p>Search Me I am the Creator of this CTF universe...
                                <!-- <span id="dots">...</span><span id="more14" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup14()" id="myBtn14" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup14" class="popup">
    <span id="popupContent14"></span>
    <button onclick="closePopup14()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup14() {
        var moreText = document.getElementById("more14");
        var popup = document.getElementById("popup14");
        var popupContent = document.getElementById("popupContent14");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup14() {
        var popup = document.getElementById("popup14");
        popup.style.display = "none";
    }
</script>
                                <!-- <a target="_blank" href="" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a> -->
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 15, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="15">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge15_solved']) || strpos(getchallengeColor($conn, 15, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 15) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_operating">
                        <div class="card-header <?php echo getchallengeColor($conn, 16, $userprofile);?>" id="challenge_id16" data-target="#problem_id_16" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_16">
                        Find Place <br> <span class="badge align-self-end"><?php echo getpoints($conn,100,16,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_16" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId16; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 16, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId16; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 16); ?></span></h6>
                                </div>
                                <p> To determine the place Naveen plans to visit in summer, further context or information about Naveen's interests or geographical preferences is needed.
        Flag format: TKCTF{city_country}
                                <!-- <span id="dots">...</span><span id="more16" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup16()" id="myBtn16" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup16" class="popup">
    <span id="popupContent16"></span>
    <button onclick="closePopup16()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup16() {
        var moreText = document.getElementById("more16");
        var popup = document.getElementById("popup16");
        var popupContent = document.getElementById("popupContent16");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup16() {
        var popup = document.getElementById("popup16");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/OSINT/Find_Place.zip?csf=1&web=1&e=g0zOFa" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 16, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="16">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge15_solved']) || strpos(getchallengeColor($conn, 16, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 16) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>                
                <div class="col-md-4 mb-3">
                    <div class="card category_operating">
                        <div class="card-header <?php echo getchallengeColor($conn, 17, $userprofile);?>" id="challenge_id17" data-target="#problem_id_17" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_17">
                        Influencers<br> <span class="badge align-self-end"><?php echo getpoints($conn,150,17,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_17" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId17; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 17, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId17; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 17); ?></span></h6>
                                </div>
                                <p> Who is 'bengolicat' exactly? Intel has that their owner has leaked some private information.
                                <!-- <span id="dots">...</span><span id="more17" style="display: none;">Hint: Find out the product introduction and you will find what you are looking for 6 words string. Replace space with underscore. 
example: TKCTF{one_two_three_four_five_six}</span>
                <button onclick="openPopup17()" id="myBtn17" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup17" class="popup">
    <span id="popupContent17"></span>
    <button onclick="closePopup17()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup17() {
        var moreText = document.getElementById("more17");
        var popup = document.getElementById("popup17");
        var popupContent = document.getElementById("popupContent17");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup17() {
        var popup = document.getElementById("popup17");
        popup.style.display = "none";
    }
</script>
                                <!-- <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/OSINT/Overrated.zip?csf=1&web=1&e=S2rkKY" class="btn btn-outline-secondary"><span class="fa fa-download mr-17"></span>Download</a> -->
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 17, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="17">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge17_solved']) || strpos(getchallengeColor($conn, 17, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Harsh Bhanushali</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 17) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_operating">
                        <div class="card-header <?php echo getchallengeColor($conn, 18, $userprofile);?>" id="challenge_id18" data-target="#problem_id_18" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_18">
                        Locate Me<br> <span class="badge align-self-end"><?php echo getpoints($conn,200,18,'Hard'); ?></span>
                        </div>
                        <div id="problem_id_18" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId18; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 18, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId18; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 18); ?></span></h6>
                                </div>
                                <p> People love telling the world about their holiday, but is this really a great idea? What CITY is Sarita Deshmukh going on holiday in May?
                                <span id="dots">...</span><span id="more18" style="display: none;">Hint: unless you've been there before, you might need to use a tool to get the answer.
                                NOTE: If you're having trouble working out who this person is, have a look at other Life Online challenges as they could provide you with an entry point to find these people ;)</span>
                <button onclick="openPopup18()" id="myBtn18" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button>
                </p>
<div id="popup18" class="popup">
    <span id="popupContent18"></span>
    <button onclick="closePopup18()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup18() {
        var moreText = document.getElementById("more18");
        var popup = document.getElementById("popup18");
        var popupContent = document.getElementById("popupContent18");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup18() {
        var popup = document.getElementById("popup18");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="#!" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge18_solved']) || strpos(getchallengeColor($conn, 18, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="18">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge18_solved']) || strpos(getchallengeColor($conn, 18, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Harsh Bhanushali</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 18) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>      
                <div class="col-md-4 mb-3">
                    <div class="card category_operating">
                        <div class="card-header <?php echo getchallengeColor($conn, 32, $userprofile);?>" id="challenge_id32" data-target="#problem_id_32" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_32">
                        Overrated<br> <span class="badge align-self-end"><?php echo getpoints($conn,200,32,'Hard'); ?></span>
                        </div>
                        <div id="problem_id_32" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId32; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 32, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId32; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 32); ?></span></h6>
                                </div>
                                <p> History was made on that day. McKenna was present when the moment was captured. Find out what she called the ad.
                                <span id="dots">...</span><span id="more32" style="display: none;">Hint: Find out the product introduction and you will find what you are looking for 6 words string. Replace space with underscore. 
example: TKCTF{one_two_three_four_five_six}
</span>
                <button onclick="openPopup32()" id="myBtn32" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button>
                </p>
<div id="popup32" class="popup">
    <span id="popupContent32"></span>
    <button onclick="closePopup32()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup32() {
        var moreText = document.getElementById("more32");
        var popup = document.getElementById("popup32");
        var popupContent = document.getElementById("popupContent32");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup32() {
        var popup = document.getElementById("popup32");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/OSINT/Overrated.zip?csf=1&web=1&e=S2rkKY
" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge32_solved']) || strpos(getchallengeColor($conn, 32, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="32">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge32_solved']) || strpos(getchallengeColor($conn, 32, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 32) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <h4>Reversing</h4>
</div>
                 <div class="col-md-4 mb-3">
                    <div class="card category_reversing">
                        <div class="card-header <?php echo getchallengeColor($conn, 19, $userprofile);?>" id="challenge_id19" data-target="#problem_id_19" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_19">
                        Easy Peasy<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,19,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_19" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId19; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 19, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId19; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 19); ?></span></h6>
                                </div>
                                <p> It is super easy, I know you can do it.
                                <!-- <span id="dots">...</span><span id="more19" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup19()" id="myBtn19" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup19" class="popup">
    <span id="popupContent19"></span>
    <button onclick="closePopup19()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup19() {
        var moreText = document.getElementById("more19");
        var popup = document.getElementById("popup19");
        var popupContent = document.getElementById("popupContent19");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup19() {
        var popup = document.getElementById("popup19");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href=" https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/ReverseEnggering/Easy%20Peasy.zip?csf=1&web=1&e=c2C2pD" class="btn btn-outline-secondary"><span class="fa fa-download mr-19"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 19, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="19">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge19_solved']) || strpos(getchallengeColor($conn, 19, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 19) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_reversing">
                        <div class="card-header <?php echo getchallengeColor($conn, 20, $userprofile);?>" id="challenge_id20" data-target="#problem_id_20" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_20">
                        Alien Algorithm<br> <span class="badge align-self-end"><?php echo getpoints($conn,150,20,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_20" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId20; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 20, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId20; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 20); ?></span></h6>
                                </div>
                                <p> A group of spies has discovered a code and an encrypted cipher within an alien database. They need to analyze the code and decrypt the cipher. Help them and get the flag.
                                <!-- <span id="dots">...</span><span id="more20" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup20()" id="myBtn20" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup20" class="popup">
    <span id="popupContent20"></span>
    <button onclick="closePopup20()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup20() {
        var moreText = document.getElementById("more20");
        var popup = document.getElementById("popup20");
        var popupContent = document.getElementById("popupContent20");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup20() {
        var popup = document.getElementById("popup20");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/ReverseEnggering/Alien%20Algorithm.zip?csf=1&web=1&e=Jda8Sy
" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 20, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="20">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge15_solved']) || strpos(getchallengeColor($conn, 20, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 20) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>                
                <div class="col-md-4 mb-3">
                    <div class="card category_reversing">
                        <div class="card-header <?php echo getchallengeColor($conn, 21, $userprofile);?>" id="challenge_id21" data-target="#problem_id_21" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_21">
                        Safe Lock<br> <span class="badge align-self-end"><?php echo getpoints($conn,150,21,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_21" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId21; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 21, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId21; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 21); ?></span></h6>
                                </div>
                                <p> Binary is locked with the serial key. your task is to find the key.example flag: TKCTF{<Good Serial>}
                                <!-- <span id="dots">...</span><span id="more21" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup21()" id="myBtn21" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup21" class="popup">
    <span id="popupContent21"></span>
    <button onclick="closePopup21()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup21() {
        var moreText = document.getElementById("more21");
        var popup = document.getElementById("popup21");
        var popupContent = document.getElementById("popupContent21");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup21() {
        var popup = document.getElementById("popup21");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href=" https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/ReverseEnggering/Safe%20Lock.zip?csf=1&web=1&e=UxTrG6
" class="btn btn-outline-secondary"><span class="fa fa-download mr-21"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 21, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="21">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge21_solved']) || strpos(getchallengeColor($conn, 21, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 21) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_reversing">
                        <div class="card-header <?php echo getchallengeColor($conn, 22, $userprofile);?>" id="challenge_id22" data-target="#problem_id_22" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_22">
                        Code Dump<br> <span class="badge align-self-end"><?php echo getpoints($conn,200,22,'Hard'); ?></span>
                        </div>
                        <div id="problem_id_22" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId22; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 22, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId22; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 22); ?></span></h6>
                                </div>
                                <p> A company hired a developer who's passionate about fitness, naming all functions and variables after gym exercises. However, he made several mistakes in the code. If you understand the code, you'll uncover the flag hidden within it.	
                                <!-- <span id="dots">...</span><span id="more22" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup22()" id="myBtn22" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup22" class="popup">
    <span id="popupContent22"></span>
    <button onclick="closePopup22()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup22() {
        var moreText = document.getElementById("more22");
        var popup = document.getElementById("popup22");
        var popupContent = document.getElementById("popupContent22");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup22() {
        var popup = document.getElementById("popup22");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/ReverseEnggering/Code%20Dump.zip?csf=1&web=1&e=b6oM0K" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge22_solved']) || strpos(getchallengeColor($conn, 22, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="22">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge22_solved']) || strpos(getchallengeColor($conn, 22, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 22) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>                
                <div class="col-md-12">
                    <h4>Stegnography</h4>
</div>
                 <div class="col-md-4 mb-3">
                    <div class="card category_steg">
                        <div class="card-header <?php echo getchallengeColor($conn, 23, $userprofile);?>" id="challenge_id23" data-target="#problem_id_23" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_23">
                        The Image<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,23,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_23" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId23; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 23, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId23; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 23); ?></span></h6>
                                </div>
                                <p>Pay close attention to discover the flag
                                <!-- <span id="dots">...</span><span id="more23" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup23()" id="myBtn23" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup23" class="popup">
    <span id="popupContent23"></span>
    <button onclick="closePopup23()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup23() {
        var moreText = document.getElementById("more23");
        var popup = document.getElementById("popup23");
        var popupContent = document.getElementById("popupContent23");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup23() {
        var popup = document.getElementById("popup23");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/stegnography/The_Image.zip?csf=1&web=1&e=CqcGvE
" class="btn btn-outline-secondary"><span class="fa fa-download mr-23"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 23, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="23">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge23_solved']) || strpos(getchallengeColor($conn, 23, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 23) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_steg">
                        <div class="card-header <?php echo getchallengeColor($conn, 24, $userprofile);?>" id="challenge_id24 " data-target="#problem_id_24   " data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_24   ">
                        Robots Talk's  <br> <span class="badge align-self-end"><?php echo getpoints($conn,150,24,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_24" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId24; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 24, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId24; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 24); ?></span></h6>
                                </div>
                                <p>An interception has occurred in the communication between 36 robots, likely involving discussion about the flag. Your task is to decipher this intercepted communication and locate the flag.
                                <!-- <span id="dots">...</span><span id="more24" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup24()" id="myBtn24" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup24" class="popup">
    <span id="popupContent24"></span>
    <button onclick="closePopup24 ()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup24  () {
        var moreText = document.getElementById("more24");
        var popup = document.getElementById("popup24");
        var popupContent = document.getElementById("popupContent24");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup24 () {
        var popup = document.getElementById("popup24");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/stegnography/Robot%20Talk%27s.zip?csf=1&web=1&e=Wlo5mT" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 24   , $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="24">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge15_solved']) || strpos(getchallengeColor($conn, 24 , $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 24) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>                
                <div class="col-md-4 mb-3">
                    <div class="card category_steg">
                        <div class="card-header <?php echo getchallengeColor($conn, 25, $userprofile);?>" id="challenge_id25" data-target="#problem_id_25" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_25">
                        Good Music<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,25,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_25" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId25; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 25, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId25; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 25); ?></span></h6>
                                </div>
                                <p> Immerse yourself in uplifting music to uncover the hidden flag.
                                <!-- <span id="dots">...</span><span id="more25" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup25()" id="myBtn25" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup25" class="popup">
    <span id="popupContent25"></span>
    <button onclick="closePopup25()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup25() {
        var moreText = document.getElementById("more25");
        var popup = document.getElementById("popup25");
        var popupContent = document.getElementById("popupContent25");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup25() {
        var popup = document.getElementById("popup25");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/stegnography/Good%20Music.zip?csf=1&web=1&e=7lEJbL
" class="btn btn-outline-secondary"><span class="fa fa-download mr-25"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 25, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="25">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge25_solved']) || strpos(getchallengeColor($conn, 25, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 25) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Forensics</h4>
</div>
<div class="col-md-4 mb-3">
                    <div class="card category_Forensics">
                        <div class="card-header <?php echo getchallengeColor($conn, 26, $userprofile);?>" id="challenge_id26" data-target="#problem_id_26" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_26">
                        Walk Over<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,26,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_26" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId26; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 26, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId26; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 26); ?></span></h6>
                                </div>
                                <p> Mr. Bean has been assigned the task of searching through a memory dump to find the flag. Can you assist him in finding the flag?
                                <!-- <span id="dots">...</span><span id="more26" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup26()" id="myBtn26" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup26" class="popup">
    <span id="popupContent26"></span>
    <button onclick="closePopup26()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup26() {
        var moreText = document.getElementById("more26");
        var popup = document.getElementById("popup26");
        var popupContent = document.getElementById("popupContent26");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup26() {
        var popup = document.getElementById("popup26");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Forensics/Walk%20Over.zip?csf=1&web=1&e=FjKqYZ
" class="btn btn-outline-secondary"><span class="fa fa-download mr-26"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 26, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="26">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge26_solved']) || strpos(getchallengeColor($conn, 26, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 26) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 mb-3">
                    <div class="card category_Forensics">
                        <div class="card-header <?php echo getchallengeColor($conn, 27, $userprofile);?>" id="challenge_id27 " data-target="#problem_id_27   " data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_27   ">
                            Challenge 27  <br> <span class="badge align-self-end"><?php echo getpoints($conn,150,27,'Medium'); ?></span>
                        </div>
                        <div id="problem_id_27" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId27; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 27, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId27; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 27); ?></span></h6>
                                </div>
                                <p> Can you find the password? Enter the password as flag in the following form: challenge27  
                                <span id="dots">...</span><span id="more27" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup27()" id="myBtn27" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button>
                </p>
<div id="popup27  " class="popup">
    <span id="popupContent27"></span>
    <button onclick="closePopup27()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup27  () {
        var moreText = document.getElementById("more27");
        var popup = document.getElementById("popup27  ");
        var popupContent = document.getElementById("popupContent27");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup27 () {
        var popup = document.getElementById("popup27  ");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="#!" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 27   , $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="27">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge15_solved']) || strpos(getchallengeColor($conn, 27 , $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 27) {
                        $pointsToAdd = 150;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=10;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>                
                <div class="col-md-4 mb-3">
                    <div class="card category_Forensics">
                        <div class="card-header <?php echo getchallengeColor($conn, 28, $userprofile);?>" id="challenge_id28" data-target="#problem_id_28" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_28">
                            Challenge 28<br> <span class="badge align-self-end"><?php echo getpoints($conn,200,28,'Hard'); ?></span>
                        </div>
                        <div id="problem_id_28" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId28; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 28, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId28; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 28); ?></span></h6>
                                </div>
                                <p> Can you find the password? Enter the password as flag in the following form: challenge28
                                <span id="dots">...</span><span id="more28" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup28()" id="myBtn28" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button>
                </p>
<div id="popup28" class="popup">
    <span id="popupContent28"></span>
    <button onclick="closePopup28()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup28() {
        var moreText = document.getElementById("more28");
        var popup = document.getElementById("popup28");
        var popupContent = document.getElementById("popupContent28");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup28() {
        var popup = document.getElementById("popup28");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="#!" class="btn btn-outline-secondary"><span class="fa fa-download mr-28"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 28, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="28">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge28_solved']) || strpos(getchallengeColor($conn, 28, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 28) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <h4>Miscellaneous</h4>
</div>
<div class="col-md-4 mb-3">
                    <div class="card category_misc">
                        <div class="card-header <?php echo getchallengeColor($conn, 29, $userprofile);?>" id="challenge_id29" data-target="#problem_id_29" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_29">
                        Archiver<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,29,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_29" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId29; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 29, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId29; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 29); ?></span></h6>
                                </div>
                                <p> Find the flag
                                <!-- <span id="dots">...</span><span id="more29" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup29()" id="myBtn29" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup29" class="popup">
    <span id="popupContent29"></span>
    <button onclick="closePopup29()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup29() {
        var moreText = document.getElementById("more29");
        var popup = document.getElementById("popup29");
        var popupContent = document.getElementById("popupContent29");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup29() {
        var popup = document.getElementById("popup29");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Miscellaneous/Archiver.zip?csf=1&web=1&e=pVQ8nM
" class="btn btn-outline-secondary"><span class="fa fa-download mr-29"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 29, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="29">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge29_solved']) || strpos(getchallengeColor($conn, 29, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 29) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card category_misc">
                        <div class="card-header <?php echo getchallengeColor($conn, 30, $userprofile);?>" id="challenge_id30 " data-target="#problem_id_30   " data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_30   ">
                        Meme Document<br> <span class="badge align-self-end"><?php echo getpoints($conn,100,30,'Easy'); ?></span>
                        </div>
                        <div id="problem_id_30" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId30; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 30, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId30; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 30); ?></span></h6>
                                </div>
                                <p>  7 words in document (Thala for a reason). find the flag  
                                <!-- <span id="dots">...</span><span id="more30" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup30()" id="myBtn30" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup30" class="popup">
    <span id="popupContent30"></span>
    <button onclick="closePopup30()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup30() {
        var moreText = document.getElementById("more30");
        var popup = document.getElementById("popup30");
        var popupContent = document.getElementById("popupContent30");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup30() {
        var popup = document.getElementById("popup30");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="#!" class="btn btn-outline-secondary"><span class="fa fa-download mr-15"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 30   , $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="30">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge15_solved']) || strpos(getchallengeColor($conn, 30 , $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Sandeep Singh</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 30) {
                        $pointsToAdd = 100;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=5;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>                
                <div class="col-md-4 mb-3">
                    <div class="card category_misc">
                        <div class="card-header <?php echo getchallengeColor($conn, 31, $userprofile);?>" id="challenge_id31" data-target="#problem_id_31" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_31">
                        Scan Me <br> <span class="badge align-self-end"><?php echo getpoints($conn,200,31,'Hard'); ?></span>
                        </div>
                        <div id="problem_id_31" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $challengeId31; ?>">Solvers: <span class="solver_num"><?php solvers($conn, 31, $flag,$teamName); ?></span> &nbsp;<span class="color_blue challenge_<?php echo $challengeId31; ?>"><br>Difficulty:<?php echo getDifficulty($conn, 31); ?></span></h6>
                                </div>
                                <p> Manohar kaka who enter the office using QR code. Now the QR code is Partially broken, Can you help him to scan the QR code?
                                <!-- <span id="dots">...</span><span id="more31" style="display: none;">In at *libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor .</span>
                <button onclick="openPopup31()" id="myBtn31" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button> -->
                </p>
<div id="popup31" class="popup">
    <span id="popupContent31"></span>
    <button onclick="closePopup31()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
</div>
                <script>
    function openPopup31() {
        var moreText = document.getElementById("more31");
        var popup = document.getElementById("popup31");
        var popupContent = document.getElementById("popupContent31");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }
    function closePopup31() {
        var popup = document.getElementById("popup31");
        popup.style.display = "none";
    }
</script>
                                <a target="_blank" href="https://talakunchinpl-my.sharepoint.com/:u:/r/personal/harsh_bhanushali_talakunchi_com/Documents/Research%20and%20Development%20details/Sandeep/CTF/_CTF_/Miscellaneous/QR%20Flag.zip?csf=1&web=1&e=5Yx0P1
" class="btn btn-outline-secondary"><span class="fa fa-download mr-31"></span>Download</a>
                                </p>
                                <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')"  <?php echo (isset($_COOKIE['challenge9_solved']) || strpos(getchallengeColor($conn, 31, $teamName), 'solved') !== false) ? 'disabled' : ''; ?>>
                                <div class="input-group-append">
                            <input type="hidden" name="challenge_id" value="31">
                            <input type ="submit" class="btn btn-outline-secondary" value="Go!" type="button" name="login" id="submit"<?php echo (isset($_COOKIE['challenge31_solved']) || strpos(getchallengeColor($conn, 31, $teamName), 'solved') !== false) ? 'disabled' : '';?> ></button>
                                </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: Bhavesh Chaudhary</span>
                                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 31) {
                        $pointsToAdd = 200;
                        $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                        $resultCount = mysqli_query($conn, $queryCount);
                        if ($resultCount) {
                            $row = mysqli_fetch_assoc($resultCount);
                            $numTeamsSolved = $row['num_teams_solved'];
                    
                            // Calculate the number of times to deduct points (every group of 5 teams)
                            $numDeductions = floor($numTeamsSolved / 5);
                    
                            // Deduct points for each group of 5 teams
                            for ($i = 0; $i < $numDeductions; $i++) {
                                $pointsToAdd -=15;
                            }
                        }
                    
                        // Escape user inputs to prevent SQL injection
                        $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                        $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                        $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
                        
                        handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
                    }                    
                    ?>
                    </form>
                            </blockquote>
                        </div>
                    </div>
                </div>