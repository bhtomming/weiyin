function getPath(path){
    if("app_dev.php" === location.pathname.substring(1,location.pathname.indexOf('/',1))){
        path = "/app_dev.php"+path;
    }
    return path;
}