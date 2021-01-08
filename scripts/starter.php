<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EWMT - ESXI WEB MANAGEMENT TOOL</title>
</head>
<form class="" action="firstConnexion.php" method="post">                  
  <input type="text" class="form-control" required name="ip" placeholder="ESXi IP (ex:10.0.0.1)">
  <input type="text" class="form-control" required name="port" placeholder="ESXi SSH Port (ex: 22)">
  <input type="text" class="form-control" required name="CheckBackupFolder" placeholder="ex : /vfms/volumes/datastore1/backup*">
  <input type="text" class="form-control" required name="LogsPath" placeholder="ex : /vfms/volumes/datastore1/logsbackup.txt">
  <button type="submit" class="btn btn-warning mb-2">Submit</a></button>
</form>