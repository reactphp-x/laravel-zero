<?php
/**
 *  Finds next execution time(stamp) parsin crontab syntax.
 *
 * @param string $crontab_string :
 *   0    1    2    3    4    5
 *   *    *    *    *    *    *
 *   -    -    -    -    -    -
 *   |    |    |    |    |    |
 *   |    |    |    |    |    +----- day of week (0 - 6) (Sunday=0)
 *   |    |    |    |    +----- month (1 - 12)
 *   |    |    |    +------- day of month (1 - 31)
 *   |    |    +--------- hour (0 - 23)
 *   |    +----------- min (0 - 59)
 *   +------------- sec (0-59)
 */
return [
    'enabled' => true,
    'every_second' => '* * * * * *',
];