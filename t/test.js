window.addEventListener("load", loadUser);

function loadUser() {
  var x, fname = "/js/js_examples.asp";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      x = this.responseText;
      if (x == "A" || x == "B" || x == "C" || x == "D" || x == "E" || x == "F" || x == "G" || x == "H") {
        console.log(x);
      } else {
        console.log("Z");
      }
    }
  };
  xhttp.open("POST", "https://mypage.w3schools.com/mypage/alpha.php", true);
  xhttp.withCredentials = true;
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("n=" + fname);
}