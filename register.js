// register.php functions and variables

let verifyPasswdText = document.getElementById("passwordUnverify");
let validColor = "#48C76A";
let invalidColor = "#E85D5D";
let passwd = document.getElementById("quizPassword");
let verifyPasswd = document.getElementById("confirmPassword");

passwd.addEventListener("input", passwdVerify);
verifyPasswd.addEventListener("input", passwdVerify);

function passwdVerify () {
    if (!(passwd.value.length === 0 && verifyPasswd.value.length === 0)) {
        if (passwd.value === verifyPasswd.value) {
            passwd.style.backgroundColor = validColor;
            verifyPasswd.style.backgroundColor = validColor;
            verifyPasswdText.style.display = "none";
        } else {
            passwd.style.backgroundColor = invalidColor;
            verifyPasswd.style.backgroundColor = invalidColor;
            verifyPasswdText.style.display = "inline";
        }
    }
}