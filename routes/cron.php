<?php

use ReactphpX\Crontab\Crontab;

new Crontab(config('cron.every_second'), function () {
    echo 'every_second: '. date('Y-m-d H:i:s') . "\n";
});

//todo add more crontab