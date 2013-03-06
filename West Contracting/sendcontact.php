<?
/**
* aFormMail script - sending mail via form
*
*     Author: Alex Scott
*      Email: alex@cgi-central.net
*        Web: http://www.cgi-central.net
*    Details: The installation file
*    FileName $RCSfile: aformmail.php,v $
*    Release: 1.1 ($Revision: 1.6 $)
*
* Please direct bug reports,suggestions or feedback to the cgi-central forums.
* http://www.cgi-central.net/forum/
*                                                                          
* aMember is free for both commercial and non-commercial use.
* Re-distribution of this script without prior consent is strictly prohibited.
*                                                                                 
*/

/*****************************************************************************
 *                                                                           *
 *                C  O  N  F  I  G  U  R  A  T  I  O  N                      *
 *                                                                           *
 *****************************************************************************/

// email for send submitted forms //////////////////////////////////////////
// if empty, use value from form ('send_to' field)
$send_to = "NB West Contact<jfitzgerald@nbwest.com>";
//$send_to = "NB West Contact<carney535@yahoo.com>"; --- TEST EMAIL
// set $send_cc address if you need copy of mail to other addresses
// for example: $send_cc = array('friend1@ccc.cc', 'friend2@ccc.cc'); 
//
//$send_cc = array('lwall@naed.org'); 
$send_cc = array ();
// Subject. if empty, use value from form ('subject' field)
$subject = "";

// Allowed Referres. Should be empty or list of domains
//$referrers = array(); 
$referrers = array();

// Attachments
$attachment_enabled = 0;

////// Database - write CSV file with data of submitted forms //////////////
$database_enabled = 1;
$database_file = 'contact.csv';

// Fields to collect
// $database_fields = '*' - mean all fields, as in form
// $database_fields = array('from', 'subject') - only 'from', 'subject' fields
$database_fields = '*'; 

////// Redirect user after submitting form
$redirect_url = 'thankyou.html';

////// Auto-Responder
////// You can substitute any of form fields in response by using
////// %field_name% in response text.
//////
//$fields = _build_fields($vars); //MODIFIED
$autoresponder_enabled = 0;
$autoresponder_from = $send_to;
$autoresponder_subject = "%subject%";
//$fields = _build_fields($vars);
$autoresponder_message = <<<MSG

MSG;

/***************************************************************************/

function do_formmail(){
    global $autoresponder_enabled, $database_enabled;
    $form      = get_form_data();
    $errors    = check_form($form);
    if ($errors) {
        display_errors($errors);
        return;
    }
    send_mail($form);
    if ($autoresponder_enabled) 
        auto_respond($form);
    if ($database_enabled)
        save_form($form);
    redirect();
}

function redirect(){
    global $redirect_url;
    header("Location: $redirect_url");
    exit();
}


function save_form($vars){
    global $database_file, $database_fields;
    $f = fopen($database_file, 'a');
    if (!$f){
        die("Cannot open db file for save");
    }
    foreach ($vars as $k=>$v) {
        $vars[$k] = str_replace(array("|", "\r","\n"), array('_',' ',' '), $v);
    }
    if (is_array($database_fields)) {
        $vars_orig = $vars; 
        $vars = array();
        foreach ($database_fields as $k)
            $vars[$k] = $vars_orig[$k];
    }
    $str = join('|', $vars);
    fwrite($f, $str."\n");
    fclose($f);
}

function auto_respond($vars){
    global $autoresponder_from, $autoresponder_message, $autoresponder_subject;
    /// replace all vars in message
    $msg = $autoresponder_message;
    preg_match_all('/%(.+?)%/', $msg, $out);
    $s_vars = $out[1]; //field list to substitute
    foreach ($s_vars as $k)
        $msg = str_replace("%$k%", $vars[$k], $msg);
    /// replace all vars in subject
    $subj = $autoresponder_subject;
    preg_match_all('/%(.+?)%/', $subj, $out);
    $s_vars = $out[1]; //field list to substitute
    foreach ($s_vars as $k)
        $subj = str_replace("%$k%", $vars[$k], $subj);
    //
    $_send_to = "$vars[name_from] <".$vars[email_from].">";
    $_send_from = $autoresponder_from;
    mail($_send_to, $subj, $msg, "From: $_send_from");
}

