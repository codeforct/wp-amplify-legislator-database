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

    h3 {
      text-align: center;
      font-family: sans-serif;
    }

    table {
      border-collapse: separate;
    }

    table,
    th,
    td {
      border-collapse: separate;
      border: 0px;
      font-family: sans-serif;
      margin: 15px 0px;
      border-spacing: 5px 2rem;
    }

    .first{
      border: 1px solid black;
    }

    .logo{
      display: block;
      height: 140px;
      margin-left: auto;
      margin-right: auto;
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

      .logo {
        height: 125px;
      }

      table {
        font-size: 12px;
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
  <img class="logo" src="../wp-content/plugins/wp-amplify-legislator-database/assets/amplify_logo.jpg" alt="Amplify Logo">
  <h3>Legislators 2019-2020</h3>
  <button onclick="window.print()">Print This Page</button>
  <table border-spacing=>
    <?php foreach ($res as $row) : ?>
      <tr>
        <td class="first" width="200"></td>
        <td>
          <div>
            <p> 
              <!-- The senator or representative colum is not returning -->
              <strong><?php echo $row->first_name . " " . $row->last_name. " " . $row->senator_or_rep; ?></strong> <br />
              <?php echo $row->capitol_street_address . ", Rm. " . $row->room_number; ?> <br />
              <?php echo $row->capitol_city; ?> <br />
              Capitol: <?php echo $row->capitol_phone; ?>
            </p>
          </div>
        </td>
        <td><?php echo $row->party; ?></td>
        <td>
          <?php echo $row->district_number; ?> District <br />
          <a href="mailto:<?php echo $row->email; ?>?body=<?php echo $body; ?>"><?php echo $row->email; ?></a>
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
