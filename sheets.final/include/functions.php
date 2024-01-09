<?php
session_start();
define('PWD_MIN_LENGTH', 8);
define('ERROR_USERNAME_TAKEN', 1062);

function getDbConnection() {
    try {
    $db= new PDO("mysql:dbname=blinkdb;host=127.0.0.1", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException) {
        echo 'Website under maintenence.';
        exit();
    }
    return $db;
}

function getProductToEdit(): object | null {
    try {
        if (!isset($_GET['id'])) {
            return null;
        }
        $id = $_GET['id'];
        $stmt = getDbConnection()->query("SELECT * FROM products WHERE id = $id");
        return $stmt->fetchObject();
    } catch (Exception) {
        echo 'Problem fetching product for edit!';
        exit();
    }
}

function getProducts(): PDOStatement {
    try {
        return getDbConnection()->query('SELECT p.id, p.image_name, p.print_size,
        p.finish, p.price, i.id as image_id
        from products p LEFT JOIN image i ON p.id = i.product_id');
    } catch (PDOException) {
        echo 'Error loading products!';
        exit();
    }
}

function deleteProduct(int $id): void {
    try {
        getDbConnection()->query('DELETE FROM products WHERE id = ' . $id);
    } catch (PDOException) {
        echo 'Error deleting product!';
    }
}

function handleSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    list($id, $imageName, $printSize, $finish, $price) = getPostValues();

    if (empty($imageName) || empty($printSize) || empty($finish) || !is_numeric($price)) {
        return 'All fields are required, quantity and price must be numeric.';
    }

    if (is_numeric($id)) {
        $sql = "UPDATE products SET image_name = '$imageName', print_size = '$printSize', 
        finish = '$finish', price = $price
        WHERE id = $id";
    } else {
        $sql = "INSERT products (image_name, print_size, finish, price)
        VALUES ('$imageName', '$printSize', '$finish', $price)";
    }
    try {
        $db = getDbConnection();
        $db->query($sql);

        if (!is_numeric($id)) {
            $id = $db->lastInsertId(); // get the newly inserted ID
        }
        handleImageUpload($id);

        header('Location: admin-inventory.php');
        exit();
    } catch (PDOException $e) {
        return 'Problem saving product to database!';
    }
}

function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}

function isAdmin(): bool {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function newuserSubmit(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $firstname = $_POST['firstname'];
        $middlei = $_POST['middlei'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (empty($username) || empty($password) || empty($confirm) || empty($firstname) || empty($lastname) || empty($email)) {
            throw new Exception('First and last name, username, password and email address are required.');
        }

        if ($password !== $confirm) {
            throw new Exception('Passwords must be identical.');
        }

        if (strlen($password) < PWD_MIN_LENGTH) {
            throw new Exception('Password must be at minimum ' . PWD_MIN_LENGTH . ' characters');
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);


        $sql = "INSERT INTO users(username, password, first_name, middle_init, last_name, email, phone)
            VALUES('$username', '$hash', '$firstname', '$middlei', '$lastname', '$email', '$phone')";

            getDbConnection()->query($sql);
            $_SESSION['message'] = 'New account created successfully.';
            header('Location: login.php');
            exit();
    } catch (PDOException $e) {
        if (($e->errorInfo[1] ?? 0) === ERROR_USERNAME_TAKEN) {
            $_SESSION['message'] = 'Username already in use.';
        } else {
            $_SESSION['message'] = 'Error creating user.';
        }
        $location = 'newuser.php';
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $location = 'newuser.php';
    } finally {
        header('Location: ' . $location);
    }
}

function editAcctSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    list($id, $firstname, $middlei, $lastname, $email, $phone) = getUserDetails();

    if (is_numeric($id)) {
        $sql = "UPDATE users SET first_name = '$firstname', middle_init = '$middlei', 
        last_name = '$lastname', email = '$email', phone = '$phone' 
        WHERE id = $id";
    }

    try {
        getDbConnection()->query($sql);
        $_SESSION['message'] = 'Information Updated!';
        header('Location: editAcct.php');
        exit();
    } catch (PDOException $e) {
        return 'Problem saving user information!';
    }
}

function editMyAcctSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    list($id, $firstname, $middlei, $lastname, $email, $phone) = getUserDetails();

    if (is_numeric($id)) {
        $sql = "UPDATE users SET first_name = '$firstname', middle_init = '$middlei', 
        last_name = '$lastname', email = '$email', phone = '$phone' 
        WHERE id = $id";
    }

    try {
        getDbConnection()->query($sql);
        $_SESSION['message'] = 'Information Updated!';
        header('Location: editMyAcct.php');
        exit();
    } catch (PDOException $e) {
        return 'Problem saving user information!';
    }
}

function getUserDetails(): array {
    return [
        $_POST['id'],
        $_POST['first_name'],
        $_POST['middle_init'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone']
    ];
}

function getUserInfo(): object | null {
    try {
        if(!isset($_GET['id'])) {
            return null;
        }
        $id = $_GET['id'];
        $stmt = getDbConnection()->query("SELECT * FROM users WHERE id = $id");
        return $stmt->fetchObject();
    } catch (Exception) {
        echo 'Problem getting user info!';
        exit();
    }
}

function getUserInfoFromSession(): object | null {
    return $_SESSION['user'] ?? null;
}

function getUsers(): PDOStatement {
    try {
        return getDbConnection()->query('SELECT * from users');
    } catch (PDOException) {
        echo 'Error finding user!';
        exit();
    }
}

function newAddressSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    try {
        $id = $_POST['id'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $user = $_SESSION['user'];
        $userId = $user->id;

        if (empty($address1) || empty($city) || empty($state) || empty($zip)) {
            throw new Exception('All fields are required.');
        }

        if (is_numeric($id)) {
           $sql = "UPDATE address SET address_line1 = '$address1', address_line2 = '$address2', 
           city = '$city', state = '$state', zip = '$zip'
           WHERE id = $id";
        } else {
            $sql = "INSERT address (address_line1, address_line2, city, state, zip, user_id)
            VALUES('$address1', '$address2', '$city', '$state', '$zip', '$userId')";
        }

            getDbConnection()->query($sql);
            $_SESSION['message'] = 'Address added successfully.';
            header('Location: address.php');
            exit();
    } catch (PDOException $e) {
        return 'Problem saving address!';
    }
}

function getAddresses(): PDOStatement {
    try {
        $user = $_SESSION['user'];
        $userId = $user->id;
        return getDbConnection()->query("SELECT * from address WHERE user_id = $userId");
    } catch (PDOException) {
        echo 'Error finding information!';
        exit();
    }
}

function getUserAddressToEdit(): object | null {
    try {
        if(!isset($_GET['id'])) {
            return null;
        }
        $id = $_GET['id'];
        // $user = $_SESSION['user'];
        // $userId = $user->id;
        $stmt = getDbConnection()->query("SELECT * FROM address WHERE id = $id");
        return $stmt->fetchObject();
    } catch (Exception) {
        echo 'Problem getting addresses.';
        exit();
    }
}

function deleteAddress(int $id): void {
    try {
        getDbConnection()->query('DELETE FROM address WHERE id = ' . $id);
    } catch (PDOException) {
        echo 'Error deleting address!';
    }
}

function displayMessage(): string {
	$msg = $_SESSION['message'] ?? '';
	unset($_SESSION['message']);
	return $msg;
}

function changePwSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $id = $user->id;
    } else {
      echo 'Error changing password!';
      header('Location: changepw.php');
      exit();
    }
  
    try {
    $newpass = $_POST['new_pass'];
    $verify = $_POST['verify'];

    if (empty($newpass) || empty($verify)) {
        throw new Exception('All fields are required.');
    }

    if ($newpass !== $verify) {
        throw new Exception('Passwords must be identical.');
    }

    if (strlen($newpass) < PWD_MIN_LENGTH) {
        throw new Exception('Password must be at minimum ' . PWD_MIN_LENGTH . ' characters');
    }

    $hash = password_hash($newpass, PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password = '$hash' WHERE id = $id";

            getDbConnection()->query($sql);
            $_SESSION = [];
            $_SESSION['message'] = 'Password changed successfully! You have been logged out for security.';
            header('Location: login.php');
            exit();
    } catch (PDOException $e) {
            return 'Problem updating password!';
        }
    }

function loginSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        return 'All fields required.';
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";

    try {
        $result = getDbConnection()->query($sql);

        if ($result->rowCount() !== 1) {
            return 'User not found.';
        }

        $user = $result->fetchObject();

        if (!password_verify($password, $user->password)) {
            return 'Incorrect username or password.';
        }

        unset($user->password);
        $_SESSION['user'] = $user;
        $_SESSION['is_admin'] = $user->is_admin;
        $_SESSION['username'] = $user->username;
        $_SESSION['cart'] = [];
        $_SESSION['message'] = "We like to develop while we develop, some site 
            features may be unavailable during periodic maintenence!";
        header('Location: products.php');
        exit();
    } catch (PDOException $e) {
        return 'Error logging in!';
    }
}

