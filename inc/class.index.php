<?php

class Dicrectory {

    protected $dir;
    protected $entryName;
    protected $dirArray;
    protected $indexCount;

    /**
     * Construct
     */
    function __construct() {
        /* date_default_timezone_set */
        date_default_timezone_set('Asia/Kuala_Lumpur');

        /* default dicrectory */
        $this->dir = "Your_Folder_Path";

        $this->generate();
        $this->get_all_dir();
    }

    /**
     * Generate directory attribute
     */
    private function generate() {
        if ($handle = opendir($this->dir)) {
            // get each entry
            while (false !== ($this->entryName = readdir($handle))) {
                if ($this->entryName != '.' && $this->entryName != '..' && is_dir($this->entryName)) {
                    $this->dirArray[] = $this->entryName;
                }
            }
            // close directory
            closedir($handle);
        }
    }

    /**
     * Define name for attribut directory
     */
    private function get_all_dir() {
        $arraFinal = [];
        $directory = $this->dirArray;
        $indexCount = count($directory);

        for ($index = 1; $index < $indexCount; $index++):
            if (substr("$directory[$index]", 0, 1) != "." && $directory[$index] != 'inc') {// don't list hidden files
                $arraFinal[] = array(
                    "file" => "$directory[$index]",
                    "name" => ucwords(str_replace('_', ' ', $directory[$index])),
                    "type" => mime_content_type("$directory[$index]"),
                    "size" => $this->formatBytes(filesize("$directory[$index]")),
                    "created" => date('d-m-Y H:i:s', filectime("$directory[$index]")),
                    "modified" => date('d-m-Y H:i:s', filemtime("$directory[$index]"))
                );
            }
        endfor;
        $this->dirArray = $arraFinal;
    }

    /**
     * Final array for use in index.php
     * @return type
     */

    public function finals() {
        return $this->dirArray;
    }

    /**
     * Convert Byte to other Unit
     * @param type $bytes
     * @param type $precision
     * @return type
     */
    private function formatBytes($bytes, $precision = 0) {
        $unit = ["B", "KB", "MB", "GB"];
        $exp = floor(log($bytes, 1024)) | 0;
        return round($bytes / (pow(1024, $exp)), $precision) . " " . $unit[$exp];
    }

}
