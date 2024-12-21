<?php 

class EmailVerifier { 

    
     function verifyEmail($toemail,$port=25, $fromemail="")
{
    // Get the domain of the email recipient
    $email_arr = explode('@', $toemail);
    $domain = array_slice($email_arr, -1);
    $domain = $domain[0];

    // Trim [ and ] from beginning and end of domain string, respectively
    $domain = ltrim($domain, '[');
    $domain = rtrim($domain, ']');

    if ('IPv6:' == substr($domain, 0, strlen('IPv6:'))) {
        $domain = substr($domain, strlen('IPv6') + 1);
    }

    $mxhosts = array();
        // Check if the domain has an IP address assigned to it
    if (filter_var($domain, FILTER_VALIDATE_IP)) {
        $mx_ip = $domain;
    } else {
        // If no IP assigned, get the MX records for the host name
        getmxrr($domain, $mxhosts, $mxweight);
    }

    if (!empty($mxhosts)) {
        $mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
    } else {
        // If MX records not found, get the A DNS records for the host
        if (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $record_a = dns_get_record($domain, DNS_A);
             // else get the AAAA IPv6 address record
        } elseif (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $record_a = dns_get_record($domain, DNS_AAAA);
        }

        if (!empty($record_a)) {
            $mx_ip = $record_a[0]['ip'];
        } else {
            // Exit the program if no MX records are found for the domain host
            $result = false;
            $this->details .= 'No suitable MX records found.';

            return $result;
        }
    }

    // Open a socket connection with the hostname, smtp port 25    
    $connect = @fsockopen($mx_ip,$port); // 25);

    if ($connect) {
 
              // Initiate the Mail Sending SMTP transaction
        if (preg_match('/^220/i', $out = fgets($connect, 1024))) {

                      // Send the HELO command to the SMTP server
            fputs($connect, "HELO $mx_ip\r\n");
            $out = fgets($connect, 1024);           
            $this->details .= $out."\n"; 
             if (!preg_match('/^250/i', $out)) {
                $result = false;
            } else {
                $result = true;
            }
            // Send an SMTP Mail command from the sender's email address
     /*       fputs($connect, "MAIL FROM: <$fromemail>\r\n");
            $from = fgets($connect, 1024);
            $this->details .= $from."\n";

                        // Send the SCPT command with the recepient's email address
            fputs($connect, "RCPT TO: <$toemail>\r\n");
            $to = fgets($connect, 1024);
            $this->details .= $to."\n";

            // Close the socket connection with QUIT command to the SMTP server
            fputs($connect, 'QUIT');
            fclose($connect);
 
            if (!preg_match('/^Must issue a STARTTLS command first Email/i', $from)) {
                
            }
            // The expected response is 250 if the email is valid
            if (!preg_match('/^250/i', $from) || !preg_match('/^250/i', $to)) {
                $result = false;
            } else {
                $result = true;
            } */
        }
    } else {
        $result = false;
        $this->details .= 'Could not connect to server';
    }     
    return $result;
    }
    
    function getErrors()
    {
        return $this->details;
    }
} 



