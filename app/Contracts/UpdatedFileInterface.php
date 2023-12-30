<?php

namespace App\Contracts;


interface UpdatedFileInterface{
    public function update_file($model, $file, $destination);
    public function delete_file($file);
}