function _build_fields($vars){
    $skip_fields = array(
        'name_from', 
//      'email_from', 
        'email_to', 
        'name_to', 
        'subject');
    // order by numeric begin, if it exists
    $is_ordered = 0;
    foreach ($vars as $k=>$v) 
        if (in_array($k, $skip_fields)) unset($vars[$k]);

    $new_vars = array();
    foreach ($vars as $k=>$v){
        // remove _num, _reqnum, _req from end of field names
        $k = preg_replace('/_(req|num|reqnum)$/', '', $k);
        // check if the fields is ordered
        if (preg_match('/^\d+[ \:_-]/', $k)) $is_ordered++;
        //remove number from begin of fields
        $k = preg_replace('/^\d+[ \:_-]/', '', $k);
        $new_vars[$k] = $v;
    }
    $vars = $new_vars;

    $max_length = 10; // max length of key field 
    foreach ($vars as $k=>$v) {
        $klen = strlen($k);
        if (($klen > $max_length) && ($klen < 40))
            $max_length = $klen;
    }

    if ($is_ordered)
        ksort($vars);

    // make output text
    $out = "";
    foreach ($vars as $k=>$v){
        $k = str_replace('_', ' ', $k);
        $k = ucfirst($k);
        $len_diff = $max_length - strlen($k);
        if ($len_diff > 0) 
            $fill = str_repeat('.', $len_diff);
        else 
            $fill = '';
        $out .= $k."$fill...: $v\n";
    }
    return $out;
}


function send_mail($vars){
    global $send_to, $send_cc;
    global $subject;
    global $attachment_enabled;
    global $REMOTE_ADDR;

    global $HTTP_POST_FILES;
    $files = array(); //files (field names) to attach in mail
    if (count($HTTP_POST_FILES) && $attachment_enabled){
        $files = array_keys($HTTP_POST_FILES);
    }

    // build mail
    $date_time = date('Y-m-d H:i:s');
    $mime_delimiter = md5(time());
    $fields = _build_fields($vars);
    $mail = <<<EOF
This is a MIME-encapsulated message
    
--$mime_delimiter
Content-type: text/plain
Content-Transfer-Encoding: 8bit

Form Submission below:

$fields 
--------------------
REMOTE IP : $REMOTE_ADDR
DATE/TIME : $date_time
EOF;

    if (count($files)){
        foreach ($files as $file){
            $file_name     = $HTTP_POST_FILES[$file]['name'];
            $file_type     = $HTTP_POST_FILES[$file]['type'];
            $file_tmp_name = $HTTP_POST_FILES[$file]['tmp_name'];
            $file_cnt = "";
            $f=@fopen($file_tmp_name, "rb");
            if (!$f) 
                continue;
            while($f && !feof($f))
                $file_cnt .= fread($f, 4096);
            fclose($f);
            if (!strlen($file_type)) $file_type="applicaton/octet-stream";
            if ($file_type == 'application/x-msdownload')
                $file_type = "applicaton/octet-stream";

            $mail .= "\n--$mime_delimiter\n";
            $mail .= "Content-type: $file_type\n";
            $mail .= "Content-Disposition: attachment; filename=\"$file_name\"\n";
            $mail .= "Content-Transfer-Encoding: base64\n\n";
            $mail .= chunk_split(base64_encode($file_cnt));
        }
    }
    $mail .= "\n--$mime_delimiter--";


    //send to
    $_send_to = $send_to ? $send_to : "$vars[name_to] <".$vars[email_to].">";
    $_send_from = "$vars[name_from] <".$vars[email_from].">";
    $_subject = $subject ? $subject : $vars['subject'];

    mail($_send_to, $_subject, $mail, 
    "Mime-Version: 1.0\r\nFrom: $_send_from\r\nContent-Type: multipart/mixed;\n boundary=\"$mime_delimiter\"\r\nContent-Disposition: inline");

    foreach ($send_cc as $v){
      mail($v, $_subject, $mail, 
      "Mime-Version: 1.0\r\nFrom: $_send_from\r\nContent-Type: multipart/mixed;\n boundary=\"$mime_delimiter\"\r\nContent-Disposition: inline");
    }

}

