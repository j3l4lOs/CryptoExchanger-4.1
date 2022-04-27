<?php
define('CryptExchanger_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("app/includes/bootstrap.php");
$a = protect($_GET['a']);
function file_perms($file, $octal = false) {
    if(!file_exists($file)) return false;
    $perms = fileperms($file);
    $cut = $octal ? 2 : 3;
    return substr(decoct($perms), $cut);
}

function is_writable_r($dir) {
    if (is_dir($dir)) {
        if(is_writable($dir)){
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (!is_writable_r($dir."/".$object)) return false;
                    else continue;
                }
            }   
            return true;   
        }else{
            return false;
        }
       
    }else if(file_exists($dir)){
        return (is_writable($dir));
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Install Wizard - CryptoExchanger v4.0</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="app/admin/assets/vendors/iconfonts/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="app/admin/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="app/admin/assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="app/admin/assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/icheck/skins/all.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="app/admin/assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="app/admin/assets/images/favicon.png" />
</head>

<body class="boxed-layout">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="./install.php"><img src="app/admin/assets/images/site_logo2_install.png" class="mr-2" style="width:100px;height:50px;" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="./install.php"><img src="app/admin/assets/images/site_logo_mini.png" style="width:50px;height:50px;" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-layout-grid2"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
         <li class="nav-item <?php if($a == "") { echo 'active'; } ?>">
            <a class="nav-link" href="./install.php">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Start</span>
            </a>
          </li>
          <li class="nav-item <?php if($a == "mysql") { echo 'active'; } ?>">
            <a class="nav-link" href="./install.php?a=mysql">
              <i class="fa fa-database menu-icon"></i>
              <span class="menu-title">MySQL Settings</span>
            </a>
          </li>
          <li class="nav-item <?php if($a == "web") { echo 'active'; } ?>">
            <a class="nav-link" href="./install.php?a=web">
              <i class="fa fa-globe menu-icon"></i>
              <span class="menu-title">Web Settings</span>
            </a>
          </li>
          <li class="nav-item <?php if($a == "admin") { echo 'active'; } ?>">
            <a class="nav-link" href="./install.php?a=admin">
              <i class="fa fa-user-plus menu-icon"></i>
              <span class="menu-title">Admin Settings</span>
            </a>
          </li>
          <li class="nav-item <?php if($a == "finish") { echo 'active'; } ?>">
            <a class="nav-link" href="./install.php?a=finish">
              <i class="fa fa-flag menu-icon"></i>
              <span class="menu-title">Finish</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">

            <?php
            if($a == "mysql") {
                ?>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">MySQL Settings</h4>
                        
                        <?php
                        if(isset($_POST['goNext'])) {
                            $mysql_host = protect($_POST['mysql_host']);
                            $mysql_user = protect($_POST['mysql_user']);
                            $mysql_pass = protect($_POST['mysql_pass']);
                            $mysql_name = protect($_POST['mysql_name']);
                            
                            if(empty($mysql_host) or empty($mysql_user) or empty($mysql_pass) or empty($mysql_name)) { echo error("All fields are required."); }
                            else {
                                $db = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_name);
                                if ($db->connect_errno) {
                                    echo error("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
                                } else {
                                    $_SESSION['mysql_host'] = $mysql_host;
                                    $_SESSION['mysql_user'] = $mysql_user;
                                    $_SESSION['mysql_pass'] = $mysql_pass;
                                    $_SESSION['mysql_name'] = $mysql_name;
                                    header("Location: ./install.php?a=web");
                                }
                            }
                        } 
                        ?>

                        <form action="" method="POST">
										<div class="form-group">
											<label>MySQL Host</label>
											<input type="text" class="form-control" name="mysql_host" value="<?php if(isset($_POST['mysql_host'])) { echo $_POST['mysql_host']; } ?>">
										</div>
										<div class="form-group">
											<label>MySQL Username</label>
											<input type="text" class="form-control" name="mysql_user" value="<?php if(isset($_POST['mysql_user'])) { echo $_POST['mysql_user']; } ?>">
										</div>
										<div class="form-group">
											<label>MySQL Password</label>
											<input type="password" class="form-control" name="mysql_pass" value="<?php if(isset($_POST['mysql_pass'])) { echo $_POST['mysql_pass']; } ?>">
										</div>
										<div class="form-group">
											<label>MySQL Database</label>
											<input type="text" class="form-control" name="mysql_name" value="<?php if(isset($_POST['mysql_name'])) { echo $_POST['mysql_name']; } ?>">
										</div>
										<button type="submit" class="btn btn-primary" name="goNext" value="yes">Next</button>
									</form>
                    </div>
            </div>
            </div>
                <?php
            } elseif($a == "web") {
                ?>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Web Settings</h4>
                        
                        <?php
                        if(isset($_POST['goNext'])) {
                            $title = protect($_POST['title']);
                            $description = protect($_POST['description']);
                            $keywords = protect($_POST['keywords']);
                            $name = protect($_POST['name']);
                            $infoemail = protect($_POST['infoemail']);
                            $supportemail = protect($_POST['supportemail']);
                            $url = protect($_POST['url']);
                            $default_language = protect($_POST['default_language']);
                            $default_template = protect($_POST['default_template']);
                           
                            if(empty($title) or empty($description) or empty($keywords) or empty($name) or empty($url) or empty($infoemail) or empty($supportemail)) {
                        echo error("All fields are required."); 
                    } elseif(!isValidEmail($infoemail)) { echo error("Please enter valid info email address. Example: no-reply@yourdomain.com"); }
                            elseif(!isValidEmail($supportemail)) { echo error("Please enter valid support email address. Example: support@yourdomain.com"); }
                            elseif(!isValidURL($url)) { echo error("Please enter valid site url address. Example: http://yourdomain.com/"); }
                            else {
                                $_SESSION['web_title'] = $title;
                                $_SESSION['web_description'] = $description;
                                $_SESSION['web_keywords'] = $keywords;
                                $_SESSION['web_name'] = $name;
                                $_SESSION['web_infoemail'] = $infoemail;
                                $_SESSION['web_supportemail'] = $supportemail;
                                $_SESSION['web_url'] = $url;
                                $_SESSION['web_default_language'] = $default_language;
                                $_SESSION['web_default_template'] = $default_template;
                                header("Location: ./install.php?a=admin");
                            }
                        }
                        ?>

                                    <form action="" method="POST">
										<div class="form-group">
											<label>Title</label>
											<input type="text" class="form-control" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>">
										</div>
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control" name="description" rows="2"><?php if(isset($_POST['description'])) { echo $_POST['description']; } ?></textarea>
										</div>
										<div class="form-group">
											<label>Keywords</label>
											<textarea class="form-control" name="keywords" rows="2"><?php if(isset($_POST['keywords'])) { echo $_POST['keywords']; } ?></textarea>
										</div>
										<div class="form-group">
											<label>Site name</label>
											<input type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>">
										</div>
										<div class="form-group">
											<label>Info email address</label>
											<input type="text" class="form-control" name="infoemail" value="<?php if(isset($_POST['infoemail'])) { echo $_POST['infoemail']; } ?>">
										</div>
										<div class="form-group">
											<label>Support email address</label>
											<input type="text" class="form-control" name="supportemail" value="<?php if(isset($_POST['supportemail'])) { echo $_POST['supportemail']; } ?>">
										</div>
										<div class="form-group">
											<label>Site url address</label>
											<input type="text" class="form-control" name="url" value="<?php if(isset($_POST['url'])) { echo $_POST['url']; } ?>" placeholder="Example: http://yourwebsite.com/">
										</div>
										<div class="form-group">
											<label>Default language</label>
											<select class="form-control" name="default_language">
											<?php
											if ($handle = opendir('./app/languages')) {
												while (false !== ($file = readdir($handle)))
												{
													if ($file != "." && $file != ".." && $file != "index.php" && strtolower(substr($file, strrpos($file, '.') + 1)) == 'php')
													{
														$lang = str_ireplace(".php","",$file);
														echo '<option value="'.$lang.'" '.$sel.'>'.$lang.'</option>';
													}
												}
												closedir($handle);
											}
											?>
											</select>
										</div>
										<div class="form-group">
											<label>Default template</label>
											<select class="form-control" name="default_template">
											<?php
											$templates = glob("./app/templates/*");
											foreach($templates as $tpln => $tplv) {
												$tpl = str_ireplace("./app/templates/","",$tplv);
												if($tpl != "Email_Templates" && $tpl != "index.php") {
													echo '<option value="'.$tpl.'" '.$sel.'>'.$tpl.'</option>';
												}
											}
											?>
											</select>
										</div>
										<button type="submit" class="btn btn-primary" name="goNext">Next</button>
									</form>
                    </div>
            </div>
            </div>
                <?php
            } elseif($a == "admin") {
                ?>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Admin Settings</h4>
                        
                        <?php
                        if(isset($_POST['goNext'])) {
									$username = protect($_POST['admin_username']);
									$password = protect($_POST['admin_password']);
									$email = protect($_POST['admin_email']);
									if(empty($username) or empty($password) or empty($email)) { echo error("All fields are required."); } 
									elseif(!isValidUsername($username)) { echo error("Please enter valid username."); }
									elseif(!isValidEmail($email)) { echo error("Please enter valid email address."); }
									else {
										$_SESSION['admin_username'] = $username;
										$_SESSION['admin_password'] = $password;
										$_SESSION['admin_email'] = $email;
										header("Location: ./install.php?a=finish");
                                    }
            }
									?>
									
									<form action="" method="POST">
										<div class="form-group">
											<label>Admin username</label>
											<input type="text" class="form-control" name="admin_username" value="<?php if(isset($_POST['admin_username'])) { echo $_POST['admin_username']; } ?>">
										</div>
										<div class="form-group">
											<label>Admin email address</label>
											<input type="text" class="form-control" name="admin_email" value="<?php if(isset($_POST['admin_email'])) { echo $_POST['admin_email']; } ?>">
										</div>
										<div class="form-group">
											<label>Admin password</label>
											<input type="password" class="form-control" name="admin_password" value="<?php if(isset($_POST['admin_password'])) { echo $_POST['admin_password']; } ?>">
										</div>
										<button type="submit" class="btn btn-primary" name="goNext">Finish</button>
									</form>
								
                    </div>
            </div>
            </div>
                <?php
            } elseif($a == "finish") {
                ?>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Finish</h4>
                        
                        <?php
                        $title = $_SESSION['web_title'];
                        $description = $_SESSION['web_description'];
                        $keywords = $_SESSION['web_keywords'];
                        $name = $_SESSION['web_name'];
                        $url = $_SESSION['web_url'];
                        $infoemail = $_SESSION['web_infoemail'];
                        $supportemail = $_SESSION['web_supportemail'];
                        $default_template = $_SESSION['web_default_template'];
                        $default_language = $_SESSION['web_default_language'];	
                        $admin_username = $_SESSION['admin_username'];
                        $admin_password = $_SESSION['admin_password'];
                        $admin_pass = password_hash($admin_password, PASSWORD_DEFAULT);
                        $admin_email = $_SESSION['admin_email'];
                        $mysql_host = $_SESSION['mysql_host'];
                        $mysql_user = $_SESSION['mysql_user'];
                        $mysql_pass = $_SESSION['mysql_pass'];
                        $mysql_name = $_SESSION['mysql_name'];
                        $db = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_name);
			 						$db->set_charset("utf8");
									
											
									$sql_contents = file_get_contents("database.sql");
									$sql_contents = explode(";", $sql_contents);

									foreach($sql_contents as $k=>$v) {
										$db->query($v);
									}
									$current .= '<?php
';
									$current .= 'if(!defined("CryptExchanger_INSTALLED")) { header("HTTP/1.0 404 Not Found"); exit; }
';
									$current .= '$CONF = array();
';
									$current .= '$CONF["host"] = "'.$mysql_host.'";
';
									$current .= '$CONF["user"] = "'.$mysql_user.'";
';
									$current .= '$CONF["pass"] = "'.$mysql_pass.'";
';
									$current .= '$CONF["name"] = "'.$mysql_name.'";
';
									$current .= '?>';
									file_put_contents("app/configs/sql.settings.php", $current);
									$insert = $db->query("INSERT ce_settings (title) VALUES ('Installing...')");
									$update = $db->query("UPDATE ce_settings SET default_template='$default_template',default_language='$default_language',title='$title',description='$description',keywords='$keywords',name='$name',url='$url',infoemail='$infoemail',supportemail='$supportemail'");
									$insert_admin = $db->query("INSERT ce_users (password,email,username,status,level) VALUES ('$admin_pass','$admin_email','$admin_username','1','1')");
                                    @unlink("./install.php");
                                    @unlink("./database.sql");
                                    echo success("Your CryptoExchanger v4.0 is installed and ready for use.");
                        ?>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Website url address:</td>
                                        <td><a href="<?php echo $url; ?>"><?php echo $url; ?></a></td>
                                </tr>
                                <tr>
                                    <td>Admin panel url address:</td>
                                    <td><a href="<?php echo $url; ?>app/admin"><?php echo $url; ?>app/admin</a></td>
                                </tr>
                                <tr>
                                    <td>Admin username:</td>
                                    <td><?php echo $admin_username; ?></td>
                                </tr>
                                <tr>
                                    <td>Admin password:</td>
                                    <td><?php echo $admin_password; ?></td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
								
                    </div>
            </div>
            </div>
                <?php
            } else { 
            ?>
                    <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Welcome to CryptoExchanger v4.0 Install Wizard</h4>
                        <p class="card-description">
                        Our system will automatically check the settings of your hosting or server, you can check table below. If everything goes well, the installation will be successful and the script will run smoothly. If you need help with installation or have some issues, you can contact us <b>support@cryptoexchangerscript.com</b>.
                        </p>
                       
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Required module or action</th>
                                            <th>Status</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <td>PHP Version <b>5.6+</b></td>
                                            <td>
                                                <?php
                                                if(phpversion() > 5.4) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> '.phpversion().'</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> '.phpversion().'</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chmod 0777 of file <b>install.php</b></td>
                                            <td>
                                                <?php
                                                $file_perm = file_perms("./install.php");
                                                if($file_perm == "0777") {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chmod 0777 of folder <b>app/configs</b></td>
                                            <td>
                                                <?php
                                                $dir_perm = is_writable_r("./app/configs");
                                                if($dir_perm == "0777") {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PHP Extension <b>mysqli</b></td>
                                            <td>
                                                <?php
                                                if(extension_loaded('mysqli')) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PHP Extension <b>gmp</b></td>
                                            <td>
                                                <?php
                                                if(extension_loaded('gmp')) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PHP Extension <b>curl</b></td>
                                            <td>
                                                <?php
                                                if(extension_loaded('curl')) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PHP Extension <b>mcrypt</b></td>
                                            <td>
                                                <?php
                                                if(extension_loaded('mcrypt')) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PHP Extension <b>soap</b></td>
                                            <td>
                                                <?php
                                                if(extension_loaded('soap')) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Yes</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> No</span>';    
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <center>
                            <a href="./install.php?a=mysql" class="btn btn-primary">Start Installation</a>
                                            </center>
                        </div>
                    </div>
                    </div>
            <?php
            }
            ?>
            
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="http://tiny.cc/ra1xiz" target="_blank">CryptoExchanger v4.1</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>
