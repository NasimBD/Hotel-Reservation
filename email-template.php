
<!--  content of email after reservation  -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Reservation</title>
</head>
<body style="font-family: 'Roboto Light', sans-serif;
background-color:#f9fafc; font-size:1rem; box-sizing: border-box; margin: 0; padding: 0;">
    <h1 style="margin-top: 0rem; padding: 2rem 1rem; background-color:#c62c05; color: wheat">Hotel Reservation</h1>
    <p style="padding-left: 1rem; margin-top: 1rem;">A new reservation has been booked.</p>
    <h2 style="margin-top: 1rem; padding-left: 1rem;">Guest Details</h2>

    <table style="table-layout: fixed; width: 100%; max-width: 800px; margin-top: 2rem; border-collapse: collapse;">
        <tbody>
            <tr style="background-color: #f1f0f0;">
                <th style="padding: 0.5rem 1rem; text-align: left;">Email</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($email) ? $email : '' ?></td>
            </tr>

            <tr>
                <th style="padding: 0.5rem 1rem; text-align: left;">Name</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($first_name) ? $first_name : '' ?> <?= isset($last_name) ? $last_name : '' ?></td>
            </tr>

            <tr style="background-color: #f1f0f0;">
                <th style="padding: 0.5rem 1rem; text-align: left;">Phone</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($phone) ? $phone : '' ?></td>
            </tr>


            <tr>
                <th style="padding: 0.5rem 1rem; text-align: left;">Arrival</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($arrival) ? $arrival : '' ?></td>
            </tr>

            <tr style="background-color: #f1f0f0;">
                <th style="padding: 0.5rem 1rem; text-align: left;">Departure</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($departure) ? $departure : '' ?></td>
            </tr>

            <tr>
                <th style="padding: 0.5rem 1rem; text-align: left;">Adult</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($adults) ? $adults : '' ?></td>
            </tr>

            <tr style="background-color: #f1f0f0;">
                <th style="padding: 0.5rem 1rem; text-align: left;">Children</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($children) ? $children : '' ?></td>
            </tr>

            <tr>
                <th style="padding: 0.5rem 1rem; text-align: left;">Room Type</th>
                <td style="padding: 0.5rem 1rem; text-align: left;"><?= isset($room_type) ? $room_type : '' ?></td>
            </tr>

        </tbody>
    </table>
</body>
</html>
