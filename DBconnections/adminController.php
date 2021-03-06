<?php
//Validerer fornavn ved opprettelse av bruker
function valider_firstname($firstname)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ.\- ]{2,20}$/", $firstname))
    {
        echo '<script type="text/javascript">alert("Firstname can only have letters");</script>';
        echo "Firstname is wrong, use only letters. <br/>";
        return false;
    }
    return $firstname;
}

//Validerer etternavn ved opprettelse av bruker
function valider_lastname($lastname)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ.\- ]{2,20}$/", $lastname))
    {
        echo '<script type="text/javascript">alert("Lastname error contatning other than letters");</script>';
        echo "Lastname is wrong, use only letters. <br/>";
        return false;
    }
    return $lastname;
}

//Validerer brukernavn ved opprettelse av bruker
function valider_username($username)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ0-9.\- ]{2,20}$/", $username))
    {
        echo '<script type="text/javascript">alert("USername ");</script>';
        echo "Username is not allowed. <br/>";
        return false;
    }
    return $username;
}

//Validerer passord ved opprettelse av bruker
function valider_password($password)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ0-9\-_]{2,20}$/", $password))
    {
        echo "Password not valid, please use a valid pattern. <br/>";
        return false;
    }
    return $password;
}

//Registrerer at man oppretter nytt punkt i sjekklisten
if (isset($_POST['createNewPoint'])) {
    pointlist();
}

//Registrerer at man oppretter nytt punkt i sjekklisten i engelsk versjon
if (isset($_POST['createNewP'])) {
    pointlistEN();
}

//Oppretter ny sjekkliste med ny ansatt
if (isset($_POST['register'])){
    $firstname = valider_firstname($_POST["firstname"]);
    $lastname = valider_lastname($_POST["lastname"]);
    $username = valider_username($_POST["username"]);
    $usertype= e($_POST['usertype']);
    $password = e($_POST["password"]);
    $repeatPassword = e($_POST['repeatPassword']);

    $query = "SELECT * FROM Users WHERE username = '$username' ";
    $usernameExist = mysqli_query($db, $query);

    if (empty($firstname)) {array_push($errors, "You need a firstname");
    echo '<script type="text/javascript">alert("Empty field");</script>';}
    if (empty($lastname)) {array_push($errors, "write your lastname");
        echo '<script type="text/javascript">alert("Empty field");</script>';}
    if (empty($username)) {array_push($errors, "write the username");
        echo '<script type="text/javascript">alert("Empty field");</script>';}

    //Check that password and repeat is alike
    if ($password != $repeatPassword){
        echo '<script type="text/javascript">alert("Invalid Password");</script>';
    }
    //Check if username in use already
    else if (mysqli_num_rows($usernameExist) > 0){
        echo '<script type="text/javascript">alert("Username already exists");</script>';
    }
    //add user and crypt the password in md5 encryption
    else{
        if (count($errors) == 0) {

            $password = md5($_POST['password']);
            $query = "INSERT INTO Users (firstname, lastname, username , usertype, password) 
                  VALUES('$firstname', '$lastname', '$username', '$usertype', '$password')";
            $result = $db->query($query);
            if (!$result) {
                echo '<script type="text/javascript">alert("Wrong in the script");</script>';

            } //elseif(mysqli_affected_rows($db) == 0){
            elseif ($db->affected_rows == 0) {
                echo '<script type="text/javascript">alert("User wasnt added, but the script worked");</script>';

            } else {
                echo '<script type="text/javascript">alert("User added");</script>';
            }
        }
    }
}

//Funksjonen som oppretter nytt punkt i sjekklisten
function pointlist()
{
    global $db, $errors;
    mysqli_autocommit($db, false);
    $newPointNo = e($_POST['newPointNo']);
    $newPointEn = e($_POST['newPointEn']);
    $userType = e($_POST['userType']);
    $nationality = e($_POST['nationality']);
    $leader = e($_POST['leader']);
    if (empty($newPointNo)) {
        echo '<script type="text/javascript">alert("Empty write something");</script>';
        array_push($errors, "You need to write something");
    }
    $ind_check = "SELECT checkpointsNO FROM Checklist WHERE checkpointsNO= '$newPointNo'";
    $result = $db->query($ind_check);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        echo '<script type="text/javascript">alert("Already a checkpoint");</script>';
        array_push($errors, "Checkpoint is already here");
    } else {
        if (count($errors) == 0) {
            $query = "INSERT INTO Checklist (checkpointsNO, checkpointsEN, responsible, nationality, leader)
                                VALUES ('$newPointNo', '$newPointEn', '$userType', '$nationality', '$leader' ) ";
            $res = mysqli_query($db, $query);
            if (!$res) {

            } elseif ($db->affected_rows == 0) {
                echo '<script type="text/javascript">alert("Something failed");</script>';
            } else {
                mysqli_commit($db);
                echo '<script type="text/javascript">alert("Point added");</script>';
            }
        }
    }
}

