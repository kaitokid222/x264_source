<? 
// ************************************************************************************//
// * D� Source 2018
// ************************************************************************************//
// * Author: D@rk-�vil�
// ************************************************************************************//
// * Version: 2.0
// * 
// * Copyright (c) 2017 - 2018 D@rk-�vil�. All rights reserved.
// ************************************************************************************//
// * License Typ: Creative Commons licenses
// ************************************************************************************// 
require_once(dirname(__FILE__) . "/include/engine.php");

dbconn(); 

//---------------------------------nur ab mods aufw�rts--------------------
if ($_SERVER["HTTP_HOST"] != "") {
    loggedinorreturn();
    
check_access(UC_MODERATOR);
security_tactics();
}
//---------------------------------nur ab mods aufw�rts--------------------

loggedinorreturn();

$id = 0 + $_GET["id"];
$res=mysql_query("SELECT * FROM peers WHERE userid = $id");
while($r=mysql_fetch_assoc($res))
{
  if($r["seeder"]=="yes") 
    mysql_query("UPDATE torrents SET seeders = seeders - 1 WHERE id = $r[torrent]");
  else
    mysql_query("UPDATE torrents SET leechers = leechers - 1 WHERE id = $r[torrent]");
}
mysql_query("DELETE FROM peers WHERE userid = $id");

header("Refresh: 0; url=userdetails.php?id=$id");
?>