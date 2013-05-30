<!-- <?php echo $css; ?> -->

<table class="calendar">
    <tr>
        <td class="calendarButton" id="calPrev">&lt;&lt;</td>
        <td colspan="5"></td>
        <td class="calendarButton" id="calNext">&gt;&gt;</td>
    </tr>

    <tr>
        <td colspan="7" class="calendarHead"><span class="calendarMonth"><?php echo $c['month']; ?></span> <span class="calendarYear"><?php echo $c['year']?></span></td>
    </tr>

    <tr class="calendarNamesOfDay">
        <td>Su</td><td>Mon</td><td>Tues</td><td>Wed</td><td>Thur</td><td>Fri</td><td>Sat</td>
    </tr>

    <!-- determine week -->
    <?php foreach($c['week'] as $week): ?>
    <tr class="calendarWeek">
        <!-- determine days of week -->
        <?php foreach($week as $day): ?>
        <td <?php if($c['today']== $day){echo "class='today'";} ?>><?php echo $day; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>
<!-- <?php echo $javascript; ?> -->