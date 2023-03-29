/**
 * Render Footer
 * @returns
 */
function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /* Loop through a collection of all HTML elements: */
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /* Make an HTTP request using the attribute value as the file name: */
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) {
            elmnt.innerHTML = this.responseText;
          }
          if (this.status == 404) {
            elmnt.innerHTML = "Page not found.";
          }
          /* Remove the attribute, and call this function once more: */
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      };
      xhttp.open("GET", file, true);
      xhttp.send();
      /* Exit the function: */
      return;
    }
  }
}

includeHTML();

/**
 * navbar hamburger change
 */

const hamburger = document.querySelector(".hamburger");
const ulMobLinks = document.querySelector(".links_index_nav");
const bodyTag = document.querySelector("body");
hamburger.addEventListener("click", () => {
  //新增DOM增加Active;
  ulMobLinks.classList.toggle("active");
  //控制body鎖定高度
  bodyTag.style.cssText = ulMobLinks.classList.contains("active")
    ? "height:100vh;overflow-y:hidden;"
    : "";
});
