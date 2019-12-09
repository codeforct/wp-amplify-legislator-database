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

    table,
    th,
    td {
      border-collapse: collapse;
      border: 1px solid black;
    }

    td {
      padding: 5px;
    }

    @media print {
      @page {
        size: landscape;
      }

      button {
        display: none;
      }

      table {
        font-size: 14px;
        page-break-inside: auto;
      }

      tr {
        page-break-inside: avoid;
        page-break-after: auto;
      }

      td {
        vertical-align: baseline;
      }

      tr td:nth-of-type(2) {
        white-space: nowrap;
      }
    }
  </style>
</head>

<body>
  <button onclick="window.print()">Print This Page</button>
  <table>
    <?php foreach ($res as $row) : ?>
      <tr>
        <td width="200"></td>
        <td>
          <div>
            <p>
              <strong><?php echo $row->first_name . " " . $row->last_name; ?></strong> <br />
              <?php echo $row->capitol_street_address . ", Rm. " . $row->room_number; ?> <br />
              <?php echo $row->capitol_city; ?> <br />
              Capitol: <?php echo $row->capitol_phone; ?>
            </p>
          </div>
        </td>
        <td><?php echo $row->party; ?></td>
        <td>
          <?php echo $row->district_number; ?> District <br />
          <?php echo $row->email; ?>
        </td>
        <td>
          <div>
            <p>
              <?php
                if ($row->title !== '') {
                  ?>
                <strong><?php echo $row->title; ?></strong><br />
              <?php
                }
                ?>
              <?php echo $row->committee_member1; ?>
            </p>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>
