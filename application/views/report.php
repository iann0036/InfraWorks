        <div class="widget">
            <div class="whead"><h6>Report</h6></div>
            <div class="body">
                <?php
                    foreach ($report as $user) {
                        echo '<h6><a href="/users/view/'.$user['username'].'">'.$user['name'].'</a> ('.$user['username'].')</h6>';
                        if (count($user['assets'])==0)
                            echo '<p></p><b>No assets for this user</b></p>';
                        foreach ($user['assets'] as $asset) {
                            echo '<p>';
                            echo '<b>Barcode: </b>'.$asset['barcode'].'<br />';
                            echo '<b>Product: </b>'.$asset['name'].'<br />';

                            for ($i=0; $i<count($asset['fields']); $i++) {
                                echo '<b>'.$asset['fields'][$i]['name'].': </b>';
                                if (isset($asset['field_values'][$asset['fields'][$i]['id']]))
                                    echo $asset['field_values'][$asset['fields'][$i]['id']];
                                echo '<br />';
                            }
                            echo '<b>Notes: </b>'.$asset['notes'].'<br />';

                            echo '</p>';
                        }
                        echo '<br />';
                    }
                ?>
            </div>
        </div>