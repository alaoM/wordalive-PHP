
function login() {
  
    var data = new FormData(document.getElementById("login"));
    console.log(data)
  
    // (B) AJAX FETCH
    fetch("assets/includes/verify.php", { method:"POST", body:data })
    .then((res) => {
      if (res.status==200) { return res.text(); }
      else { alert(`Server error - ${res.status}`); }
    })
    .then((jwt) => {
      if (jwt=="NO") { alert("Invalid user/password"); }
      else {
        // YOU CAN STORE THE TOKEN IN LOCALSTORAGE
        localStorage.setItem("jwt", jwt);
  
        // IN A COOKIE
        let expire = new Date();
        expire.setTime(expire.getTime() + (3600000)); // 1 HR FROM NOW
        document.cookie = `jwt=${jwt};expires=${expire.toUTCString()}`;  
        alert("ok")
      /*   location.replace("index.php") */
      }
    });
    return false;
  }