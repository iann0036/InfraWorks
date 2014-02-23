        <div class="widget">
            <div class="whead"><h6>Products View</h6><a onclick="confirmProductDelete()" class="buttonH bRed" title="">Delete Product</a><a href="/products/modify/<?php echo $id; ?>" class="buttonH bBlue" title="">Edit Product Fields</a></div>
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

        <div id="cannot-delete-modal" title="Cannot Delete">
            <p>You cannot delete this product as assets are assigned under it</p>
        </div>

        <div id="confirm-delete-modal" title="Confirm Delete">
            <p>Confirm you wish to delete this product named <b><?php echo $name; ?></b></p>
        </div>

        <script>
            $('#confirm-delete-modal').dialog({
                autoOpen: false,
                width: 400,
                modal: true,
                buttons: {
                    "Confirm Delete": function() {
                        window.location = "/products/remove/<?php echo $id; ?>";
                        $( this ).dialog( "close" );
                    },
                    "Close": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });

            $('#cannot-delete-modal').dialog({
                autoOpen: false,
                width: 400,
                modal: true,
                buttons: {
                    "Okay": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });

            function confirmProductDelete() {
                <?php
                if (count($assets)>0)
                    echo "$('#cannot-delete-modal').dialog('open');";
                else
                    echo "$('#confirm-delete-modal').dialog('open');";
                ?>
            }
        </script>