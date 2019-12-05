<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://codeforconnecticut.org
 * @since      1.0.0
 *
 * @package    Amplify_Legislators_Database
 * @subpackage Amplify_Legislators_Database/admin/partials
 */

  // print( '<pre>' . print_r( $res, true ) . '</pre>' );
?>

<html>
<head>
  <style>
    table {
      border-collapse: collapse;
    }

    table, th, td {
      border-collapse:collapse;
      border: 1px solid black;
    }

    td {
      padding: 5px;
    }
  </style>
</head>
<body>
  <button onclick="window.print()">Print This Page</button>
  <table>
  <?php foreach ($res as $row): ?>
    <tr>
      <td width="200"></td>
      <td>
        <div>
          <p>
            <strong><?php echo $row->first_name . " " . $row->last_name; ?></strong> <br/>
            <?php echo $row->capitol_street_address . ", Rm. " . $row->room_number; ?> <br/>
            <?php echo $row->capitol_city; ?> <br />
            Capitol: <?php echo $row->capitol_phone; ?>
          </p>
        </div>
      </td>
      <td width="10"><?php echo $row->party; ?></td>
      <td width="200">
        <?php echo $row->district_number; ?> District <br/>
        <?php echo $row->email; ?>
      </td>
      <td width="300">
        <div>
          <p>
            <strong><?php echo $row->title; ?></strong><br/>
            <?php echo $row->committee_member1; ?>
          </p>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
</body>
</html>
