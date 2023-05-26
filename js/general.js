var body = document.getElementById("body");
var search = document.getElementById("search");
var button = document.getElementById("button");
var body = document.getElementById("body");
button.addEventListener("click", delay);
function delay(e) {
  /*  Capture the string user enter into the search box  */
  var message = search.value;

  /*  Search whether the enter string is present into the web page or not */
  /*  If web page contains the content then return the object of that content  */
  var items = $("*:contains(" + message + ")");

  /*  Capture the size og the array  */
  /*  If the size of the array is zero then content is not present into the webpage  */
  var len = items.length - 1;

  /* otherwise content present into the webpage */
  if (len != -1) {
    /*  perform the smooth scrolling using scroll function */
    body.scroll({
      /* getBoundingClientRect() function return coordinates of the tag prsent into the webpage  */
      /* items[items.length-1] capture the parent element then take value of the top coordinates   */
      top: items[items.length - 1].getBoundingClientRect().top,

      /*  Property for the smooth scrolling */
      behavior: "smooth",
    });
  }

  /* getBoundingClientRect() function return coordinates of the tag prsent into the webpage  */
  /* items[items.length-1] capture the parent element then take value of the top coordinates   */
  // console.log(items[items.length-1].getBoundingClientRect().top);

  /* Another way: apply html() which return the content inside the selected element  */
  /* now replace the content with anchor element with providing id */
  // $('#body').html($('#body').html().replace(message, '<a id="imhere"></a>'+message));

  /* Capture the coordinates of the selected element and then perform the smooth scrolling*/
  // var exp = document.getElementById("imhere").getBoundingClientRect();
  // var coordinates = exp.top;
  // body.scroll({
  //   top:coordinates,
  //   behavior:"smooth",
  // })
  // console.log($('#body').html());
}
