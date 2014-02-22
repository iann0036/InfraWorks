<div class="widget">
    <div class="whead"><h6>Products Modify</h6><a href="/products/view/<?php echo $id; ?>" class="buttonH bLightBlue" title="">Back to Product View</a></div>
    <div class="body">
        <p><font style="color: #FF0000;"><b>WARNING: </b>Modification of a product in any way will remove all assets relating to it</font></p>

        <!-- Dialog content -->
        <div id="formDialog" class="dialog" title="Add Field">
            <form action="">
                <!--<label>Text field:</label>-->
                <input type="text" id="fieldname" name="fieldname" class="clear" placeholder="Field Name" />
                <div class="divider"><span></span></div>
                <div class="dialogSelect m10">
                    <label>Type:</label>
                    <select id="fieldtype" name="fieldtype" class="styled">
                        <option value="txt">Text Field (single line)</option>
                        <option value="txtu">Text Field (unlimited)</option>
                        <option value="select">Dropdown</option>
                    </select>
                </div>
                <div class="divider"><span></span></div>
                <label>Options:</label>
                <textarea rows="8" cols="" id="fieldoptions" name="fieldoptions" class="auto" placeholder="Comma-seperated options or input mask"></textarea>
                <!--<div>
                    <span class="floatL"><input type="radio" name="dialogRadio" /><label>Radio</label></span>
                    <span class="floatR"><input type="checkbox" class="check" name="dialogCheck" checked="checked" /><label>Checkbox</label></span>
                </div>-->
            </form>
        </div>

        <p><a href="#" class="tablectrl_small bGreyish tipS" original-title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a> <b>Barcode</b> - Text Field (single line)</p>
        <div id="custom_fields"></div>
        <p><a href="#" class="tablectrl_small bGreyish tipS" original-title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a> <b>Notes</b> - Text Field (unlimited)</p>

        <p><a href="#" class="buttonM bBlue" id="formDialog_open"><span class="icon-plus"></span><span>Add Field</span></a>&nbsp;<a onclick="doSave()" href="#" class="buttonM bGreen"><span class="icon-checkmark-3"></span><span>Save</span></a></p>
    </div>
</div>

<form id="saveDataPost" style="display: none;" action="/products/fields" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input id="fieldstring" type="hidden" name="fieldstring" />
</form>

<script>
    var custom_fields = new Array();

    function doSave() {
        document.getElementById('fieldstring').value = JSON.stringify(custom_fields);
        document.getElementById('saveDataPost').submit();
    }

    function addCustomField(name,type,options) {
        var custom_field = new Array(name,type,options);
        custom_fields.push(custom_field);

        var newFieldHTML = '<p><a href="#" class="tablectrl_small bRed tipS" original-title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a> <b>' + name + '</b> - ';
        if (type=='txt')
            newFieldHTML += 'Text Field (single line)';
        else if (type=='txtu')
            newFieldHTML += 'Text Field (unlimited)';
        else
            newFieldHTML += 'Dropdown';
        newFieldHTML += '</p>';
        document.getElementById('custom_fields').innerHTML += newFieldHTML;
    }

    <?php
        foreach ($fields as $field) {
            echo 'addCustomField("'.$field['name'].'","'.$field['type'].'","'.$field['options'].'");';
        }
    ?>
</script>