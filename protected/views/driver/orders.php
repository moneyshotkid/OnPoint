<?php
/**
 *
 * User: Nick
 * Date: 2/24/15
 * Time: 12:38 PM
 */ //var_dump($myorders);
//echo "<hr/>"; var_dump($openorders); ?>
    <div class="row">


        <div class="col-md-10">
            <h1 class="text-center">
               My Assigned Orders
            </h1>
            <h3 class="text-center">

            </h3>
        </div>
        <div class="no-more-tables">
            <table class="col-md-10 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>

                    <th>Wait Time</th>
                    <th>Patient</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Meds</th>
                    <th>Email</th>
                    <th>Note</th>

                </tr>
                </thead>
                <tbody><?php foreach($myorders as $order){ ?>
                <tr>

                    <td data-title="Time"><abbr class='timeago' title='<?php echo $order['Timein']; ?>'></abbr></td>
                    <td data-title="Name"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/driver/orderDetail/<?php echo $order['id']; ?>"><?php
                        echo $order['name']; ?></a></td>
                    <td data-title="Address"><?php echo $order['address'] ?><br/><?php echo $order['city']; ?>,
                        <?php echo $order['zip']; ?>
                    </td>
                    <td data-title="Phone"><?php echo $order['phone']; ?></td>
                    <td data-title="Product"><?php echo $order['requestedStrains']; ?></td>
                    <td data-title="Email"><?php echo $order['email']; ?></td>
                    <td data-title="Note" ><?php echo $order['patientnote']; ?></td>

                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-10">
            <h1 class="text-center">
                Open Orders
            </h1>
            <h3 class="text-center">

            </h3>
        </div>
        <div class="no-more-tables">
            <table class="col-md-10 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>

                    <th>Wait Time</th>
                    <th>Patient</th>
                    <th>Address</th>

                    <th>Meds</th>

                    <th>Note</th>
                    <th></th>
                </tr>
                </thead>
                <tbody><?php foreach($openorders as $openorder){   $address=  trim(str_replace(range(0,9),'',
                    $openorder['address']));?>
                    <tr>

                        <td data-title="Time"><abbr class='timeago' title='<?php echo $openorder['Timein']; ?>'></abbr></td>
                        <td data-title="Name"><?php echo $openorder['name']; ?></td>
                        <td data-title="Address"><?php echo $address; ?><br/><?php echo $openorder['city']; ?>,
                            <?php echo $openorder['zip'] ?>
                        </td>

                        <td data-title="Product"><?php echo $openorder['requestedStrains']; ?></td>

                        <td data-title="Note" ><?php echo $openorder['patientnote']; ?></td>
                        <td data-title="Action"></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>


    </div>


<style type="text/css">
    @media only screen and (max-width: 800px) {

        /* Force table to not be like tables anymore */
        .no-more-tables table,
        .no-more-tables thead,
        .no-more-tables tbody,
        .no-more-tables th,
        .no-more-tables td,
        .no-more-tables tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .no-more-tables thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        .no-more-tables tr { border: 1px solid #ccc; }

        .no-more-tables td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
            white-space: normal;
            text-align:left;
        }

        .no-more-tables td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align:left;
            font-weight: bold;
        }

        /*
        Label the data
        */
        .no-more-tables td:before { content: attr(data-title); }
    }

</style>