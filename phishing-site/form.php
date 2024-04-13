<?php include 'top.php';

$dataIsGood = false;
$message = '';

$netID = '';
$firstName = '';
$lastName = '';
$phishingContent = '';

function getData($field) {
    if(!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
        }
        return $data;
}

function verifyAlphaNum($testString) {
    //check for letters, numbers, dash, period, space, and single quote only.
    //added & ; and # as single quote sanitized with html elements

    return(preg_match("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}




?>

<main>
    <h1>Tell us about your experience:</h1>
    <section>
        <h2>What to do:</h2>
        <p></p>
    </section>

    <?php

if($_SERVER["REQUEST_METHOD"] == 'POST') {

    // Sanitize Data
    
    $netID = getData('txtNetID');
    $firstName = getData('txtFirstName');
    $lastName = getData('txtLastName');
    $phishingContent = getData('tareaPhishingContent');

    // Validation
    $dataIsGood = true;
        // Net ID
    if($netID == ""){
        $message .= "Net ID field left blank.\n" . PHP_EOL;
        $dataIsGood = false;
    } else if (!verifyAlphaNum($netID)) {
        $message .= "Net ID contains invalid characters.\n" . PHP_EOL;
        $dataIsGood = false;
    }
        // First Name
    if($firstName == ""){
        $message .= "First Name field left blank.\n" . PHP_EOL;
        $dataIsGood = false;
    } else if (!verifyAlphaNum($firstName)) {
        $message .= "First Name contains invalid characters.\n" . PHP_EOL;
        $dataIsGood = false;
    }
        // Last Name
    if($lastName == ""){
        $message .= "Last Name field left blank.\n" . PHP_EOL;
        $dataIsGood = false;
    } else if (!verifyAlphaNum($lastName)) {
        $message .= "Last Name contains invalid characters.\n" . PHP_EOL;
        $dataIsGood = false;
    }

        // Phishing Content
    if($phishingContent == ""){
        $message .= "Phishing Content field left blank.\n" . PHP_EOL;
        $dataIsGood = false;
    } else if (!verifyAlphaNum($phishingContent)) {
        $message .= "Phishing Content contains invalid characters.\n" . PHP_EOL;
        $dataIsGood = false;
    }


    //save data
    if($dataIsGood){
        try{
            $sql = 'INSERT INTO tblPhishingSurvey (fldNetID, fldFirstName, 
            fldLastName, fldPhishingContent) VALUES 
            (?, ?, ?, ?)';
                $statement = $pdo->prepare($sql);
                $data = array($netID, $firstName, $lastName, $phishingContent);

                if($statement->execute($data)){
                    $message = '<h2>Thank you</h2>';
                    $message .= '<p>Your information was successfully submitted.</p>';

                } else {
                    $message = 'Information NOT successfully saved.';
                }
        } catch(PDOException $e){
            $message = 'Could not insert the record, please contact
            aschaef1@uvm.edu';
        }
    }
    print '<p>' . $message . '</p>' . PHP_EOL;
} // end submitting form
?>

<section class="form-section">
<form action="#" method="POST">
    <fieldset>
        <legend>Contact Information:</legend>
        <p>
            <label for="txtNetID">What is your Net ID?</label>
            <input type="text" name="txtNetID" id="txtNetID" 
            maxlength="30" tabindex="300" value="<?php print $netID; ?>">
        </p>
        <p>
            <label for="txtFirstName">What is your first name?</label>
            <input type="text" name="txtFirstName" id="txtFirstName" 
            maxlength="30" tabindex="300" value="<?php print $firstName; ?>">
        </p>
        <p>
            <label for="txtLastName">What is your last name?</label>
            <input type="text" name="txtLastName" id="txtLastName" 
            maxlength="30" tabindex="300" value="<?php print $lastName; ?>">
        </p>
    </fieldset>
    <fieldset>
        <p>
            <label for="tareaPhishingContent">Include the content of the phishing email below:</label>
            <textarea id="tareaPhishingContent" name="tareaPhishingContent" rows="4" cols="25"
            tabindex="600" maxlength="10000"><?php print $phishingContent; ?></textarea>
        </p>
    </fieldset>
    <fieldset>
        <input id="btnSubmit" name="btnSubmit" type="submit" tabindex="999">
    </fieldset>
</form>





</section>

</main>

</body>
</html>