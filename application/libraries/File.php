<?php
defined('BASEPATH') OR exit('No direct script access allowed');


 class File extends CI_Controller 
{

        public function get_filelist_as_array($dir, $recursive = true, $basedir = '', $include_dirs = false) {
            if ($dir == '') {return array();} else {$results = array(); $subresults = array();}
            if (!is_dir($dir)) {$dir = dirname($dir);} // so a files path can be sent
            if ($basedir == '') {$basedir = realpath($dir).DIRECTORY_SEPARATOR;}

            $files = scandir($dir);
            foreach ($files as $key => $value){
                if ( ($value != '.') && ($value != '..') ) {
                    $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
                    if (is_dir($path)) {
                        // optionally include directories in file list
                        if ($include_dirs) {$subresults[] = str_replace($basedir, '', $path);}
                        // optionally get file list for all subdirectories
                        if ($recursive) {
                            $subdirresults = get_filelist_as_array($path, $recursive, $basedir, $include_dirs);
                            $results = array_merge($results, $subdirresults);
                        }
                    } else {
                        // strip basedir and add to subarray to separate file list
                        $subresults[] = str_replace($basedir, '', $path);
                    }
                }
            }
            // merge the subarray to give the list of files then subdirectory files
            if (count($subresults) > 0) {$results = array_merge($subresults, $results);}
            
            return $results;
        }
}
?>
