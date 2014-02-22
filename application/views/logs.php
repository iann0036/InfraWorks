        <div class="widget">
            <div class="whead"><h6>Logs</h6></div>
            <div class="body">
                <textarea rows="30"><?php
                    foreach ($logs as $log) {
                        echo '* '.$log['time'].' - '.$log['username'].' - '.$log['message'].'
';
                    }
                ?>
                </textarea>
            </div>
        </div>