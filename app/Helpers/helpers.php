<?php
    if (! function_exists('uploadFile')) {
        function uploadFile($nameFolder, $file)
        {
            $fileName = $file->getClientOriginalName();
            return $file->storeAS($nameFolder, $fileName, 'public');
        }
    }
?>