//Funksjonen som oppretter nytt punkt i sjekklisten i engelsk versjon
function pointlistEn()
{
    global $db, $errors;
    mysqli_autocommit($db, false);
    $newPointNo = e($_POST['newPointNo']);
    $newPointEn = e($_POST['newPointEn']);
    $userType = e($_POST['userType']);
    $nationality = e($_POST['nationality']);
    $leader = e($_POST['leader']);
    if (empty($newPointNo)) {
        echo '<script type="text/javascript">alert("Empty write something");</script>';
        array_push($errors, "You need to write something");
    }
    $ind_check = "SELECT checkpointsEN FROM Checklist WHERE checkpointsEN= '$newPointEn'";
    $result = $db->query($ind_check);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        echo '<script type="text/javascript">alert("Already a checkpoint");</script>';
        array_push($errors, "Checkpoint is already here");
    } else {
        if (count($errors) == 0) {
            $query = "INSERT INTO Checklist (checkpointsNO, checkpointsEN, responsible, nationality, leader)
                                VALUES ('$newPointNo', '$newPointEn', '$userType', '$nationality', '$leader' ) ";
            $res = mysqli_query($db, $query);
            if (!$res) {

            } elseif ($db->affected_rows == 0) {
                echo '<script type="text/javascript">alert("Something failed");</script>';
            } else {
                mysqli_commit($db);
                echo '<script type="text/javascript">alert("Point added");</script>';
            }
        }
    }
}

//Funksjonen som viser hvilke punkter man kan velge mellom i endre punkt engelsk versjon
function selectPointEn()
{
    global $db, $errors;
    $sql ="SELECT * FROM Checklist";
    $result = $db->query($sql);

    if (mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row["idChecklist"].'">'.$row["checkpointsEN"].' Responsible:'.$row["responsible"].', Nationalitypoint:'.$row["nationality"].', Leaderpoint:'.$row["leader"].'</option>';
        }
    }
    else{
        echo "No connection to database or server";
    }
}

//Funksjonen som viser hvilke punkter man kan velge mellom i endre punkt
function selectPoint()
{
    global $db, $errors;
    $sql ="SELECT * FROM Checklist";
    $result = $db->query($sql);

    if (mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row["idChecklist"].'">'.$row["checkpointsNO"].' Ansvarlig:'.$row["responsible"].', Nasjonalitet:'.$row["nationality"].', Lederstilling:'.$row["leader"].'</option>';
        }
    }
    else{
        echo "No connection to database or server";
    }
}

