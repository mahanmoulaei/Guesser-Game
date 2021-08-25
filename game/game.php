<!DOCTYPE html>
<html>
    <head>
            <title>Game Page</title>
            <!--===============================================================================================-->	
                <link rel="icon" type="image/png" href="../images/game.ico"/>
                <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
            <!--===============================================================================================-->
    </head>
        <body>
            <div class="container">
                <div class="wrap-full p-l-55 p-r-55 p-t-80 p-b-30">
                    <div>
                        <h2 class="rainbow rainbow_text_animated">Guessing Game</h2>
                        <!--<h3> Welcome! </h3>-->
                        <p> The system will generate 5 random numbers soon <br> Select 5 different numbers between 0 to 12 to guess them </p>
                    </div>
                    <form class="form"  method='post' action='game.php'>
                        <?php
                            if (isset($_POST['signout'])) 
                            {
                                header("Location: ../logout/logout.php");
                                exit();
                            }
                        ?>
                        <div class="wrap-input m-b-20">
                            <select class='input' name="val1" id="val1" required>
                                <?php
                                    $numbers = array(0,1,2,3,4,5,6,7,8,9,10,11,12);
                                    foreach($numbers as $item){
                                        if($item == 0)
                                        {
                                            echo "<option value='$item' selected >$item</option>";
                                        }else
                                        {
                                            echo "<option value='$item'>$item</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="wrap-input m-b-20">
                            <select class='input ' name="val2" id="val2" required> 
                                <?php
                                    $numbers = array(0,1,2,3,4,5,6,7,8,9,10,11,12);
                                    foreach($numbers as $item){
                                        if($item == 0)
                                        {
                                            echo "<option value='$item' selected >$item</option>";
                                        }else
                                        {
                                            echo "<option value='$item'>$item</option>";
                                        }                                 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="wrap-input m-b-20">
                            <select class='input ' name="val3" id="val3" required>
                                <?php
                                    $numbers = array(0,1,2,3,4,5,6,7,8,9,10,11,12);
                                    foreach($numbers as $item){
                                        if($item == 0)
                                        {
                                            echo "<option value='$item' selected >$item</option>";
                                        }else
                                        {
                                            echo "<option value='$item'>$item</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="wrap-input m-b-20">
                                <select class='input ' name="val4" id="val4" required>                                   
                                    <?php
                                        $numbers = array(0,1,2,3,4,5,6,7,8,9,10,11,12);
                                        foreach($numbers as $item){
                                            if($item == 0)
                                            {
                                                echo "<option value='$item' selected >$item</option>";
                                            }else
                                            {
                                                echo "<option value='$item'>$item</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="wrap-input m-b-20">
                                <select class='input ' name="val5" id="val5" required>                               
                                    <?php
                                        $numbers = array(0,1,2,3,4,5,6,7,8,9,10,11,12);
                                        foreach($numbers as $item){
                                            if($item == 0)
                                            {
                                                echo "<option value='$item' selected >$item</option>";
                                            }else
                                            {
                                                echo "<option value='$item'>$item</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <br>
                        	<div class="container-form-btn">
								<button class='btn1' id="submit1" type="submit" name="submit">Submit</button>
								<span class="form-title p-b-37">Close your session</span>
                                <button class='btn2' id="signout" type="signout" name="signout">Sign out</button>
							</div>
                    </form>
                    <?php
                        if (isset($_POST['submit']))
                        {                        
                            $counter = 0;
                            $val1 = $_POST['val1'];
                            $val2 = $_POST['val2'];
                            $val3 = $_POST['val3'];
                            $val4 = $_POST['val4'];
                            $val5 = $_POST['val5'];

                            $arrVal = array($val1, $val2, $val3, $val4, $val5);

                            
                            echo '<br><br><b>We generated the numbers </b><br>';

                            //Edited By Mahan
                            $n = 5;
                            $rand = array();
                            for($i = 0; $i < $n; $i++) {
                                $ok = false;
                                while(!$ok) {
                                    $x = mt_rand(0,12); //mt_rand() is four times faster than rand()
                                    $ok = !in_array($x, $rand);
                                }
                                $rand[$i] = $x;
                                if($i != 4)
                                {
                                    echo $rand[$i], ', ';
                                }else{
                                    echo $rand[$i];
                                }
                            }
                                    
                            echo '<br><br><b>You guessed the numbers </b><br>';
                            for ($i = 0; $i < 5; $i++) 
                            {
                                if($i != 4)
                                {
                                    echo $arrVal[$i], ', ';
                                }else{
                                    echo $arrVal[$i];
                                }
                                        
                            }
                            echo '<br>';
                            /*
                            for ($i = 0; $i < 5; $i++)
                            {
                                if($rand[$i] == $arrVal[$i])
                                {
                                    $counter++;
                                }
                                        
                            }
                            */
                            //Edited By Mahan
                            $arrTemp = array();
                            for ($i = 0; $i < 5; $i++)
                            {
                                for ($j = 0; $j < 5; $j++) {
                                    if($rand[$j] == $arrVal[$i])
                                    {
                                        if (!in_array($arrVal[$i], $arrTemp)) {
                                            $arrTemp[$i] = $arrVal[$i];
                                            $counter++;
                                        }
                                        
                                    }
                                }        
                            }

                            if( $counter == 0 )
                            {
                                echo '<br><b>Result :</b><br>';
                                echo 'You guessed none of the numbers we generated!' . '<br><br>' ;
                                echo "<div class=\"container-red m-t-20\">";
                                    echo '<b>You’re an APPRENTICE guesser!</b><br>'; 
								echo "</div>";
                                
                                 
                            }
                            elseif ($counter < 5) 
                            {
                                echo '<br><b>Result :</b><br> You guessed '. $counter .' of the numbers we generated! ' . '<br><br>' ;
                                echo "<div class=\"container-blue m-t-20\">";
                                    echo '<b>You’re a GOOD guesser!</b><br>'; 
								echo "</div>";
                                
                            }
                            elseif ($counter == 5) 
                            {
                                echo '<br><b>Result :</b><br> You guessed all the numbers we generated! ' . '<br><br>' ;
                                echo "<div class=\"container-green m-t-20\">";
                                    echo '<b>You’re an EXCELLENT guesser! </b><br>'; 
								echo "</div>";
                            }
                        }
                    ?>
                    </div>
                    <div class="footer">
                        <footer>
                            <p style="position: fixed; bottom: 0; left:5; width:100%; text-align: left; color: black; font-size: 10;">&copy; Copyright 2021 by Web Dev Titans</p>
                        </footer>
                    </div>
                </div>                
            </div>

        </body>
</html>