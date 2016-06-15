<?php

include 'includes.php';

$query = "SELECT M.MId, Name, StartTime, Duration FROM RESERVATIONS R, MACHINES M WHERE R.MId = M.MId ORDER BY StartTime";
$res = $conn->query($query);
if ($res !== false) {
    while ($row = $res->fetch_row()) {
        list ($mid, $name, $start, $duration) = $row;
        $start = intval($start);
        $duration = intval($duration);
        $startTime = minutesToString($start);
        $endTime = minutesToString($start + $duration);
        $durationStr = minutesToString ($duration,'h,m');
?>
            <div class = 'list_row book_row' id = '<?php echo "book_{$mid}_{$startTime}"; ?>'>
                <span class = 'list_cell'><?php echo $name; ?></span>
                <span class = 'list_cell'><?php echo $startTime; ?></span>
                <span class = 'list_cell'><?php echo $endTime; ?></span>
                <span class = 'list_cell'><?php echo $durationStr; ?></span>
            </div>
<?php
    }
}
?>
<script>
timestamp = <?php echo time(); ?>;
</script>
