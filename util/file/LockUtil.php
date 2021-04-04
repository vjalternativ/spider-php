<?php

class LockUtil
{

    private $lockFile;

    private $logger;

    public function LockUtil($lockFile)
    {
        $this->lockFile = $lockFile;
        $this->logger = lib_logger::getLogger("filelock.log");
    }

    function acquireLockForConversion()
    {
        if (file_exists($this->lockFile)) {
            $str = file_get_contents($this->lockFile);
            $str = trim($str);
            $pid = substr($str, strpos($str, "by ") + 3, (strpos($str, " at") - strpos($str, "by ") - 3));
            $cmd = 'ps -p ' . $pid . '|wc -l';
            $res = shell_exec($cmd);
            $res = trim($res);
            if ($res < 2) {
                $this->releaseLock();
            }
        }

        $f = fopen($this->lockFile, 'x');
        if ($f) {
            $me = getmypid();
            $now = date('Y-m-d H:i:s');
            fwrite($f, "Locked by $me at $now\n");
            fclose($f);
        } else {
            $this->logger->warn("waiting for unlock");
            sleep(5);
            $this->acquireLockForConversion();
        }
    }

    function releaseLock()
    {
        unlink($this->lockFile);
    }
}
?>