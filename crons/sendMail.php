<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'include/lib/PHPMailer-master/src/SMTP.php';
require_once $vjconfig['fwbasepath'] . 'include/lib/PHPMailer-master/src/PHPMailer.php';

class SendMail
{

    /**
     * This function will send notification when email account sends more than 478 mails in a day
     *
     * @param
     *            $account_details
     * @return boolean
     */
    function sendAccountReachedNotification($account_details)
    {
        return false;
        $mailer = new PHPMailer();
        $mailer->AddAddress("rahulsingh@drishti-soft.com", '');
        $mailer->AddAddress("vijaykumar@drishti-soft.com", '');
        $mailer->AddAddress("team-it@drishti-soft.com", '');
        $mailer->AddAddress("skumar@drishti-soft.com", '');
        $mailer->Host = $account_details['mail_server'];
        $mailer->Port = $account_details['mail_port'];
        $mailer->SMTPSecure = 'ssl';
        $mailer->IsSMTP();
        // $mailer->SMTPDebug = 2;
        $mailer->IsHTML(true); // send as HTML
        $mailer->SMTPAuth = true; // turn on SMTP authentication
        $mailer->Username = $account_details['user_name']; // SMTP username
        $mailer->Password = $account_details['mail_password']; // SMTP password
        $mailer->SetFrom($account_details['from_address'], $account_details['from_name']);
        $mailer->Subject = html_entity_decode($account_details['user_name'] . ':- EMAIL ACCOUNT for Context ' . $account_details["context"] . ' DAILY
 USAGE 1980 REACHED NOTIFICATION', ENT_QUOTES);
        $mailer->Body = html_entity_decode("EMAIL BUFFER ACCOUNT " . $account_details['user_name'] . " FOR CONTEXT " . $account_details['context'], ENT_QUOTES);
        if ($mailer->Send()) {
            return true;
        }
        return false;
    }

    /**
     * This function will get all available context accounts
     *
     * @return <number, multitype:number >
     */
    function getAllContexts()
    {
        $db = lib_mysqli::getInstance();

        $contexts = array();
        $contexts['overallLimit'] = 0;
        $today = date('Y-m-d');
        $sqlGetContext = "SELECT oea.* FROM outbound_email_accounts oea
            WHERE oea.used_today is null or oea.used_today < oea.maxlimit or oea.date_last_used != '$today'  order by oea.used_today ASC";
        $resultGetContext = $db->query($sqlGetContext);

        while ($contextTuple = $db->fetch($resultGetContext)) {

            $contextTuple['context'] = strtolower($contextTuple['context']);

            $contexts[$contextTuple['context']]['accounts'][] = $contextTuple;
            $contexts['indexes'][$contextTuple['context']] = $contextTuple['context'];
            $contexts[$contextTuple['context']]['pointer'] = 0;
            $contexts['overallLimit'] = $contexts['overallLimit'] + 25;

            if (! isset($contexts[$contextTuple['context']][$contextTuple['id']]['available'])) {
                $contexts[$contextTuple['context']][$contextTuple['id']]['available'] = 25;
            }

            if (! isset($contexts['accountsCount'][$contextTuple['context']])) {
                $contexts['accountsCount'][$contextTuple['context']] = 1;
            } else {
                $contexts['accountsCount'][$contextTuple['context']] += 1;
            }

            if (! isset($contexts[$contextTuple['context']]['available'])) {
                $contexts[$contextTuple['context']]['available'] = 25;
            } else {
                $contexts[$contextTuple['context']]['available'] = $contexts[$contextTuple['context']]['available'] + 5;
            }
        }

        return $contexts;
    }

    /**
     * This function will get all not send mails with maximum 2 attempts
     *
     * @param
     *            $contexts
     * @param
     *            $last_used
     * @return <multitype:, number, string>
     */
    function getAllNotSentEmails($contexts, $last_used)
    {
        $db=  lib_mysqli::getInstance();
        $emails = array();
        $sqlGetEmailContextMatrix = "SELECT * FROM email_buffer WHERE (is_sent_successfully=0 or is_sent_successfully is null) AND (last_attempt < DATE_SUB(NOW(), INTERVAL " . $last_used . " HOUR) or last_attempt is null) AND (send_attempts < 3 or send_attempts is null) ORDER BY date_entered desc";
        $resultGetEmailContextMatrix = $db->query($sqlGetEmailContextMatrix);

        while ($emailTuple = $db->fetch($resultGetEmailContextMatrix)) {
            if (! in_array($emailTuple['context'], $contexts['indexes'])) {
                $emailTuple['context'] = 'default';
            }
            // unset($emailTuple['email_body']);
            $emails['indexes'][$emailTuple['context']] = $emailTuple['context'];
            $emails['mails'][] = $emailTuple;
            if (! isset($emails[$emailTuple['context']]['count'])) {
                $emails[$emailTuple['context']]['count'] = 1;
            } else {
                $emails[$emailTuple['context']]['count'] = $emails[$emailTuple['context']]['count'] + 1;
            }
        }
        return $emails;
    }

    function extractAndSaniTizeEmailFromString($sString)
    {
        $sString = html_entity_decode($sString);
        $sString = str_replace('"', " ", $sString);
        $sString = str_replace('<', " ", $sString);
        $sString = str_replace('>', " ", $sString);
        $sString = str_replace(';', ',', $sString);
        $aRet = array();
        $aCsvs = explode(',', $sString);
        foreach ($aCsvs as $sCsv) {
            $aWords = explode(' ', $sCsv);
            foreach ($aWords as $sWord) {
                $sEmail = filter_var(filter_var($sWord, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
                if ($sEmail !== false && ! in_array($sEmail, $aRet))
                    $aRet[] = $sEmail;
            }
        }

        return $aRet;
    }

    function execute()
    {
        // making sure only a single instance of this script is running at a time
        $lockfile = 'locks/sendmail.txt';
        $file = fopen($lockfile, 'w');
        if ($file === false) {
            exit("Unable to create/open lock file\n");
        }

        if (! flock($file, LOCK_EX | LOCK_NB)) {
            exit("Lock already in use by another process\n");
        }

        echo "Lock file acquired -> Running\n";

        $db = lib_mysqli::getInstance();
        // $mails_one_run = 25; // number of mails to send in one run of cron job
        $mail_delete_after = 10; // days, after which successfully sent mails will be deleted from email_buffer table

        // GETTING EMAIL FROM TABLE
        $sentEmailAccountNotificationList = array();
        $contexts = $this->getAllContexts();
        $emails = $this->getAllNotSentEmails($contexts, 2);

        $pendingMailsContextCounts = array();
        // $restrictMailIds = $this->getQueueAliases();
        $restrictMailIds = array();

        if (isset($emails['indexes'])) {
            foreach ($emails['indexes'] as $index) {
                if ($contexts[$index]['available'] >= $emails[$index]['count']) {
                    continue;
                }
                $pendingMailsContextCounts[$index] = $emails[$index]['count'] - $contexts[$index]['available'];
            }
        }

        arsort($contexts['accountsCount']);

        $availableMailsContextCounts = 0;
        foreach ($contexts['indexes'] as $index) {

            if (! isset($emails[$index]['count'])) {
                $emails[$index]['count'] = 0;
            }
            if ($contexts[$index]['available'] <= $emails[$index]['count']) {
                continue;
            }
            $availableMailsContextCounts += ($contexts[$index]['available'] - $emails[$index]['count']);
        }
        $pendingContexts = array_keys($pendingMailsContextCounts);
        while ($availableMailsContextCounts != 0) {
            if (count($pendingMailsContextCounts) == 0) {
                break;
            }

            // DISTRIBUTION OF PENDING EMAILS
            foreach ($contexts['accountsCount'] as $index => $val) {
                if (! in_array($index, $pendingContexts)) {
                    continue;
                }
                if ($availableMailsContextCounts >= $val) {
                    $contexts[$index]['available'] += $val;
                    $availableMailsContextCounts -= $val;
                } else {
                    $contexts[$index]['available'] += $availableMailsContextCounts;
                    $availableMailsContextCounts = 0;
                    break;
                }
            }
        }
        $counter = 0;
        if (isset($emails['mails'])) {

            foreach ($emails['mails'] as $info) {
                if (! in_array($info['context'], $contexts['indexes'])) {
                    $info['context'] = 'Default';
                    if (! in_array('default', $contexts['indexes'])) {
                        continue;
                    }
                }
                if ($contexts[$info['context']]['available'] == 0) {
                    continue;
                }
                if (count($contexts[$info['context']]['accounts']) == 0) {
                    // TO DO NO CONTEXT ACCOUNT IS AVAIALABLE TO SEND THIS MAIL
                    $contexts[$info['context']]['available'] = 0;
                    continue;
                }
                $counter ++;

                if (($contexts[$info['context']]['pointer']) == count($contexts[$info['context']]['accounts'])) {
                    $contexts[$info['context']]['pointer'] = 0;
                }
                $newAccountIndex = $contexts[$info['context']]['pointer'];
                $contexts[$info['context']]['available'] --;
                $account_details = $contexts[$info['context']]['accounts'][$newAccountIndex];

                // IF ACCOUNT REACHED ITS LIMIT THEN SEND NOTIFICATION
                if ($contexts[$info['context']]['accounts'][$newAccountIndex]['used_today'] == $account_details['maxlimit']) {
                    unset($contexts[$info['context']]['accounts'][$newAccountIndex]);
                    $contexts[$info['context']]['accounts'] = array_values($contexts[$info['context']]['accounts']);
                    if (! in_array($account_details['id'], $sentEmailAccountNotificationList)) {
                        $isNotificationSend = $this->sendAccountReachedNotification($account_details);
                        if ($isNotificationSend) {
                            $sentEmailAccountNotificationList[] = $account_details['id'];
                        }
                    }
                } else {
                    $contexts[$info['context']]['accounts'][$newAccountIndex]['used_today'] += 1;
                    $contexts[$info['context']]['pointer'] ++;
                }

                $mailer = new PHPMailer();
                $mailer->IsSMTP();
                $protocol = "tls";
                if ($account_details['mail_ssl']) {
                    $protocol = "ssl";
                }
                $mailer->Host = $protocol . "://" . $account_details['mail_server'];
                $mailer->Port = $account_details['mail_port'];
                // $mailer->SMTPSecure = 'ssl';
                // $mailer->SMTPDebug = true;
                $mailer->IsHTML(true); // send as HTML
                $mailer->SMTPAuth = true; // turn on SMTP authentication
                $mailer->Username = $account_details['user_name']; // SMTP username
                $mailer->Password = $account_details['mail_password']; // SMTP password
                $mailer->SetFrom($account_details['from_address'], $account_details['from_name']);
                $mailer->addCustomHeader('In-Reply-To', '<' . $account_details['reply_to_address'] . '>');

                if (! empty($info['embedded_images'])) {
                    $embeddedImages = unserialize(base64_decode($info['embedded_images']));
                    foreach ($embeddedImages as $key => $fileInfo) {
                        $mailer->AddEmbeddedImage($fileInfo['filePath'], $fileInfo['imageCid'], "attachment", "base64", $fileInfo['fileType']);
                    }
                }
                $mailer->AddReplyTo($account_details['reply_to_address'], $account_details['reply_to_name']);
                if (! empty($info['attachments'])) {
                    $attachments = json_decode($info['attachments'],1);
                    $attachmentsFilePath = "";
                    $attachmentsFileName = "";
                    foreach ($attachments as  $value) {
                        if (isset($value['path']) && ! empty($value['path'])) {
                            $attachmentsFilePath = $value['path'] ;
                            $attachmentsFileName = $value['name'];
                            $mailer->AddAttachment($attachmentsFilePath, $attachmentsFileName);
                        }

                    }
                } else {
                    $attachments = array();
                }

                $to_array = $this->extractAndSaniTizeEmailFromString($info['email_to']);
                $to_array = array_diff($to_array, $restrictMailIds);

                /*
                 * foreach ($info['email_to'] as $emailId => $emailValue) {
                 * if (in_array($emailValue, $vjconfig['customer_notification_exception'])) {
                 * unset($emails[$emailId]);
                 * }
                 * }
                 */
                if (count($to_array) > 0) {
                    foreach ($to_array as $value) {
                        if (! empty($value))
                            $mailer->AddAddress($value, '');
                    }
                }
                /*
                 * foreach ($info['email_cc'] as $emailId => $emailValue) {
                 * if (in_array($emailValue, $vjconfig['customer_notification_exception'])) {
                 * unset($emails[$emailId]);
                 * }
                 * }
                 */
                $cc_array = $this->extractAndSaniTizeEmailFromString($info['email_cc']);
                $cc_array = array_diff($cc_array, $restrictMailIds);
                if (count($cc_array) > 0) {
                    foreach ($cc_array as $value) {
                        if (! empty($value))
                            $mailer->addCustomHeader("CC: " . $value);
                        // $mailer->AddCC ( $value, '' );
                    }
                }

                /*
                 * foreach ($info['email_bcc'] as $emailId => $emailValue) {
                 * if (in_array($emailValue, $vjconfig['customer_notification_exception'])) {
                 * unset($emails[$emailId]);
                 * }
                 * }
                 */

                $bcc_array = $this->extractAndSaniTizeEmailFromString($info['email_bcc']);
                $bcc_array = array_diff($bcc_array, $restrictMailIds);
                if (count($bcc_array) > 0) {
                    foreach ($bcc_array as $value) {
                        if (! empty($value))
                            $mailer->addCustomHeader("BCC: " . $value);
                        // $mailer->AddCC ( $value, '' );
                    }
                }

                if ($info['description'] == "") {
                    $info['description'] = "EOM";
                }
                $mailer->Subject = html_entity_decode($info['name'], ENT_QUOTES);
                $mailer->Body = html_entity_decode($info['description'], ENT_QUOTES);
                $date = date('Y-m-d H:i:s');

                // SENDING THE MAIL
                if ($mailer->Send()) {
                    // $this->updateEmailWiseCounter($to_array,$cc_array,$bcc_array,$mailer->Subject);
                    foreach ($attachments as $value) {
                        unlink($value);
                        echo "File: $value Deleted successfully!<br>";
                    }
                    $db->query("UPDATE email_buffer SET is_sent_successfully=1, send_attempts = send_attempts +1, last_attempt='$date' WHERE id='{$info['id']}'");
                    $date = date('Y-m-d');
                    if ($account_details['date_last_used'] == $date) {
                        $db->query("UPDATE outbound_email_accounts SET used_today = used_today +1  WHERE id='{$account_details['id']}'");
                    } else {
                        $db->query("UPDATE outbound_email_accounts SET used_today = 1, date_last_used='$date'  WHERE id='{$account_details['id']}'");
                    }
                    $db->query("UPDATE email_buffer SET sendfrom = '" . $account_details['user_name'] . "'  WHERE id='{$info['id']}'");
                } else {
                    $reason = $mailer->ErrorInfo;
                    $db->query("UPDATE email_buffer SET sendfrom = '" . $account_details['user_name'] . "',sending_error = '$reason', send_attempts = send_attempts +1, last_attempt='$date'  WHERE id='{$info['id']}'");

                    // SEND MAIL TO ADMIN
                    // $this->sendErrorMails ( $info, $reason, $account_details ['user_name'] );
                }
                // sleep(10);
            }
        }
        $date_delete = date('Y-m-d H:i:s', (time() - 60 * 60 * 24 * $mail_delete_after));
        $db->query("DELETE FROM email_buffer WHERE is_sent_successfully = 1 AND date_entered < '$date_delete'");

        $yesterday = date('Y-m-d', strtotime("-1 day"));
        $db->query("UPDATE outbound_email_accounts SET used_today='0' where date_last_used = '$yesterday' ");

        echo "Lock file released -> Done\n";
        fclose($file);
    }

    function updateEmailWiseCounter($toArray = array(), $ccArray = array(), $bccArray = array(), $mailSubject)
    {
        $db =  lib_mysqli::getInstance();

        $start = "[CASE:";
        $end = "]";
        $string = ' ' . $mailSubject;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        $caseId = substr($string, $ini, $len);

        $emails = array_merge($toArray, $ccArray);
        $emails = array_merge($emails, $bccArray);
        $emails = array_unique($emails);
        // $today = date("Y-m-d");
        foreach ($emails as $email) {

            $sql = "SELECT * from email_wise_mail_counter where date_entered = CURDATE() and caseId = '" . $caseId . "' and emailId ='" . $email . "' ";
            $qry = $db->query($sql);
            if ($qry->num_rows == 0) {
                $sql = "INSERT INTO email_wise_mail_counter (emailId,counter,date_entered,caseId) values ('" . $email . "','1',CURDATE(),'" . $caseId . "')";
                $db->query($sql);
            } else {

                $row = $db->fetch($qry);
                $counter = $row['counter'];
                $stringArray = explode('@', $email);
                $domain = $stringArray[1];
                if (($domain == 'drishti-soft.com' || $domain == 'ameyo.com') && $counter % 25 == 0) {
                    $message = "Internal Drishti User ";
                    $this->sendEmailWiseCounterReachedNotification($caseId, $email, $counter, $message, 'Internal');
                } else if ($counter % 15 == 0 && $domain != 'drishti-soft.com' && $domain != 'ameyo.com') {
                    $message = "Customer ";
                    $this->sendEmailWiseCounterReachedNotification($caseId, $email, $counter, $message, 'Customer');
                }

                $sql = "UPDATE email_wise_mail_counter set counter=counter+1 WHERE date_entered = CURDATE() and emailId ='" . $email . "' and caseId = '" . $caseId . "'";
                $db->query($sql);
            }
        }
    }

    function sendEmailWiseCounterReachedNotification($caseId, $email, $counter, $message, $emailType)
    {
        return false;
        // global $db;
        $mailer = new PHPMailer();
        $mailer->AddAddress("rahulsingh@drishti-soft.com", '');
        $mailer->AddAddress("vijaykumar@drishti-soft.com", '');
        $mailer->AddAddress("skumar@drishti-soft.com", '');
        $mailer->AddAddress("rahulzutshi@drishti-soft.com", '');

        if ($emailType == 'Customer') {
            // $mailer->AddAddress ( "ravinderdahiya@drishti-soft.com", '' );
            // $mailer->AddAddress ( "vikastrivedi@drishti-soft.com", '' );
            // $mailer->AddAddress ( "nikhil@ameyo.com", '' );
            // $mailer->AddAddress ( "amitsinghla@ameyo.com", '' );
            // $mailer->AddAddress ( "jugalsaini@ameyo.com", '' );
        }

        $mailer->Host = "smtp.gmail.com";
        $mailer->Port = "465";
        $mailer->SMTPSecure = 'ssl';
        $mailer->IsSMTP();
        // $mailer->SMTPDebug = 2;
        $mailer->IsHTML(true); // send as HTML
        $mailer->SMTPAuth = true; // turn on SMTP authentication
        $mailer->Username = "dts-noreply1@dacx.net"; // SMTP username
        $mailer->Password = "mxl633kwI37413p"; // SMTP password
        $mailer->SetFrom("dts-noreply1@dacx.net", "noreply");
        $mailer->Subject = html_entity_decode('DCS ALERT: ' . strtoupper($message) . ' PER TICKET QUOTA EXCEEDED ON ' . date('Y-m-d'), ENT_QUOTES);
        $mailer->Body = html_entity_decode("PER TICKET NOTIFICATION QUOTA REACHED LIMIT OF " . $counter . " FOR TICKET " . $caseId . " RECEIPENT :- " . $email, ENT_QUOTES);
        // $mailer->Subject = html_entity_decode ( 'DCS ALERT: '.strtoupper($message).' EMAIL NOTIFICATION EXCEEDED'.date('Y-m-d'), ENT_QUOTES );
        // $mailer->Body = html_entity_decode ( "EMAIL NOTIFICATION REACHED LIMIT OF ".$counter." FOR ".strtoupper($message)."'s EMAIL ID " . $email, ENT_QUOTES );
        if ($mailer->Send()) {
            return true;
        }
        return false;
    }

    function sendErrorMails($info, $error, $senderAccount)
    {
        $db =  lib_mysqli::getInstance();
        $id = $info['id'];
        $subject = html_entity_decode($info['email_subject'], ENT_QUOTES);
        // SELECTING AN ACCOUNT TO SEND MAIL
        $res_account = $db->query("SELECT * FROM outbound_email_accounts WHERE context = 'notify' ORDER BY rand() LIMIT 1");
        if ($db->getRowCount($res_account) == 0) {
            return;
        }
        $account_details = $db->fetch($res_account);

        $mailer = new PHPMailer();
        $mailer->Host = $account_details['mail_server'];
        $mailer->Port = $account_details['mail_port'];
        $mailer->SMTPSecure = 'ssl';
        $mailer->IsSMTP();
        // $mailer->SMTPDebug = 2;
        $mailer->IsHTML(true); // send as HTML
        $mailer->SMTPAuth = true; // turn on SMTP authentication
        $mailer->Username = $account_details['user_name']; // SMTP username
        $mailer->Password = $account_details['mail_password']; // SMTP password
        $mailer->SetFrom($account_details['from_address'], $account_details['from_name']);
        $mailer->AddAddress('vijaykumar@drishti-soft.com', '');
        $mailer->AddAddress('rahulsingh@drishti-soft.com', '');

        $hostname = `/bin/hostname`;
        $mailer->Subject = 'Notification mail by sendmail script in DCS on ' . $hostname . ' ' . date('Y-m-d H:i:s');
        $mailer->Body = "Hi,<br/> One faulty mail with sendmail id {$id} AND subjec " . $subject . " in DCS mail pool at " . date('Y-m-d H:i:s') . " . Mail sending failed from email account:- " . $senderAccount . ".  Need to check it .<br/>Reason: {$error}";
        $mailer->Send();
    }
}

?>