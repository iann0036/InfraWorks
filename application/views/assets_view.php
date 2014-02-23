
        <div class="widget">
            <div class="whead"><h6>Assets View</h6><a href="/assets/remove/<?php echo $id; ?>" class="buttonH bRed" title="">Delete Asset</a><a href="/assets/reassign/<?php echo $id; ?>" class="buttonH bGreen" title="">Reassign Asset</a><a href="/assets/modify/<?php echo $id; ?>" class="buttonH bBlue" title="">Edit Asset</a></div>
            <div class="body">
                <p><b>Assigned to <a href="/users/view/<?php echo $username; ?>r"><?php echo $user_name; ?></a></b></p>
                <p><b>Product: </b><?php echo $name; ?></p>
                <p><b>Barcode: </b><?php echo $barcode; ?></p>
                <?php
                    foreach ($fields as $field) {
                        if (isset($field_values[$field['id']])) {
                            if ($field['type']=='select') {
                                $options = explode(',',$field['options']);
                                echo '<p><b>'.$field['name'].': </b>'.$options[$field_values[$field['id']]].'</p>';
                            } else
                                echo '<p><b>'.$field['name'].': </b>'.$field_values[$field['id']].'</p>';
                        } else
                            echo '<p><b>'.$field['name'].': </b></p>';
                    }
                ?>
                <p><b>Notes: </b><?php echo $notes; ?></p>
            </div>
        </div>