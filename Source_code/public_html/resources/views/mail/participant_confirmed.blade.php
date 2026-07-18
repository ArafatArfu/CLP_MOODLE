<!DOCTYPE html>
<html>
   <head>
      <title>Registration Confirmation - CLP 2025 NJ Convention</title>
   </head>
   <body>
      <strong>
      Dear {{  $participant->first_name }} {{ $participant->last_name }} 
      </strong>
      <p>Thank you for registering for the CLP 2025 NJ Convention! We’re excited to have you join us for an evening filled with inspiration, entertainment, and impact.</p>
      <h4>Event Details:</h4>
      <ul>
         <li>
            📅 Date: August 16, 2025
         </li>
         <li>
            🕕 Time: 6:00 PM – 9:00 PM
         </li>
         <li>
            📍 Venue: Franklin Community Senior Center,
            505 DeMott Lane, Somerset, NJ 08873
         </li>
      </ul>
      <h4>
         Your Registration Details:
      </h4>
      <ul>
         <li>
            Name:  {{  $participant->first_name }} {{ $participant->last_name }}
         </li>
         <li>
            Email:  {{ $participant->email }}
         </li>
         <li>
            Guests:  {{ $participant->guests }}
         </li>
         <li>
            Payment Method: {{ $participant->payment_method }}
         </li>
         <li>
            Amount: {{ $participant->amount }}
         </li>
         <li>
            Dinner is included
         </li>
      </ul>
      <p>If you have any questions or need to update your information, feel free to reply to this <b>clp@clpweb.org</b> email.
         We look forward to seeing you at the convention!
      </p>
      <strong>Warm regards,</strong>
      <ul>
         <li>
            CLP 2025 NJ Convention Team
         </li>
         <li>
            Contact Email: vabnj@hotmail.com
         </li>
         <li>
            Phone Number: (732) 829-0341
         </li>
      </ul>
   </body>
</html>