function get_form_data(){
    global $REQUEST_METHOD;
    global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;
    
    $vars = $_POST;
    //strip spaces from all fields
    //foreach ($vars as $k=>$v) $vars[$k] = trim($v);
	
    return $vars;
	
}

function check_form($vars){
    global $referrers;
    global $send_to;
    global $subject;
    global $HTTP_REFERER;

    $errors = array();

    // check from email set
    if (!strlen($vars['email_from'])){
        $errors[] = "<b>From Email address</b> empty";
    } else if (!check_email($vars['email_from'])){
        $errors[] = "<b>From Email address</b> incorrect";        
    }                 
    if (!strlen($send_to) && !strlen($vars['email_to'])){
        $errors[] = "<b>To Email</b> address empty (possible configuration error)";
    } else if (!strlen($send_to) && !check_email($vars['email_to'])){
        //if to email specified in form, check it and display error
        $errors[] = "<b>To Email address</b> incorrect";        
    }
    if (!strlen($vars['subject']) && !strlen($subject)){
        $errors[] = "<b>Subject</b> empty (possible configuration error)";
    }
    foreach ($vars as $k=>$v){
        // check for required fields (end with _req)
        if (preg_match('/^(.+?)_req$/i', $k, $m) && !strlen($v)){
            $field_name = ucfirst($m[1]);
            $errors[] = "Required field <b>$field_name</b> empty";
        }
        // check for number fields (end with _num)
        if (preg_match('/^(.+?)_num$/i', $k, $m) && strlen($v) && !is_numeric($v)){
            $field_name = ucfirst($m[1]);
            $errors[] = "Field <b>$field_name</b> must contain only digits or be empty";
        }
        // check for number & required fields (end with _reqnum)
        if (preg_match('/^(.+?)_reqnum$/i', $k, $m) && !is_numeric($v)){
            $field_name = ucfirst($m[1]);
            $errors[] = "Field <b>$field_name</b> must contain digits and only digits";
        }
    }

    //check referrer
    if (is_array($referrers) && count($referrers)){
        $ref = parse_url($HTTP_REFERER);
        $host = $ref['host'];
        $host_found = 0;
        foreach ($referrers as $r){
            if (strstr($host, $r)) 
                $host_found++;
        }
        if (!$host_found){
            $errors[] = "Unknown Referrer: <b>$host</b>";
        }
    }
	

    return $errors;
}

function display_errors($errors){
$errors = '<li>' . join('<li>', $errors);
print <<<EOF
<html>
    <head><title>Form Error</title></head>
<body bgcolor=white>
    <h3 align=center><font color=red>An Error Occured</font></h3>
    <hr width=80%>
    <table align=center><tr><td>
    $errors
    </td></tr></table>
    <p align=center>
    <a href="javascript: history.back(-1)">Return</a> and fix these errors 
    </p>
</body></html>
EOF;
}


/**
* Check email using regexes
* @param string email
* @return bool true if email valid, false if not
*/
function check_email($email) {
    #characters allowed on name: 0-9a-Z-._ on host: 0-9a-Z-. on between: @
    if (!preg_match('/^[0-9a-zA-Z\.\-\_]+\@[0-9a-zA-Z\.\-]+$/', $email))
        return false;

    #must start or end with alpha or num
    if ( preg_match('/^[^0-9a-zA-Z]|[^0-9a-zA-Z]$/', $email))
        return false;

    #name must end with alpha or num
    if (!preg_match('/([0-9a-zA-Z_]{1})\@./',$email) )                    
        return false;

    #host must start with alpha or num
    if (!preg_match('/.\@([0-9a-zA-Z_]{1})/',$email) )                    
        return false;

    #pair .- or -. or -- or .. not allowed
    if ( preg_match('/.\.\-.|.\-\..|.\.\..|.\-\-./',$email) )
        return false;

    #pair ._ or -_ or _. or _- or __ not allowed
    if ( preg_match('/.\.\_.|.\-\_.|.\_\..|.\_\-.|.\_\_./',$email) )
        return false;

    #host must end with '.' plus 2-5 alpha for TopLevelDomain
    if (!preg_match('/\.([a-zA-Z]{2,5})$/',$email) )
        return false;

    return true;
}

do_formmail();
?>
