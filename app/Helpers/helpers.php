<?php 
if (! function_exists('greet')) {
    function getColumnName($columnIndex) {
        $columnName = '';
    
        while ($columnIndex > 0) {
            $modulo = ($columnIndex - 1) % 26;
            $columnName = chr(65 + $modulo) . $columnName;
            $columnIndex = (int)(($columnIndex - $modulo) / 26);
        }
    
        return $columnName;
    }
}