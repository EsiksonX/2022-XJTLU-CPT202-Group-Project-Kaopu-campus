
    function checkPhoneNumber (number) {
        var pattern = /^[1][3,4,5,6,7,8,9][0-9]{9}$/;
        if (number == null) {
            alert(1234)
            alert("phone number cannot be empty");
            return false;
        }
        if (!pattern.test(number)) {
            alert("phone number is not valid");
            return false;
        } else {
            return true;
        }
    }
    function checkPassword(password) {
        var pattern1 = /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/;
        // 6-16个英文字母和数字
        if (password == null) {
            alert("The password cannot be empty");
            return false;
        }
        if (!pattern1.test(password)) {
            alert("Invalid password");
            return false;
        } else {
            return true;
        }
    }
    function checkConfirmPassword (password, confirmpassword){
        var pattern1 = /^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/;
        if (confirmpassword == null) {
            alert("The password cannot be empty");
            return false;
        }
        if (!pattern1.test(confirmpassword)) {
            alert("Invalid password");
            return false;
        } else if (password != confirmpassword) {
            alert("The passwords are inconsistent")
            return false;
        } else {
            return true
        }
    }
    function docheck() {
        var password = document.getElementById("password").value;
        var number = document.getElementById("phonenumber").value;
        var passwordconform = document.getElementById("confirmPassword").value;
        console.log(number);
        console.log(passwordconform);
        console.log(password);
        var a = checkPhoneNumber(number);
        var b = checkPassword(password);
        var c = checkConfirmPassword(password, passwordconform);

            if(a&&b&&c){

                $.ajax({
                    type: "POST",
                    url: "php/zhuce.php",
                    data: `number=${number}&password=${password}`,
                    success: function (msg){
                        if (msg == 1){
                            alert("phone number has Already registered. ")
                        }else if (msg == 2){
                            alert("success!")
                        }else {
                            alert(msg);
                        }

                    }
                });

        }



}