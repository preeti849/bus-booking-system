<?php
// You can customize this file to redirect or show an exit message
session_start();
session_destroy();
echo "<script>alert('Thank you for visiting!'); window.close();</script>";