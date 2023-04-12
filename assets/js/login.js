$('#loginForm').on("submit", function(e) {
  e.preventDefault();
  let errorMessage = "";
  let email = $("#loginForm .form:not(.slide-up) .email").val();
  let password = $("#loginForm .form:not(.slide-up) .password").val();
  let cpassword = $(".cpassword").val();
  let action = $("#loginForm .form:not(.slide-up)").attr("data-action");

  if (action === "doregister") {
    if (cpassword !== password) {
      errorMessage = "Passwords must be the same."
    }
  } else {
    if (!email || !password) {
      errorMessage = "Please fill in all input fields."
    }
  }

  if (!errorMessage) {
    $.post(`${basename}/controller`, { action, email, password }).done(function (data) {
      if (data.status ==="OK") {
        window.location.href = "/main";
      } else {
        Swal.fire({
          title: "Error!",
          text: data.error,
          icon: "error",
        });
      }
    });
  } else {
    Swal.fire({
      title: "Error!",
      text: errorMessage,
      icon: "error",
    });
  }
})

const loginBtn = document.getElementById("login");
const signupBtn = document.getElementById("signup");

loginBtn.addEventListener("click", (e) => {
  let parent = e.target.parentNode.parentNode;
  Array.from(e.target.parentNode.parentNode.classList).find((element) => {
    if (element !== "slide-up") {
      parent.classList.add("slide-up");
    } else {
      signupBtn.parentNode.classList.add("slide-up");
      parent.classList.remove("slide-up");
    }
  });
});

signupBtn.addEventListener("click", (e) => {
  let parent = e.target.parentNode;
  Array.from(e.target.parentNode.classList).find((element) => {
    if (element !== "slide-up") {
      parent.classList.add("slide-up");
    } else {
      loginBtn.parentNode.parentNode.classList.add("slide-up");
      parent.classList.remove("slide-up");
    }
  });
});