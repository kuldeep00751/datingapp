<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Profile</title>
  <link rel="stylesheet" href="styles.css">
  <style>
   * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background: url('public/pictures/Background2.jpg'), #f3f3f3;
  background-size: cover;
  color: #fff;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #444;
  padding: 10px 20px;
}

.logo {
  /* width: 30px;
  height: 30px; */
  /* background-color: #fff; */
  clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
}

.nav-icons {
  display: flex;
  gap: 10px;
}

.icon {
  background-color: #111;
  color: #fff;
  padding: 10px;
  text-align: center;
  width: 60px;
  font-size: 12px;
  cursor: pointer;
}

.icon.profile {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-image:url('{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : (Auth::user()->avatar ? Auth::user()->avatar : asset('pictures/default.png')) }}');
  background-size: cover;
}

.profile-container {
  text-align: center;
  /* padding: 40px 20px; */
}

.profile-container h1 {
  font-weight: 300;
  color: #666;
  margin-bottom: 20px;
}

.profile-images {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 20px;
}

.profile-images img {
  width: 200px;
  height: 250px;
  object-fit: cover;
  border-radius: 4px;
}

.image-instructions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  color: #ccc;
  margin-bottom: 40px;
}

.plus-box {
  border: 1px solid #ccc;
  padding: 10px 15px;
  font-size: 20px;
  border-radius: 6px;
}

.form-section {
  background-color: #222;
  padding: 40px;
  max-width: 1000px;
  margin: 0 auto;
  border-radius: unset;
}

.form-section h2 {
  font-weight: 300;
  margin-bottom: 30px;
  color: #ccc;
}

form {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.form-group {
  flex: 1;
  min-width: 250px;
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 5px;
  color: #aaa;
}

input[type="text"] {
  padding: 10px;
  background-color: #333;
  border: 1px solid #777;
  border-radius: 4px;
  color: #fff;
}

  </style>
</head>
<body>
  <header class="top-bar">
    <div class="logo"><img src="{{url('public/pictures/ISO-W.png')}}" width="100"/></div>
    <nav class="nav-icons">
      <div class="icon"><img src="{{url('public/pictures/Affinity Icon.png')}}" width="40"/>Affinity</div>
      <div class="icon"><img src="{{url('public/pictures/News Icon.png')}}" width="40"/>News</div>
      <div class="icon"><img src="{{url('public/pictures/Chat Icon.png')}}" width="40"/>Chat</div>
      <div class="icon"><img src="{{url('public/pictures/Status Icon.png')}}" width="40"/>Status</div>
      <div class="icon profile"></div>
    </nav>
  </header>

  <main class="profile-container">
    <div class="row" style="position: relative;top: 3rem;">
        <h1>Your profile</h1>
        <div class="profile-images">
        <img src="{{url('public/pictures/Background2.jpg')}}" alt="Image 1">
        <img src="{{url('public/pictures/Background2.jpg')}}" alt="Image 2">
        </div>
    </div>
    
    <section class="form-section">
      <div class="image-instructions">
         <div class="plus-box">+</div>
         <p>Select 2 pictures that speak best for you,<br> without filters.</p>
      </div>
      <h2 style="border-bottom: 2px solid gray;line-height: 2;">Basics</h2>

      <form>
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="first_name" />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" />
        </div>
      </form>
    </section>
  </main>
</body>
</html>