//Funksjonen som endrer et eksisterende punkt i sjekklisten i engelsk versjon
function changePointEn()
{
    if (isset($_POST["selectPointEn"])) {
        global $db, $errors;
        $checkpointId = e($_POST["checkpoint"]);
        $sql = "SELECT * FROM Checklist WHERE Checklist.idChecklist ='" . $checkpointId . "'";
        $result = $db->query($sql);

        $result2 = mysqli_fetch_assoc($result);
        $checkpointId = e($result2["idChecklist"]);
        $checkpointNO = e($result2["checkpointsNO"]);
        $checkpointEN = e($result2["checkpointsEN"]);
        $responsible = e($result2["responsible"]);
        $nationality = e($result2["nationality"]);
        $leader = e($result2["leader"]);

        echo "<form action='' method='post' ><table id=\"CreateChecklistTable\">";
        echo "<tr class='input-group'><td id=\"CreateChecklistTable\"><input type='hidden' name='checkPointID' value='$checkpointId' id='$checkpointId'/><label type='text' value='$checkpointId' readonly >" . $checkpointId . "</td></tr>";
        echo "<tr class='input-group'><td id=\"CreateChecklistTable\"><textarea type='text' id='text-area-input-checkpoints' name='orgPointEN' id='$checkpointId' readonly >" . $checkpointEN . "</textarea></td><br></tr>";
        echo "<tr class='input-group'><td id=\"CreateChecklistTable\"> <textarea type='text' id='text-area-input-checkpoints' name='newPointEN' id='$checkpointId' placeholder='Write in new point'></textarea></td></tr>";
        echo "<tr class='input-group'><td id=\"CreateChecklistTable\"><textarea type='text' id='text-area-input-checkpoints' name='orgPointNO' id='$checkpointId' readonly >" . $checkpointNO . "</textarea></td><br></tr>";
        echo "<tr class ='input-group'><td id=\"CreateChecklistTable\"><textarea type='text' id='text-area-input-checkpoints' name='newPointNO' id='$checkpointId' placeholder='Write in new point if you know it in Norwegian'></textarea></td></tr>";
        echo "</table>";
        echo "<button type='submit' class='btn btn-primary' name='changing_Pointen'>Change</button>";
        echo "</form>";
    }

    if (isset($_POST["changing_Pointen"])) {
        global $db, $errors;
        mysqli_autocommit($db, false);
        $checkpointId2 = e($_POST["checkPointID"]);
        $newPointEN = e($_POST["newPointEN"]);
        $newPointNO = e($_POST["newPointNO"]);
        $orgPointNO = e($_POST["orgPointNO"]);
        $orgPointEN = e($_POST["orgPointEN"]);

        $sql = "UPDATE Checklist SET checkpointsEN = '$newPointNO', checkpointsNO = '$newPointNO' WHERE idChecklist = '$checkpointId2'";

        if ($newPointNO == $orgPointNO && $newPointEN == $orgPointEN) {

            echo '<script type="text/javascript">alert("The new and original points are identical.");</script>';
        } elseif ($newPointNO != $orgPointNO || $newPointEN != $orgPointEN) {
            if (mysqli_query($db, $sql)) {

                if (mysqli_affected_rows($db) > 0) {

                    mysqli_commit($db);
                    echo '<script type="text/javascript">alert("The checkpoint is altered");</script>';
                } else {

                    echo '<script type="text/javascript">alert("Could not edit the list ");</script>';
                }
            } else {
                echo '<script type="text/javascript">alert("Script was faulty");</script>';
            }

        } else {
            echo '<script type="text/javascript">alert("Something wrong happened ");</script>';
        }
    }
}

