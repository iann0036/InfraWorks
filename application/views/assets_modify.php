<form id="modifyAssetForm" action="/assets/modifyasset/" method="post" class="main">
<fieldset>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <div class="widget fluid">
        <div class="whead"><h6>Input fields</h6></div>
        <div class="formRow">
            <div class="grid3"><label>Barcode:</label></div>
            <div class="grid9">
                <input type="text" name="barcode" value="<?php echo $barcode; ?>" />
            </div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>User:</label></div>
            <div class="grid9">
                <select name="username" class="styled">
                    <?php
                        foreach ($users as $user) {
                            if ($user['username']==$username)
                                echo '<option selected value="'.$user['username'].'">'.$user['name'].'</option>';
                            else
                                echo '<option value="'.$user['username'].'">'.$user['name'].'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>Product:</label></div>
            <div class="grid9">
                <select id="product" name="product" class="styled" onchange="updateFields()">
                    <?php
                    foreach ($products as $product) {
                        if ($product['id']==$product_id)
                            echo '<option selected value="'.$product['id'].'">'.$product['name'].'</option>';
                        else
                            echo '<option value="'.$product['id'].'">'.$product['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div id="customFields">
            <?php
            for ($i=0; $i<count($fields); $i++) {
                echo '<div class="formRow"><div class="grid3"><label>'.$fields[$i]['name'].':</label></div><div class="grid9">';
                if ($fields[$i]['type']=='txt') {
                    echo '<input id="field_'.$fields[$i]['id'].'" name="field_'.$fields[$i]['id'].'" type="text"';
                    if (isset($field_values[$fields[$i]['id']]))
                        echo 'value="'.$field_values[$fields[$i]['id']].'"';
                    echo ' />';
                } else if ($fields[$i]['type']=='txtu') {
                    echo '<textarea id="field_'.$fields[$i]['id'].'" name="field_'.$fields[$i]['id'].'" rows="8">';
                    if (isset($field_values[$fields[$i]['id']]))
                        echo $field_values[$fields[$i]['id']];
                    echo '</textarea>';
                } else
                    echo '<select id="field_'.$fields[$i]['id'].'" name="field_'.$fields[$i]['id'].'" class="styled"></select>';
                echo '</div></div>';
            }
            ?>
        </div>
        <div class="formRow">
            <div class="grid3"><label>Notes:</label></div>
            <div class="grid9">
                <textarea rows="8" cols="" name="notes"><?php echo $notes; ?></textarea>
            </div>
        </div>
        <div class="formRow">
            <div class="grid3"><label>&nbsp;</label></div>
            <div class="grid9">
                <a onclick="doSave()" href="#" class="buttonM bGreen"><span class="icon-checkmark-3"></span><span>Save</span></a>
            </div>
        </div>
    </div>
</fieldset>
</form>

<script>
    function doSave() {
        document.getElementById('modifyAssetForm').submit();
    }

    function updateFields() {
        console.log('Updating fields');

        document.getElementById('customFields').innerHTML = ''; // clear fields

        var product_id = document.getElementById('product').options[document.getElementById('product').selectedIndex].value;

        $.ajax({
            url: "/ajax/getFields/" + product_id
        }).done(function(msg) {
            var fields = JSON.parse(msg);
            for (var i=0; i<fields.length; i++) {
                fieldHTML = '<div class="formRow"><div class="grid3"><label>' + fields[i]['name'] + ':</label></div><div class="grid9">';
                if (fields[i]['type']=='txt')
                    fieldHTML += '<input id="field_' + fields[i]['id'] + '" name="field_' + fields[i]['id'] + '" type="text" />';
                else if (fields[i]['type']=='txtu')
                    fieldHTML += '<textarea id="field_' + fields[i]['id'] + '" name="field_' + fields[i]['id'] + '" rows="8"></textarea>';
                else
                    fieldHTML += '<select id="field_' + fields[i]['id'] + '" name="field_' + fields[i]['id'] + '" class="styled"></select>';
                fieldHTML += '</div></div>';
                document.getElementById('customFields').innerHTML += fieldHTML;
            }
        });
    }
</script>