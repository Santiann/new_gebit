<?php

Route::any('general/general/upload/{input?}', 'General\General\Components\Upload\Http\Controllers\Uploader@upload');