//Funksjonen som endrer et eksisterende punkt i sjekklisten
function changePoint()
    {
        if (isset($_POST["selectPoint"])) {
            //global $db, $errors;
            $db = mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
            $checkpointId = e($_POST["checkpoint"]);
            $sql = "SELECT * FROM Checklist WHERE Checklist.idChecklist ='".$checkpointId."'";
            $result = $db->query($sql);

            $result2 = mysqli_fetch_assoc($result);
            $checkpointId = e($result2["idChecklist"]);
            $checkpointNO = e($result2["checkpointsNO"]);
            $checkpointEN = e($result2["checkpointsEN"]);
            $responsible = e($result2["responsible"]);
            $nationality = e($result2["nationality"]);
            $leader = e($result2["leader"]);

            echo "<form action='' method='post'><table>";
            echo "<tr class='input-group'><td><input type='hidden' name='checkPointId' value='$checkpointId' id='$checkpointId'/><label type='text' value='$checkpointId' readonly />" . $checkpointId . "</td></tr>";
            echo "<tr class='input-group'><td><textarea type='text' name='orgPointNO'  id='$checkpointId' readonly >" . $checkpointNO . "</textarea></td><br></tr>";
            echo "<tr class='input-group'><td> <textarea type='text' name='newPointNO' id='$checkpointId' placeholder='Skriv in nytt punkt'></textarea></td></tr>";
            echo "<tr class='input-group'><td><textarea type='text' name='orgPointEN' id='$checkpointId' readonly >" . $checkpointEN . "</textarea></td><br></tr>";
            echo "<tr class ='input-group'><td><textarea type='text' name='newPointEN' id='$checkpointId' placeholder='Skriv inn nytt punkt på engelsk'></textarea></td></tr>";
            echo "</table>";
            echo "<button type='submit' class='btn btn-primary' name='changingPoint'>Change</button>";
            echo "</form>";
        }

        if (isset($_POST["changingPoint"])) {
            global $db, $errors;
            mysqli_autocommit($db, false);
            $checkpointId2 = $_POST["checkPointId"];
            $newPointNO = e($_POST["newPointNO"]);
            $newPointEN = e($_POST["newPointEN"]);
            $orgPointNO = e($_POST["orgPointNO"]);
            $orgPointEN = e($_POST["orgPointEN"]);

            $sql = "UPDATE Checklist SET checkpointsNO = '$newPointNO', checkpointsEN = '$newPointEN' WHERE idChecklist = '$checkpointId2'";

            if ($newPointNO == $orgPointNO && $newPointEN == $orgPointEN) {

                echo '<script type="text/javascript">alert("Punktene er like.");</script>';
            } elseif ($newPointNO != $orgPointNO || $newPointEN != $orgPointEN) {
                if (mysqli_query($db, $sql)) {

                    if (mysqli_affected_rows($db) > 0) {

                        mysqli_commit($db);
                        echo '<script type="text/javascript">alert("Punktet er endret");</script>';
                    }
                    else {

                        echo '<script type="text/javascript">alert("Kunne ikke endre");</script>';
                    }
                }
                else {
                    echo '<script type="text/javascript">alert("Skripet fungerte ikke");</script>';
                }

            }
            else {
                echo '<script type="text/javascript">alert("Annen feil");</script>';
            }
        }
    }

//Funksjonen som oppretter tabellen hvor man kan velge hvilket punkt man vil slette
function selectDeletePoint()
    {
        echo "<table id='table-delete-points'><tr id='delete-checkpoint-header'><th>Valg</th>";
        echo "<th>Sjekkpunkt på norsk</th>";
        echo "<th>Sjekkpunkt på engelsk</th>";
        echo "<th>Ansvarlig</th>";
        echo "<th>Nasjonalitet</th>";
        echo "<th>Leder</th></tr>";

        global $db, $errors;
        $sql = "Select * FROM Checklist";
        $result = mysqli_query($db, $sql);

        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                $check_id = $row["idChecklist"];

                echo "<tr>";
                echo "<td id='deletePoints'><input type='radio' id='radio-button-delete-user' name='DeletePoint' value='$check_id'/></td>";
                echo "<td id='deletePoints'>" . $row["checkpointsNO"] . "</td>";
                echo "<td id='deletePoints'>" . $row["checkpointsEN"] . "</td>";
                echo "<td id='deletePoints'>" . $row["responsible"] . "</td>";
                echo "<td id='deletePoints'>" . $row["nationality"] . "</td>";
                echo "<td id='deletePoints'>" . $row["leader"] . "</td>";
                echo "</tr>";

            }
            echo "</table>";
        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

//Funksjonen som oppretter tabellen hvor man kan velge hvilket punkt man vil slette i engelsk versjon
function selectDeletePointEn()
    {
        echo "<table id='table-delete-points'><tr id='delete-checkpoint-header'><th>Valg</th>";
        echo "<th>Checkpoint</th>";
        echo "<th>Checkpoint Norwegian</th>";
        echo "<th>Responsible</th>";
        echo "<th>Nationality</th>";
        echo "<th>Leader</th></tr>";

        global $db, $errors;
        $sql = "Select * FROM Checklist";
        $result = mysqli_query($db, $sql);

        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                $check_id = $row["idChecklist"];

                echo "<tr>";
                echo "<td id='deletePoints'><input type='radio' id='radio-button-delete-user' name='Delete_Point' value='$check_id'/></td>";
                echo "<td id='deletePoints'>" . $row["checkpointsEN"] . "</td>";
                echo "<td id='deletePoints'>" . $row["checkpointsNO"] . "</td>";
                echo "<td id='deletePoints'>" . $row["responsible"] . "</td>";
                echo "<td id='deletePoints'>" . $row["nationality"] . "</td>";
                echo "<td id='deletePoints'>" . $row["leader"] . "</td>";
                echo "</tr>";

            }
            echo "</table>";
        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

