        <div class="widget">
            <div class="whead"><h6><?php echo $user['name']; ?></h6><!--<a href="#" class="buttonH bBlue" title="">View all</a>--></div>
            <div class="body"><?php
                foreach ($assets as $asset) {
                    echo '<p></p><a href="/assets/view/'.$asset['id'].'">* '.$asset['name'].' ('.$asset['barcode'].')</a></p>';
                }
            ?></div>
        </div>