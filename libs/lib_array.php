<?php

class lib_array
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new lib_array();
        }
        return self::$instance;
    }

    public function transformArrayToMatrix($array, $cols, $depth = 0, $depthIndex = 0, $matrix = array())
    {
        foreach ($array as $item) {
            if ($depthIndex == $depth) {
                $matrixLen = count($matrix);

                if ($matrixLen == 0) {
                    $matrix[0][] = $item;
                } else {
                    $row = $matrixLen - 1;

                    $rowLen = count($matrix[$row]);

                    if ($cols == $rowLen) {
                        $row ++;
                    }

                    $matrix[$row][] = $item;
                }
            } else {
                $dindex = $depthIndex + 1;

                $matrix = $this->transformArrayToMatrix($item, $cols, $depth, $dindex, $matrix);
            }
        }

        $row = count($matrix);
        if ($row != 0) {
            $row --;
            $lastRowLen = count($matrix[$row]);
            if ($lastRowLen != $cols) {
                for ($lastRowLen = $lastRowLen; $lastRowLen < $cols; $lastRowLen ++) {
                    $matrix[$row][] = null;
                }
            }
        }
        return $matrix;
    }
}
?>