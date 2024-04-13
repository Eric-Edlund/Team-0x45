<?php include 'top.php';?>
<pre>
CREATE TABLE tblPhishingSurvey(
        pmkPhishingSurveyID INT AUTO_INCREMENT PRIMARY KEY,
        fldNetID VARCHAR(16),
        fldFirstName VARCHAR(20),
        fldLastName VARCHAR(20),
        fldPhishingContent VARCHAR(10000)
    );
</pre>