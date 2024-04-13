<!--nav.php run start-->
        <nav>
            <a class="<?php
            if($pathParts['filename']=='main'){
                print 'activePage';
            }
            ?>" href="index.php">Home&nbsp;</a>
            
            <a class="<?php
            if($pathParts['filename']=='form'){
                print 'activePage';
            }
            ?>" href="form.php">Form&nbsp;</a>
            
        </nav>
<!--nav.php run end-->