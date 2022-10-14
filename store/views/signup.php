<?php
require_once 'connection.php';
// require 'header.php';
// require 'footer.php';

class Singup
{
    private $fname;
    private $lname;
    private $email;
    private $phone;
    private $password;
    private $address;
    private $city;

    function __construct(
        $fname,
        $lname,
        $email,
        $password,
        $phone,
        $address,
        $city
    ) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phone = $phone;
        $this->city = $city;
    }

    public function getfName()
    {
        return $this->fname;
    }
    public function getlName()
    {
        return $this->lname;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function setfName($fname)
    {
        $this->fname = $fname;
    }
    public function setlName($lname)
    {
        $this->lname = $lname;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['register'])) {
    $nameErr = $emailErr = $phoneErr = $cpassErr = $passErr = ' ';
    $nameEr = $emailEr = $phoneEr = $passEr = $cpassEr = $addressEr = $cityEr = false;

    $Singup = new Singup(
        $_POST['fname'],
        $_POST['lname'],
        $_POST['email'],
        $_POST['password'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['city']
    );
    print_r($Singup);

    $query = 'SELECT * from `users` where email=?';
    $query = $connect->prepare($query);
    $query->execute([$Singup->getEmail()]);

    $isFound = $query->fetch(PDO::FETCH_OBJ);
    print_r($isFound);

    if (empty($isFound)) {
        if (empty($Singup->getfName())) {
            $nameErr = 'Name is required';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert(   '$nameErr') </script>";
        } else {
            $Singup->setfName(test_input($Singup->getfName()));
            // check if name only contains letters and whitespace
            if (
                !preg_match('/^[a-zA-Z\s]*$/', $Singup->getfName()) &&
                strlen($Singup->getfName()) > 4
            ) {
                $nameErr = 'Only letters and white space allowed';
                echo "<script>location.href = 'index.php?err=signup'</script>";
                echo "<script>alert(   '$nameErr') </script>";
            } else {
                $nameEr = true;
            }
        }

        if (empty($Singup->getEmail())) {
            $emailErr = 'Name is required';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert(   '$emailErr') </script>";
        } else {
            $Singup->setEmail(test_input($Singup->getEmail()));
            // $emailEr = false;
            // check if name only contains letters and whitespace

            if (!filter_var($Singup->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $emailErr = 'Invalid email format';
                echo "<script>location.href = 'index.php?err=signup'</script>";
                echo "<script>alert(   '$emailErr') </script>";
            } else {
                $emailEr = true;
            }
        }

        if (empty($Singup->getPhone())) {
            $phoneErr = 'phone is required';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert(   '$phoneErr') </script>";
        } else {
            $Singup->setPhone(test_input($Singup->getPhone()));

            // check if name only contains letters and whitespace
            if (!preg_match('/^\d{10}$/', $Singup->getPhone())) {
                $phoneErr = 'Invalid phone number format';
                echo "<script>location.href = 'index.php?err=signup'</script>";
                echo "<script>alert(   '$phoneErr') </script>";
            } else {
                $phoneEr = true;
            }
        }

        if (empty($Singup->getPassword())) {
            $passErr = 'password is required';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert(   '$passErr') </script>";
        } else {
            $Singup->setPassword(test_input($Singup->getPassword()));

            // check if name only contains letters and whitespace
            if (
                !preg_match(
                    "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/",
                    $Singup->getPassword()
                )
            ) {
                $passErr = 'Invalid password format';
                echo "<script>location.href = 'index.php?err=signup'</script>";
                echo "<script>alert(   '$passErr') </script>";
            } else {
                $passEr = true;
            }
        }

        // form validation for confirm password
        if ($_REQUEST['cuser_password'] != $Singup->getPassword()) {
            $cpassErr = 'Confirm Password doesnot Matche';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert('$cpassErr') </script>";
        } else {
            $cpassEr = true;
        }

        if (empty($Singup->getAddress())) {
            $addressErr = 'Address is required';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert(   '$addressErr') </script>";
        } else {
            $Singup->setAddress(test_input($Singup->getAddress()));
            $addressEr = true;
        }

        if (empty($Singup->getCity())) {
            $cityErr = 'city is required';
            echo "<script>location.href = 'index.php?err=signup'</script>";
            echo "<script>alert(   '$cityErr ') </script>";
        } else {
            $Singup->setCity(test_input($Singup->getCity()));
            $cityEr = true;
        }

        if (
            $nameEr &&
            $emailEr &&
            $phoneEr &&
            $passEr &&
            $cpassEr &&
            $cityEr &&
            $addressEr
        ) {
            $q =
                'INSERT INTO users (first_name,last_name, address, phone, email, password,city) VALUES (?,?,?,?,?,?,?)';
            // echo "<script> alert( 'test')  </script>";

            $stmt = $connect->prepare($q);
            $stmt->execute([
                $Singup->getfName(),
                $Singup->getlName(),
                $Singup->getAddress(),
                $Singup->getPhone(),
                $Singup->getEmail(),
                $Singup->getPassword(),
                $Singup->getCity(),
            ]);
            $emailUser = $Singup->getEmail();
            $lastUser = $connect->query(
                "SELECT * FROM users WHERE email='$emailUser'"
            );
            $lastUser = $lastUser->fetch();
            $_SESSION['userid'] = $lastUser['user_id'];
            if (isset($_GET['from'])) {
                $cartInVisitor = $_SESSION['cartVisitor'];
                foreach ($cartInVisitor as $cart) {
                    $userId = $_SESSION['userid'];
                    $sql = $connect->query("INSERT INTO cart (user_id, product_id , quantity)
					VALUES ('$userId','$cart[0]','$cart[1]')");
                }
                unset($_SESSION['cartVisitor']);
                $total = $_POST['totalPrice'];
                if (isset($_POST['coupon'])) {
                    $coupon = $_POST['coupon'];
                    header("location: ./checkout.php?price=$total&c=$coupon");
                } else {
                    header("location: ./checkout.php?price=$total&c=0");
                }
            } else {
                header('location:index.php');
            }
        }
    } else {
        $emailErr = 'It looks like you’re connected try login. Please ';
        echo "<script>location.href = 'index.php?err=signup'</script>";
        echo "<script>alert(   '$emailErr') </script>";
    }
}
?>