//Funksjonen som sletter valgt punkt i sjekklisten
function deletePoint()
{
    if (isset($_POST["Delete"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $checkpointId = e($_POST["DeletePoint"]);
        $sql = "DELETE FROM Checklist WHERE idChecklist = '" . $checkpointId . "'";
        $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Checklist_idChecklist = '" . $checkpointId . "'";

        $result2 = mysqli_query($db, $sql);
        $result3 = mysqli_query($db, $sql2);

        if (!$result2) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Delete worked");</script>';
            } else {
                echo '<script type="text/javascript">alert("Punktet eksiterer ikke");</script>';
            }
        }
        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Skjekkpunktet er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke slettepunktet");</script>';
            }
        }
        mysqli_commit($db);
    }

}

//Funksjonen som sletter valgt punkt i sjekklisten i engelsk versjon
function deletePointEn()
{
    if (isset($_POST["Delet"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $checkpointId = e($_POST["Delete_Point"]);
        $sql = "DELETE FROM Checklist WHERE idChecklist = '" . $checkpointId . "'";
        $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Checklist_idChecklist = '" . $checkpointId . "'";

        $result2 = mysqli_query($db, $sql);
        $result3 = mysqli_query($db, $sql2);

        if (!$result2) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("The point in the checklist has been deleted");</script>';
            } else {
                echo '<script type="text/javascript">alert("That Point does not exist in the checklist");</script>';
            }
        }
        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Deleted all that points usage");</script>';
            } else {
                echo '<script type="text/javascript">alert("Error in deleting usage and point");</script>';
            }
        }
        mysqli_commit($db);
    }

}

//Funksjon som ikke er i bruk, tenkt brukt i å få en mer utfyllende liste over ansatte med sjekklister for sletting
function searchForEmployeeTesting()
{
    if (isset($_POST["searchFor"])) {

        global $db;

        if (!$db) {
            die("Feil i databasetilkobling:" . $db->connect_error);
        }

        $searchForEmployee = e($_POST["searchForEmployee"]);
        $qry = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $res = mysqli_query($db, $qry);
        if (!$res) {
            echo '<script type="text/javascript">alert("Query failed");</script>';
        }


        while ($row = mysqli_fetch_assoc($res)) {
            $id_new = $row['idNewemployee'];
            $f_name = $row['firstname'];
            $l_name = $row['lastname'];


            $article = '<article class="h-card vcard person-card article-contact" role="article" onclick="actRad(this.id)" id=' . $id_new . ' ><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"><input type="radio" name="DeleteEmployeeValue" id="deleteButton" value=' . $id_new . '/> ';
            $article .= $f_name . " " . $l_name . " ";
            $article .= '</h3><div class="toggler-content"><form action="" method="post"><table><tr id="tableArt"><th id="tableArt">Mine oppgaver</th><th id="tableArt"></th></tr>';
            $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND Newemployee_idNewemployee='$id_new'";
            $res2 = mysqli_query($db, $qry2);

            if (!$res2) {
                echo '<script type="text/javascript">alert("Tom resultat");</script>';
                die();
            }
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $check_id = $row2['Checklist_idChecklist'];
                $checked = $row2['checked'];
                $emp_id = $row2['Newemployee_idNewemployee'];

                $qry3 = "SELECT checkpointsNO, idChecklist from Checklist WHERE idChecklist ='$check_id'";
                $res3 = mysqli_query($db, $qry3);
                $res4 = mysqli_fetch_assoc($res3);

                $article .= '
                                         <tr id="tableArt">
                                         <td id="tableArt">';
                $article .= " " . $res4['checkpointsNO'] . " ";
                $id_check = $res4['idChecklist'];
                $article .= '</td>';
                $article .= '<td height="30px" id="tableArt" >';
                if ($checked == 0) {
                    $article .= '<input type="checkbox" class="checkbox" name="';
                    $article .= $emp_id;
                    $article .= '" value="';
                    $article .= $checked;
                    $article .= '" id="';
                    $article .= $check_id;
                    $article .= '" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"/>';

                } else {
                    $article .= '<input type="checkbox" class="checkbox" name="empty" checked   onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"';

                    $article .= $checked;

                    $article .= '">';

                }

                $article .= '</td></tr>';

            }
            //$article.='<button type="submit">Submit</button>';
            $article .= '</table></form></div></article>';
            echo $article;

        }

    }
}

