<h4>&nbsp;&nbsp;Absensi</h4><hr />
<div class="row-fluid">
    <div class="span6">
        <table>
            <tr>
                <td>Tahun Ajaran&nbsp;&nbsp;</td>
                <td>: <?= $tahun[0]['tahun_ajaran']; ?></td>
            </tr>
            <tr>
                <td>Semester&nbsp;&nbsp;</td>
                <td>: <?= $semester; ?></td>
            </tr>
        </table>
        <br />
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th bgcolor="#6A9EF2">Izin</th>
                    <th bgcolor="#6A9EF2">Sakit</th>
                    <th bgcolor="#6A9EF2">Tanpa Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $izin; ?></td>
                    <td><?= $sakit; ?></td>
                    <td><?= $tanpa_keterangan; ?></td>
                </tr>
            </tbody>
        </table>
        Total Ketidakhadiran : <?= $izin+$sakit+$tanpa_keterangan; ?>
    </div>
</div>
