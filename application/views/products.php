        <div class="fluid">
            <div class="grid8">
                <div class="widget">
                    <div class="whead"><h6>Current Products</h6></div>
                    <ul class="updates">
                        <?php
                            foreach ($products as $product) {
                                if (strlen($product['description'])<1)
                                    $product['description'] = '&nbsp;';
                                echo '<li><div class="wNews"><div class="announce"><a href="/products/view/'.$product['id'].'" title="">'.$product['name'].'</a><span>'.$product['description'].'</span></div> </div> <span class="uDate"><span>'.$product['count'].'</span></span></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="grid4">
                <form action="/products/add/" method="post">
                <fieldset>
                    <div class="widget fluid">
                        <div class="whead"><h6>Add Product</h6></div>
                        <div class="formRow">
                            <div class="grid3"><label>Name:</label></div>
                            <div class="grid9"><input type="text" name="name"></div>
                        </div>
                        <div class="formRow">
                            <div class="grid3"><label>Description:</label></div>
                            <div class="grid9"><input type="text" name="description"></div>
                        </div>
                        <div class="formRow">
                            <div class="grid3">&nbsp;</div>
                            <div class="grid9"><input type="submit" class="buttonS bGreen" value="Add Product"></div>
                        </div>
                </fieldset>
                </form>
            </div>
        </div>