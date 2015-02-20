<?
header('Content-Type: image/jpeg');
//readfile('/images/'.$_GET['id']);




if (substr_count($_SERVER['REQUEST_URI'], '?')>=2){
    $r=explode('?',$_GET['id']);
    $_GET['id']=$r[0];
}; //echo $_GET['id'];
if (substr_count($_GET['id'], 'w')!=0){
 include('classSimpleImage.php');
 $imm=strtr($_GET['id'],array('w'=>''));
   $image = new SimpleImage();
   $image->load($imm);
 //$image->resizeToWidth(98);
 $image->resizeToHeight(40);
   $image->output();
    
}elseif (substr_count($_GET['id'], 'z')!=0){
 include('classSimpleImage.php');
 $imm=strtr($_GET['id'],array('z'=>''));
   $image = new SimpleImage();
   $image->load($imm);
 $image->resizeToWidth(170);
   $image->output();
    
}else
readfile($_GET['id']);
?>