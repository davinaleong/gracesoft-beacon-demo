<?php

return [
    'retention_minutes' => max((int) env('DEMO_RETENTION_MINUTES', 24 * 60), 1),
];
