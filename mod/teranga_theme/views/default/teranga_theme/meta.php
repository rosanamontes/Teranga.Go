<?php
if (!elgg_is_logged_in()){
echo '    
<style>
.et-site-menu {
  position: absolute;
  margin-top: 129px;
  margin-left: 2px;
  min-width: 250px;
  width: 250px;
  padding-top: 10px;  
  background: #ccc;
  min-height: 307px; 
  z-index: 10000; } 
</style>';
}
$whereami=elgg_get_context();
if ($whereami == 'profile'){
   echo '    
<style>
    .elgg-main{
    float: left;
    max-width: 100%;
} 
</style>';
}
