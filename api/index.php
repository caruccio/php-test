<?php header('Content-type: application/json') ?>{
  "status": "ok",
  "message": "This is my API root v2",
  "hostname": "<?php echo getenv('HOSTNAME') ?>"
}
