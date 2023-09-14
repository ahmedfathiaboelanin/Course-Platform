<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
></script>
<script>
  window.onload=function(){
    setTimeout(() => {
      document.getElementById("preloader").setAttribute("style","display:none;")
    }, 2000);
  }
  document.getElementById("mode").onclick = function (){
    let SetTheme = document.body;
    document.getElementById("mode").classList.toggle("fa-sun");
    document.getElementById("mode").classList.toggle("fa-moon");
    SetTheme.classList.toggle("light");
    var theme;
    if (SetTheme.classList.contains("light")) { 
        theme = "light";
    } else {
        theme = "dark";
    }
    localStorage.setItem("theme", JSON.stringify(theme));
  }
  let getTheme = JSON.parse(localStorage.getItem("theme"));

  if (getTheme === "light") {
      document.body.classList.add("light");
  }
</script>