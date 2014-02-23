        <div class="widget">
            <div class="whead"><h6>Products View</h6><a href="/products/remove/<?php echo $id; ?>" class="buttonH bRed" title="">Delete Product</a><a href="/products/modify/<?php echo $id; ?>" class="buttonH bBlue" title="">Edit Product Fields</a></div>
            <div class="body">
                <ul>
                    <li>
                        <b>Barcode</b> - Text Field (single line)
                    </li>
                    <?php
                        foreach ($fields as $field) {
                            echo '<li><b>'.$field['name'].'</b> - ';
                            if ($field['type']=='txt')
                                echo 'Text Field (single line)';
                            else if ($field['type']=='txtu')
                                echo 'Text Field (unlimited)';
                            else
                                echo 'Dropdown';
                            echo ' </li>';
                        }
                    ?>
                    <li>
                        <b>Notes</b> - Text Field (unlimited)
                    </li>
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="whead"><h6>Users with Product</h6></div>
            <div class="body">
                <ul>
                    <?php
                        foreach ($assets as $asset) {
                            echo '<li><a href="/assets/view/'.$asset['id'].'">* '.$asset['user_name'].'</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>