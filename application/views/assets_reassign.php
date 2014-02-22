
        <div class="widget">
            <div class="whead"><h6>Asset Reassign</h6></div>
            <div class="body">
                <p><b>Current User: </b><?php echo $user_name; ?></p>
                <p><b>New User: </b>
                    <select name="username" class="styled">
                        <?php
                        foreach ($users as $user) {
                            if ($user['username']!=$username) {
                                echo '<option value="'.$user['username'].'">'.$user['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </p>
                <br /><hr>
                <p><b>Product: </b><?php echo $name; ?></p>
                <p><b>Barcode: </b><?php echo $barcode; ?></p>
                <?php
                    foreach ($fields as $field) {
                        if (isset($field_values[$field['id']]))
                            echo '<p><b>'.$field['name'].': </b>'.$field_values[$field['id']].'</p>';
                        else
                            echo '<p><b>'.$field['name'].': </b></p>';
                    }
                ?>
                <p><b>Notes: </b><?php echo $notes; ?></p>
                <p><a onclick="doReassign()" href="#" class="buttonM bGreen"><span class="icon-checkmark-3"></span><span>Reassign</span></a></p>
            </div>
        </div>
