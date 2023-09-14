document.getElementById("show").onclick = function () {
    document.getElementById("show").classList.toggle("fa-eye");
    document.getElementById("show").classList.toggle("fa-eye-slash");
    if (document.getElementById("form3").type === "password") {
        document.getElementById("form3").type = "text";
    } else {
        document.getElementById("form3").type = "password";
    }
};
document.getElementById("arrow").onmouseover = function () {
    let minSide = document.querySelector(".minSide");
    minSide.classList.add("collapseMin");
    console.log("clicked");
};

document.getElementById("close").onclick = function () {
    let side = document.querySelector(".minSide");
    document.getElementById("arrow").classList.toggle("rotate");
    side.classList.remove("collapseMin");
};
