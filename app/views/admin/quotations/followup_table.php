<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Responsible User</th>
            <th>Comment</th>
            <th>Refer To</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($followups as $followup): ?>
            <tr>
                <td><?php echo $followup['date']; ?></td>
                <td><?php echo $followup['responsible_user']; ?></td>
                <td><?php echo $followup['comment']; ?></td>
                <td><?php echo $followup['refer_to']; ?></td>
                <td><?php echo $followup['is_closed'] ? 'Closed' : 'Open'; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
