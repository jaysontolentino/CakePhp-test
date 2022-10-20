
<div class="row-fluid">
<?php
echo $this->Form->create('Migration/answer', array('type' => 'file'));
echo $this->Form->file('file');
echo $this->Form->submit('Migrate Data', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Ref No.</th>
                <th>Member Name</th>
                <th>Member No</th>
                <th>Member Pay Type</th>
                <th>Member Company</th>
                <th>Payment By</th>
                <th>Batch No</th>
                <th>Receipt No</th>
                <th>Cheque No</th>
                <th>Payment Description</th>
                <th>Renewal Year</th>
                <th>SubTotal</th>
                <th>TotalTax</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($members as $member) : ?>
            <tr>
                <td><?= $member['Transaction'][0]['date'] ?></td>
                <td><?= $member['Transaction'][0]['ref_no'] ?></td>
                <td><?= $member['Member']['name'] ?></td>
                <td><?= $member['Member']['type'].' '.$member['Member']['no'] ?></td>
                <td><?= $member['Transaction'][0]['member_paytype'] ?></td>
                <td><?= $member['Member']['company'] ?></td>
                <td><?= $member['Transaction'][0]['payment_method'] ?></td>
                <td><?= $member['Transaction'][0]['batch_no'] ?></td>
                <td><?= $member['Transaction'][0]['receipt_no'] ?></td>
                <td><?= $member['Transaction'][0]['cheque_no'] ?></td>
                <td><?= $member['Transaction'][0]['payment_type'] ?></td>
                <td><?= $member['Transaction'][0]['renewal_year'] ?></td>
                <td><?= $member['Transaction'][0]['subtotal'] ?></td>
                <td><?= $member['Transaction'][0]['tax'] ?></td>
                <td><?= $member['Transaction'][0]['total'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