function getPostValues(): array {
    return [
    $_POST['id'],
    $_POST['image_name'],
    $_POST['print_size'],
    $_POST['finish'],
    $_POST['price'],
    ];
}

function handleImageUpload(int $productId): void {
    try {
        $image = $_FILES['image'];
        $filename = $image['name'];
        $size = $image['size'];
        $type = $image['type'];
        $tmpPath = $image['tmp_name'];

        if (!file_exists($tmpPath)) {
            throw new Exception("$filename not found at temp location.");
        }

        $handler = fopen($tmpPath, 'r');
        $data = fread($handler, $size);
        fclose($handler);

        $data = getDbConnection()->quote($data);

        $sql = "INSERT INTO image(filename, mimetype, imagedata, product_id) 
        VALUES('$filename', '$type', $data, $productId)";
        getDbConnection()->query($sql);
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }
}

function getImage(): void {
    $imageId = $_GET['id'] ?? null;

    if (!$imageId) {
        return;
    }

    try {
        $result = getDbConnection()->query("SELECT * from image WHERE id = $imageId");
        
        if($result->rowCount() !== 1) {
            throw new Exception('Problem fetching image!');
        }

        $image = $result->fetchObject();
        header('Content-Type: ' . $image->mimetype);
		echo $image->imagedata;
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
    }
}

function addToCart(): void {
    $productId = $_GET['id'] ?? null;
    $action = $_GET['action'] ?? null;

    if (!$productId || !$action) {
        return;
    }

    if ($action == 'add') {
        array_push($_SESSION['cart'], $productId);
    } else {
        $newCart = [];

        foreach($_SESSION['cart'] as $id) {
            if ($id !== $productId) {
                array_push($newCart, $id);
            }
        }
        $_SESSION['cart'] = $newCart;
    }

    header('Location: products.php');
}

function addRemoveLink(int $productId): string {
    if(in_array($productId, $_SESSION['cart'])) {
        $action = "remove";
        $actionText = "Remove from Cart";
    } else {
        $action = "add";
        $actionText = "Add to Cart";
    }

    return "<a href=\"products.php?id=$productId&action=$action\">$actionText</a>";
}

function deleteCustomOrder(int $id): void {
    try {
        getDbConnection()->query('DELETE FROM customorder WHERE id = ' . $id);
    } catch (PDOException) {
        echo 'Error deleting request!';
    }
}

function newCustOrderSubmit(): ?string {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return null;
    }

    try {
        $id = $_POST['id'];
        $cimage = $_POST['cimage'];
        $csize = $_POST['csize'];
        $cfinish = $_POST['cfinish'];
        $user = $_SESSION['user'];
        $userId = $user->id;

    if (empty($cimage) || empty($csize) || empty($cfinish)) {
        throw New Exception('All fields are required!');
    }

    if (is_numeric($id)) {
        $sql = "UPDATE customorder SET cimage = '$cimage', csize = '$csize', 
        cfinish = '$cfinish'
        WHERE id = $id";
    } else {
        $sql = "INSERT customorder (cimage, csize, cfinish, user_id)
        VALUES('$cimage', '$csize', '$cfinish', '$userId')";
    }

        getDbConnection()->query($sql);
        $_SESSION['message'] = "Custom order submitted successfully! 
                    We'll email you with updates to your order.";
        header('Location: custom-order.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
    } finally {
        header('Location: custom-order.php');
    }
}

function getAllCustOrders(): PDOStatement {
    try {
        $user = $_SESSION['user'];
        $userId = $user->id;
        return getDbConnection()->query("SELECT * from customorder WHERE user_id = $userId");
    } catch (PDOException) {
        echo 'Error finding orders!';
        exit();
    }
}

function getCustOrderToEdit(): object | null {
    try {
        if(!isset($_GET['id'])) {
            return null;
        }
        $id = $_GET['id'];
        $stmt = getDbConnection()->query("SELECT * FROM customorder WHERE id = $id");
        return $stmt->fetchObject();
    } catch (Exception) {
        echo 'Problem getting custom order request.';
        exit();
    }
}