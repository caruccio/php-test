<?php header('Content-type: application/json') ?>{
  "status": "ok",
  "message": "This is my API root",
  "hostname": "<?php echo getenv('HOSTNAME') ?>"
}
