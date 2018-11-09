<?php
/* Set e-mail recipient */
//$myemail  = "eclipse@ab-inbev.com, vircovo@gmail.com, harold.stewart@zx-ventures.com";
//
///* Check all form inputs using check_input function */
//$company = check_input($_POST['company']);
//$companyemail   = check_input($_POST['companyemail']);    
//$goals = check_input($_POST['goals']);
//$achieve = check_input($_POST['achieve']);
//
//$subject = "Eclipse Join";
//
///* If e-mail is not valid show error message */
//if (!preg_match("/([\w\-\.]+\@[\w\-]+\.[\w\-]+)/", $companyemail))
//{
//    echo $companyemail;
//    show_error("E-mail address not valid");
//}
//
///* If URL is not valid set $website to empty */
//if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
//{
//    $website = '';
//}
# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use MailgunMailgun;
# Instantiate the client.
$mgClient = new Mailgun('aaa27677f68bd7c99f130e0fdef6af24-4412457b-ca3a5c19');
$domain = "eclipse.ab-inbev.com";
# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
	'from'    => 'Excited User <mailgun@YOUR_DOMAIN_NAME>',
	'to'      => 'eclipse@ab-inbev.com',
	'subject' => 'Hello',
	'text'    => 'Testing some Mailgun awesomness!'
));

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

COMPANY NAME: $company
COMPANY EMAIL: $companyemail
GOALS: $goals
HOW WILL YOU ACHIEVE THIS GOAL?: $achieve




End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>