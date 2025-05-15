document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get("status");
  
    if (status === "login_failed") {
      Swal.fire({
        icon: "error",
        title: "Login Failed",
        text: "Invalid email or password!",
      });
    }
  
    if (status === "signup_success") {
      Swal.fire({
        icon: "success",
        title: "Account Created",
        text: "You may now log in.",
      });
    }
  
    if (status === "oauth_error") {
      Swal.fire({
        icon: "error",
        title: "Login Failed",
        text: "Unable to log in via Google/Facebook.",
      });
    }
  
    if (status === "forgot_sent") {
      Swal.fire({
        icon: "info",
        title: "Check Your Email",
        text: "Password reset link has been sent.",
      });
    }
  
    if (status === "logout") {
      Swal.fire({
        icon: "success",
        title: "Logged Out",
        text: "You have been successfully logged out.",
      });
    }
  });
  