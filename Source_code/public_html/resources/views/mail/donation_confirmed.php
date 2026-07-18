<!DOCTYPE html>
<html>
   <head>
      <title>Donation Confirmation - CLP</title>
   </head>
   <body>
      <strong>
      Dear {{  $donation->name }} 
      </strong>
      <p>Thank you for donating CLP.</p>
      <h4>
         Your Donation Details:
      </h4>
      <ul>
         <li>
            Name:  {{  $donation->name }}
         </li>
         <li>
            Email:  {{ $participant->email }}
         </li>
         <li>
            Payment Method: {{ $participant->payment_method }}
         </li>
      </ul>
      <p>If you have any questions or need to update your information, feel free to reply to this <b>clp@clpweb.org</b></p>
      <strong>Warm regards, CLP</strong>
   </body>
</html>