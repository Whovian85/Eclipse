<?php

   require './aws.phar';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;


$SesClient = new SesClient([
    'profile' => 'default',
    'version' => '2010-12-01',
    'region'  => 'us-west-2'
]);
/* Set e-mail recipient */
$myemail  = "harold.stewart@zx-ventures.com";

/* Check all form inputs using check_input function */
$name = $_POST['name'];
$company   = check_input($_POST['company']);    
$phone = check_input($_POST['phone'], "Enter your phone");
$email    = check_input($_POST['email']);
$comments = check_input($_POST['comments'], "Write your comments");

$subject = "Eclipse Contact";

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

Your Name: $name
Your Company: $company
Your Phone: $phone
E-mail: $email
Comments: $comments



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