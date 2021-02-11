# php-website-base

PROJECT IS STILL IN DEVELOPMENT

This is some sort of PHP framework with some sort of MVC or PAC design

1. src/model contains functions / methods
2. src/control controls functions execution and store variables
3. src/view contains view (html?) and prints variables or single line functions
4. src/shared contains your personal generic classes / functions

## Executing order - hierarchical
exploded path by slashes/dots `model > control > view` or `model > api`  
in `view` you need to include next files by yourself  

example:  
```
url:  
/profile/settings  

executes:  
src/model/profile.php  
src/model/profile.settings.php  

src/control/profile.php  
src/control/profile.settings.php  

src/view/profile.php > src/view/profile.settings.php  
```

# Installation
- download this project
- for production: set document root path to `thisproject/public/`
- run web server

# Documentation
### there are some methods already done, usefull for websites
- `config.php` - app config and PDO connection (established on first use)
```
	// already included in index.php
	$dbh = dbconn()->prepare("SELECT * FROM `table` WHERE `column` = :value");
	$dbh->bindParam(':value', $value, PDO::PARAM_STR, 99);
	$dbh->execute();
	while($res = $dbh->fetch())
		echo $res['selected_column'].'<br>';
```
- `src` `account` - register / login / reminder methods
```
	if(!empty($_SESSION['user_id']))
		// logged in
```
- `src/shared/include_child.php` - including next uri path in `view`
```
	include_child();
```
- `src/shared/include_array.php` - including array, may be usefull for `view`
```
	$files = [
		'page1.subpage1.element1',
		'page1.subpage1.element2',
		'page1.subpage1.element3',
	];
	include('src/shared/include_array.php');
```
- `src/shared/class.signature.php` - sign / verify with SHA256 - don't forget to change `private-key.php` and `public-key.php`
```
	include_once('src/shared/class.signature.php');
	$array = ["somevar" => "tosign"];
	// will return encoded token with signature or return false
	$token = Signature::encode_token($array);
	// will verify signature and decode token or return false
	$array = Signature::decode_token($token);
```

### and some consts
- `FILE_PATH` - directory where main `index.php` is
- `URL_HOST` - eg. `http://localhost`
- `URL_PATH` - eg. `/directory/where/is/project/` so we can include styles and scripts by `<?=URL_PATH;?>assets/..` without worrying about friendly links and dir
- `$GLOBALS['REQUEST_URI']` - path array splitted by `/`
- `$GLOBALS['REQUEST_IP']` - client ip