//Funksjon som søker etter ansatte med sjekkliste
function searchForEmployee()
{
    if (isset($_POST["searchFor"])) {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForEmployee"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {

            echo "<tr><th>Valg</th>";
            echo "<th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Arbeidstilling</th>";
            echo "<th>Internasjonal</th>";
            echo "<th>Startdato</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                $newEmployeeId = $row["idNewemployee"];

                echo "<tr>";
                echo "<td><input type='radio' name='DeleteEmployeeValue' value='$newEmployeeId'/></td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["workposition"] . "</td>";
                echo "<td>" . $row["international"] . "</td>";
                echo "<td>" . $row["startdate"] . "</td>";
                echo "</tr>";

            }
            echo "</table><button type='submit' class='btn btn-primary' name='DeleteEmployee' >Slett ansatt</button></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

//Funksjon som sletter ansatte med sjekkliste i engelsk versjon
function deleteEmployeeEng()
{
    if (isset($_POST["DeleteEmp"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $idNewemployee2 = e($_POST["DeleteEmployeeVal"]);

        $sql = "DELETE FROM Newemployee WHERE idNewemployee = '" . $idNewemployee2 . "'";
        $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '" . $idNewemployee2 . "'";
        $sql3 = "DELETE FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '" . $idNewemployee2 . "'";

        $result3 = mysqli_query($db, $sql2);
        $result4 = mysqli_query($db, $sql3);
        $result2 = mysqli_query($db, $sql);

        if (!$result2) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Employee Deleted");</script>';
            } else {
                echo '<script type="text/javascript">alert("Cannot find Employee");</script>';
            }
        }
        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("The checklist for the employee has been deleted");</script>';
            } else {
                echo '<script type="text/javascript">alert("Cannot find the employees checklist ");</script>';
            }
        }
        if (!$result4) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Deleted this employees responsible");</script>';
            } else {
                echo '<script type="text/javascript">alert("Cannot find this employees responsible");</script>';
            }
        }
        mysqli_commit($db);
    }
}

//Funksjon som søker etter ansatte med sjekkliste
function searchForEmployeeEng()
{
    if (isset($_POST["searchF"])) {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForEmp"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {

            echo "<tr><th>Valg</th>";
            echo "<th>Firstname</th>";
            echo "<th>Surename</th>";
            echo "<th>Workposition</th>";
            echo "<th>International</th>";
            echo "<th>Startdate</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                $newEmployeeId = $row["idNewemployee"];

                echo "<tr>";
                echo "<td><input type='radio' name='DeleteEmployeeVal' value='$newEmployeeId'/></td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["workposition"] . "</td>";
                echo "<td>" . $row["international"] . "</td>";
                echo "<td>" . $row["startdate"] . "</td>";
                echo "</tr>";

            }
            echo "</table><button type='submit' class='btn btn-primary' name='DeleteEmp' >Delete Employee</button></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

//Funksjon som sletter ansatte med sjekkliste
function deleteEmployee()
{
    if (isset($_POST["DeleteEmployee"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $idNewemployee2 = e($_POST["DeleteEmployeeValue"]);

        $sql = "DELETE FROM Newemployee WHERE idNewemployee = '" . $idNewemployee2 . "'";
        $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '" . $idNewemployee2 . "'";
        $sql3 = "DELETE FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '" . $idNewemployee2 . "'";

        $result3 = mysqli_query($db, $sql2);
        $result4 = mysqli_query($db, $sql3);
        $result2 = mysqli_query($db, $sql);

        if (!$result2) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Newemployee er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke Newemployee");</script>';
            }
        }
        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Newemployee_has_Checklist er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke Newemployee_has_Checklist");</script>';
            }
        }
        if (!$result4) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Users_has_Newemployee er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke Users_has_Newemployee");</script>';
            }
        }
        mysqli_commit($db);
    }
}

