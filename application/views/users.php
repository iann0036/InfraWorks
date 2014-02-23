        <div class="widget">
            <div class="whead"><h6>All users</h6><!--<a href="#" class="buttonH bBlue" title="">View all</a>--></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="tAlt wGeneral">
                <thead>
                <tr>
                    <td>Name</td>
                    <td width="100px">Asset Count</td>
                    <!--<td width="150px">Actions</td>-->
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($users as $user) {
                        echo '<tr><td><a href="/users/view/'.$user['username'].'" title="">'.$user['name'].' ('.$user['username'].')'.'</a><a href="/users/view/'.$user['username'].'" title="" class="email">'.$user['email'].'</a></td><td align="center">';
                        if ($user['assetcount']>0)
                            echo '<strong>'.$user['assetcount'].'</strong><span>'.$user['assetcount'].' assets</span>';
                        else
                            echo '<strong style="color: #FF0000;">0</strong><span>no assets</span>';
                        echo '</td><!--<td align="center"><a href="/users/expire/'.$user['username'].'" class="buttonS bRed ">Expire User</a></td>--></tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>