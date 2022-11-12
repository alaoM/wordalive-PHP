

$('#login').on('submit', async function (e) {

  let url = 'assets/includes/uploadForm/forms.php';
  e.preventDefault();
  let formdata = new FormData(this);
  let email = formdata.get("email");
  let pswd = formdata.get("password");
  
  $.ajax({
    url: url,
    type: 'post',
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    data: {
      "func": "login",     
      "email": email,
      "pswd": pswd,
    },
    success: async function (response) {
      const resp = JSON.parse(response);
      if (resp.status) {
        localStorage.setItem("jwt", resp.message);

        let expire = new Date();
        expire.setTime(expire.getTime() + (3600000)); // 1 HR FROM NOW
        document.cookie = `jwt=${resp.message};expires=${expire.toUTCString()}`;
        location.href = "index.php";
      } else {
       showError(resp.message)
      }
    },
    error: function (error) {
      console.log(error)
    }
  });
});
$('#signup').on('submit', function (e) {
  let url = 'assets/includes/uploadForm/forms.php';
  e.preventDefault();
  let formdata = new FormData(this);
  let name = formdata.get("name");
  let username = formdata.get("username");
  let email = formdata.get("email");
  let pswd = formdata.get("password");
  $.ajax({
    url: url,
    type: 'post',
    data: {
      "func": "signup",
      "name": name,
      "username": username,
      "email": email,
      "pswd": pswd,
    },
    success: function (response) {
      const resp = JSON.parse(response);
      if (resp.status) {
        location.href = "sign-in.php";
      } else {
       showError(resp.message)
      }
    },
    error: function (error) {
      console.log(error)
    }
  });
});

$(document).ready(function () {
  $('.logout').on('click', async function (e) {
    let url = "assets/includes/gate.php"
    let detail = $(this).data("id");
  $.ajax({
    url: url,
    type: 'post',
    data: {
      "logout": detail,
    },
    success: function (response) {
     delete_cookie("jwt")
    },
    error: function (error) {
      swal({
        icon: 'error',
        title: 'Oops...',
        text: error,
      })
    }
  });
  });
  
  $("#error").hide();
  let url = 'assets/includes/uploadForm/forms.php';

  $(".closebtn").on('click', function (e) {
    $('#modal-body div').empty();
  })
  $(".edit").on("click", async function (e) {
    let editId = $(this).data("id1");
    let getEditmenu = $(this).data("id2");
    try {
      $.ajax({
        url: url,
        type: 'post',
        data: {
          "func": "edit",
          "getMenu": getEditmenu,
          "data_id": editId,
         "auth": localStorage.getItem("jwt"),
         
        },
        success: function (response) {
          let resp = JSON.parse(response)
          if (resp.length == 0 || resp.success == false) {
            swal({
              icon: 'error',
              title: 'Oops...',
              text: "No response from server",
            })
          }
          else {
            setTimeout(() => {
              let title = resp.title || resp.topic;
              let subtitle = resp.subtitle;
              let category = resp.category;
              let video_link = resp.video_link;
              let video_path = resp.video_path;
              let preacher = resp.preacher || resp.location;
              let image_path = resp.image_path;
              let description = resp.description;
              let date = resp.TimeStamp ? convertDate(resp.TimeStamp) : convertDate(resp.date);
              $('#largeModalLabel').html(title)
              $('#largeModalLabelSubtitle').html(subtitle)
              image_path ? $('#largeModalImage').attr("src", `../${image_path}`).attr("alt", title) : "";
              description ? $('#modal-body').html(description) : "";
              category ? $('#category').html(category) : "";
              video_link ? $('#video').attr("href", video_link) : "#";
              preacher ? $('#preacher').html(preacher) : "";
              date ? $('#item-date').html(date) : "";
            }, 100);
          }
        },
        error: function (error) {
          swal({
            icon: 'error',
            title: 'Oops...',
            text: error,
          })
        }
      });
    } catch (error) {
      console.log(error)
    }
    e.preventDefault();

  });
  $(".delete").on("click", async function (e) {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: url,
            type: 'post',
            data: {
              "func": "del",
              "getMenu": getmenu,
              "data_id": id,
              "auth": localStorage.getItem("jwt"),
            },
            success: function (response) {
              const resp = JSON.parse(response)
              if (resp.success == false) {
                swal({
                  icon: 'error',
                  title: 'Oops...',
                  text: resp.message,
                });
              }
              else {
                setTimeout(() => {
                  swal(resp.message, {
                    icon: "success",
                  }).then(() => location.reload());
                }, 1000);
              }
            },
            error: function (error) {
              swal({
                icon: 'error',
                title: 'Oops...',
                text: error,
              })
            }
          });
        }
      });
    e.preventDefault();
    let id = $(this).data("id3");
    let getmenu = $(this).data("id4");

  })
  function truncate(str, no_words) {
    return str.split(" ").splice(0, no_words).join(" ");
  }
  function reduceString(str, n) {

    return (str.length > n) ? str.substr(0, n - 1) : str;
  }
  function convertDate(ddate) {
    let date = new Date(ddate)
    const options = { month: "short", day: "numeric", year: "numeric" }
    return new Intl.DateTimeFormat("en-US", options).format(date)
  }
  function delete_cookie(name) {
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }
  
});
function showError(message){
  $("#error").show()
  $('.error').html(message)
}