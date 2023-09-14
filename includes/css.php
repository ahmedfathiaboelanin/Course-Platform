<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
  rel="stylesheet"
/>
<link rel="shortcut icon" href="./layout/imgs/logo.webp" type="image/x-icon">
<style>
  *{
    padding: 0%;
    margin: 0%;
    box-sizing: border-box;
    scroll-behavior: smooth !important;
  }
  :root{
      --bg:linear-gradient(to top right, #0a0c1d,#262B48, #160138);
      --nav:linear-gradient(to top right, #160138);
      --btn:linear-gradient(to right, #3f51b5, #4957a7,#3f51b5);
      --btnHover:transparent;
      --text:#FFFEFF;
      --btnText:#FFFEFF;
      --textBtnHover:#fff;
      --navHover:#30336b;
      --article:#30336b;
  }
  .light{
    --bg:linear-gradient(to bottom right, #7ed6df, #c7ecee, #7ed6df);
    --text:#30336b;
    --textBtnHover:#30336b;
    --navHover:#fff;
    --article:#F1F1F1;
  }
  .btn{
    color:var(--btnText) !important;
  }
  .btn:hover{
    color:var(--textBtnHover) !important;
  }
  body{
    background: var(--bg);
    min-height:100vh;
  }
  .glass {
    background-color: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
  }
  footer , nav{
    background:var(--nav) !important;
  }
  footer a,nav a, nav i{
      color: var(--text) !important;
      border-bottom:2px solid transparent;
      transition:ease all .5s;
  }
  footer a:hover,nav a:hover, nav i:hover{
      /* color: var(--navHover) !important; */
      border-bottom:2px solid var(--text);
  }
  nav .dropdown-item{
      color: #0a0c1d !important;
  }
  .nav-item i{
    font-size:20px;
    cursor: pointer;
  }
  ::-webkit-scrollbar{
      width: 5px;
  }
  ::-webkit-scrollbar-thumb{
      background:var(--bg);
  }
  ::-webkit-scrollbar-track{
      background-color: #EFEFEF;
  }
  .navbar-brand img,.dropdown img{
    width:30px;
    height:30px;
    border-radius:50%;
  }
  .preloader{
    position: fixed;
    width:100%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    z-index: 10000;
    background:var(--bg);
  }
  .preloader img{
    width:150px;
    height:150px;
    border-radius:50%;
  }
</style>