//Funksjon som søker etter bruker
function searchForUser()
{
    if (isset($_POST["searchForUser"])) {

        echo "<form action='' method='post'><div style='overflow-x:auto;'><table>";
        global $db, $errors;
        $searchForUser = e($_POST["userSearch"]);
        $sql = "SELECT * FROM Users WHERE Users.firstname LIKE '".$searchForUser."%'  OR Users.lastname LIKE '".$searchForUser."%' ORDER BY Users.lastname, Users.firstname";
        $result = $db->query($sql);


        if ($result) {

            echo "<tr id='delete-checkpoint-header'><th>Valg</th>";
            echo "<th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Brukernavn</th>";
            echo "<th>Brukertype</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                $newUserId = $row["idUsers"];

                echo "<tr>";
                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteUserValue' value='$newUserId'/></td>";
                echo "<td id='searchForDeleteUser'>" . $row["firstname"] . "</td>";
                echo "<td id='searchForDeleteUser'>" . $row["lastname"] . "</td>";
                echo "<td id='searchForDeleteUser'>" . $row["username"] . "</td>";
                echo "<td id='searchForDeleteUser'>" . $row["usertype"] . "</td>";
                echo "</tr>";

            }
            echo "</table><button type='submit' class='btn btn-primary' name='DeleteUser' >Slett bruker</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

//Funksjon som søker etter bruker i engelsk versjon
function searchForUserEng()
{
    if (isset($_POST["searchForU"])) {
        echo "<form action='' method='post'><div style='overflow-x:auto;'><table>";

        global $db, $errors;
        $searchForUser = e($_POST["userS"]);
        $sql = "SELECT * FROM Users WHERE Users.firstname LIKE '" . $searchForUser . "%'  OR Users.lastname LIKE '" . $searchForUser . "%' ORDER BY Users.lastname, Users.firstname";
        $result = $db->query($sql);


        if ($result) {

            echo "<tr id='delete-checkpoint-header'><th>Valg</th>";
            echo "<th>Firstname</th>";
            echo "<th>Surename</th>";
            echo "<th>Username</th>";
            echo "<th>Usertype</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                $newUserId = $row["idUsers"];

                echo "<tr>";
                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteUserV' value='$newUserId'/></td>";
                echo "<td id='searchForDeleteUser'>" . $row["firstname"] . "</td>";
                echo "<td id='searchForDeleteUser'>" . $row["lastname"] . "</td>";
                echo "<td id='searchForDeleteUser'>" . $row["username"] . "</td>";
                echo "<td id='searchForDeleteUser'>" . $row["usertype"] . "</td>";
                echo "</tr>";

            }
            echo "</table><button type='submit' class='btn btn-primary' name='DeleteU' >Delete User</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

//Funksjon som sletter bruker
function deleteUser()
{
    if (isset($_POST["DeleteUser"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $idUsers2 = e($_POST["DeleteUserValue"]);

        $sql = "DELETE FROM Users WHERE idUsers = '" . $idUsers2 . "'";
        $sql2 = "DELETE FROM Users_has_Newemployee WHERE Users_idUsers = '" . $idUsers2 . "'";

        echo $sql . "<br>" . $sql2;

        $result3 = mysqli_query($db, $sql2);
        $result2 = mysqli_query($db, $sql);

        if (!$result2) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("User er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke User");</script>';
            }
        }
        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Users_has_Newemployee er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke Users_has_Newemployee");</script>';
            }
        }
        mysqli_commit($db);
    }
}

//Funksjon som sletter bruker i engelsk versjon
function deleteUserEng()
{
    if (isset($_POST["DeleteU"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $idUsers2 = e($_POST["DeleteUserV"]);

        $sql = "DELETE FROM Users WHERE idUsers = '" . $idUsers2 . "'";
        $sql2 = "DELETE FROM Users_has_Newemployee WHERE Users_idUsers = '" . $idUsers2 . "'";

        echo $sql . "<br>" . $sql2;

        $result3 = mysqli_query($db, $sql2);
        $result2 = mysqli_query($db, $sql);

        if (!$result2) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("User is deleted");</script>';
            } else {
                echo '<script type="text/javascript">alert("Cannot find this user");</script>';
            }
        }
        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Deleted the relation between this user and his responsibilities ");</script>';
            } else {
                echo '<script type="text/javascript">alert("Cannot find this users responsibilities ");</script>';
            }
        }
        mysqli_commit($db);
    }
}
