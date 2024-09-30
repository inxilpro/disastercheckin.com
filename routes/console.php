<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('cloudflare:reload')->daily();
